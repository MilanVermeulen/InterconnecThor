<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
     /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        ]);
    
        $student = new Student;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->streetnr = $request->streetnr;
        $student->postal_code = $request->postal_code;
        $student->city = $request->city;
        $student->country = $request->country;
        $student->password = bcrypt($request->password);
        $student->save();
    
        return redirect()->route('home')->with('success', 'Registration successful');
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
        $credentials['approved'] = 1; // Add 'approved' field with a value of 1

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
    
        $searchName = $request->input('search');
        $currentUserId = Auth::guard('student')->id();  // Get the currently logged in student's ID
    
        $students = Student::query()
            ->where('id', '!=', $currentUserId)  // Exclude the currently logged in student
            ->where(function ($query) use ($searchName) {
                $query->where('first_name', 'like', '%' . $searchName . '%')
                    ->orWhere('last_name', 'like', '%' . $searchName . '%')
                    ->orWhere('city', 'like', '%' . $searchName . '%');
            })
            ->where('approved', 1)
            ->get();
    
        return view('searchresults', compact('students'));
    }
        
}