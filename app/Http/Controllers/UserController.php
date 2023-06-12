<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    // Show the registration form
    public function showRegisterForm()
    {
        $courses = Course::all(); // fetch all courses from the database
        return view('register', compact('courses')); // pass the courses to the register view
    }

    // Handle the registration request
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'street_nr' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
            'password' => 'required|min:6|confirmed',
            'courses' => 'required|array|min:1', // validates that at least 1 course is selected
            'courses.*' => 'exists:courses,id', // validates that every value in the courses array exists as a course id
            'start_years' => 'required|array|min:1', // validates that at least 1 start year is provided
            'start_years.*' => 'required|integer|min:1900|max:'.(date('Y') + 2), // validates that every start year is an integer and is required and within the specified range
            'end_years' => 'required|array|min:1', // validates that at least 1 end year is provided
            'end_years.*' => 'required|integer|min:1900|max:'.(date('Y') + 4).'|gte:start_years.*', // validates that every end year is an integer and is required and within the specified range and at least the corresponding start year
            // 'profile_picture' => [
            //     File::types(['png', 'jpg', 'jpeg', 'gif'])->max(5120), // validates that the file is a png, jpg, jpeg, or gif and is smaller than 5120 kilobytes (5 megabytes)
            // ],
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', // validates that the file is an image and is smaller than 5120 kilobytes (5 megabytes)

        ]);

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            if ($file->isValid()) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile-pictures', $filename, 'public');

                // Save the file path or filename to the "profile_picture" column in the "students" table
                $profilePicturePath = $path;
            } else {
                return redirect()->back()->withErrors(['profile_picture' => 'The profile picture upload failed.']);
            }
        }

        // Save the registration details to the users table with the role_id column set to 2 (student)
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->street_nr = $request->input('street_nr');
        $user->postal_code = $request->input('postal_code');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->password = bcrypt($request->input('password'));
        // set role_id column to 2 (student)
        $user->role_id = 2;

        if (isset($profilePicturePath)) {
            $user->profile_picture = $profilePicturePath;
        }

        $user->save();

        // Save the courses and their details to the pivot table
        foreach ($request->courses as $key => $course_id) {
            $start_year = $request->start_years[$key];
            $end_year = $request->end_years[$key];

            $course = Course::findOrFail($course_id);
            $categories = $course->category()->pluck('id')->toArray();

            $user->categories()->attach($categories);
            $user->courses()->attach($course_id, ['start_year' => $start_year, 'end_year' => $end_year]);
        }

        return redirect()->route('home')->with('success', 'Registration successful, please wait for approval!');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the login form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Perform authentication logic here (e.g., check credentials against the database)
        $credentials = $request->only('email', 'password');
        $credentials['approved'] = 1; // Check if the user is approved
        $credentials['role_id'] = 2; // Check if the role_id of the user is 2

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
        }
    }

    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }

   // Search
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3',
        ]);

        $search = $request->input('search');
        $currentUserId = Auth::id();  // Get the currently logged in user's ID

        // Search for user's name, city, postal code, courses, and categories
        $users = User::query()
            ->where('id', '!=', $currentUserId)  // Exclude the currently logged in user from the search results
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%')
                    ->orWhere('postal_code', 'like', '%' . $search . '%')
                    ->orWhereHas('courses', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('categories', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            // Only show approved users with role_id 2
            ->where('approved', 1)
            ->where('role_id', 2)
            ->get();

        return view('search', compact('users'));
    }

    public function showProfile()
    {
        // Retrieve the currently authenticated user
        $user = auth()->user();

        // Pass the user data to the view
        return view('profile', compact('user'));
    }

}
