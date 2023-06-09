<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'name' => 'required|max:255|unique:users', // validates that the name is required, is a string, is unique in the users table, and has a maximum length of 255 characters
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
            'start_years.*' => 'required|integer|min:1900|max:' . (date('Y') + 2), // validates that every start year is an integer and is required and within the specified range
            'end_years' => 'required|array|min:1', // validates that at least 1 end year is provided
            'end_years.*' => 'required|integer|min:1900|max:' . (date('Y') + 4) . '|gte:start_years.*', // validates that every end year is an integer and is required and within the specified range and at least the corresponding start year
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

                // Save the file path or filename to the "profile_picture" column in the "users" table
                $profilePicturePath = $path;

                // Also save the file in the 'users-avatar' directory
                $avatarPath = $file->storeAs('users-avatar', $filename, 'public');

                // Save the file path or filename to the "avatar" column in the "users" table
                $avatarPicturePath = $avatarPath;
            } else {
                return redirect()->back()->withErrors(['profile_picture' => 'The profile picture upload failed.']);
            }
        }

        // Save the registration details to the users table with the role_id column set to 2 (student)
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->name = $request->input('name');
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
        } else {
            $user->profile_picture = 'profile-pictures/default.png';
        }

        if (isset($avatarPicturePath)) {
            $user->avatar = $avatarPicturePath;
        } else {
            $user->avatar = 'users-avatar/default.png';
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
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Identify the field type
        $field = $this->identifyFieldType($request->input('identifier'));

        // Perform authentication logic here (e.g., check credentials against the database)
        $credentials = [
            $field => $request->input('identifier'),
            'password' => $request->input('password'),
            'role_id' => 2, // Check if the role_id of the user is 2
            'approved' => 1 // Check if the user is approved
        ];

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors([$field => 'Invalid ' . $field . ' or password.']);
        }
    }

    /**
     * Identify if the field is an email or a username.
     *
     * @param string $identifier
     * @return string
     */
    private function identifyFieldType(string $identifier)
    {
        return Validator::make(compact('identifier'), ['identifier' => 'email'])->fails() ? 'name' : 'email';
    }

    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    // Show reset password form
    public function showResetPasswordForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    // reset password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('token', hash('sha256', $request->token))
            ->first();

        if (!$passwordReset) {
            // Token not found
            return redirect()->back()->withErrors(['email' => 'This password reset token is invalid.']);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            // User not found
            return redirect()->back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        // Redirect to login with success message
        return redirect()->route('login')->with(['message' => 'Your password has been changed!']);
    }


    // Search students
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
                    ->orWhere('name', 'like', '%' . $search . '%')
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

    // Show the logged in user's profile
    public function showUserProfile()
    {
        // Retrieve the currently authenticated user
        $user = auth()->user();
        $posts = $user->posts()->latest()->paginate(5); // Use the paginate method to show 5 posts per page

        // Truncate the content of each post to a maximum of 255 characters
        foreach ($posts as $post) {
            $post->description = Str::limit($post->description, 255);
        }

        // Pass the user data to the view
        return view('userProfile', compact('user', 'posts'));
    }

    // Show the profile of the user with the provided ID
    public function viewProfile($id)
    {
        // Retrieve user data based on the provided ID
        $user = User::find($id);

        if (!$user) {
            // Handle case when user is not found
            abort(404);
        }

        // Retrieve the user's posts, with 5 posts per page
        $posts = $user->posts()->latest()->paginate(5);

        // Truncate the content of each post to a maximum of 255 characters
        foreach ($posts as $post) {
            $post->description = Str::limit($post->description, 255);
        }

        // Pass the user data and truncated posts to the profile view
        return view('searchProfile', compact('user', 'posts'));
    }

    // Show the edit profile form view
    public function showUpdateProfile()
    {
        $user = auth()->user();

        return view('edit-profile', compact('user'));
    }

    // Update the user's profile
    public function updateProfile(Request $request)
    {
        // Validation rules for the form fields
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'street_nr' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ];

        // Validate the form data
        $validatedData = $request->validate($rules);

        // Check if username or email already exist in the database
        $existingUser = User::where('id', '!=', auth()->user()->id)
            ->where(function ($query) use ($validatedData) {
                $query->where('name', $validatedData['name'])
                    ->orWhere('email', $validatedData['email']);
            })
            ->first();

        if ($existingUser) {
            return redirect()->back()->withInput()->withErrors(['name' => 'Username or email already exists.']);
        }

        // Update the user's profile data
        $user = auth()->user();
        $user->fill($validatedData);

        // Handle profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            if ($file->isValid()) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile-pictures', $filename, 'public');
                $user->profile_picture = $path;
            } else {
                return redirect()->back()->withErrors(['profile_picture' => 'The profile picture upload failed.']);
            }
        }

        $user->save();

        return redirect()->route('userProfile')->with('success', 'Profile updated successfully.');
    }


    // delete profile/account
    public function deleteUser(User $user)
    {
        // Check if the logged in user is the same as the user being deleted
        if (Auth::user()->id != $user->id) {
            return redirect()->route('home')->with('error', 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('home')->with('success', 'User deleted successfully!');
    }

}
