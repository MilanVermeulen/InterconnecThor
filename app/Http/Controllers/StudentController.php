<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
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
            'email' => 'required|email|unique:students',
            'phone' => 'required',
            'streetnr' => 'required',
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
        ]);

        $student = new Student;
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->streetnr = $request->input('streetnr');
        $student->postal_code = $request->input('postal_code');
        $student->city = $request->input('city');
        $student->country = $request->input('country');
        $student->password = bcrypt($request->input('password'));
        $student->save();

        foreach ($request->courses as $key => $course_id) {
            $start_year = $request->start_years[$key];
            $end_year = $request->end_years[$key];

            $course = Course::findOrFail($course_id);
            $categories = $course->category()->pluck('id')->toArray();

            $student->categories()->attach($categories);
            $student->courses()->attach($course_id, ['start_year' => $start_year, 'end_year' => $end_year]);
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
        $credentials['approved'] = 1; // Check if the student is approved

        if (Auth::guard('student')->attempt($credentials)) {
            // Authentication successful
            return redirect()->route('home')->with('success', 'Login successful!');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }

    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

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
        $currentUserId = Auth::guard('student')->id();  // Get the currently logged in student's ID

        // Search for students name or city
        $students = Student::query()
            ->where('id', '!=', $currentUserId)  // Exclude the currently logged in student from the search results
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%')
                    ->orWhereHas('courses', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('categories', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            // Only show approved students
            ->where('approved', 1)
            ->get();

        return view('search', compact('students'));
    }
        
}