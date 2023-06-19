<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Mail\ForgotPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EmailController extends Controller
{
    
    // Contact us email
    public function contactEmail(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
    
        $emailData = $request->only('first_name', 'last_name', 'email', 'subject', 'message');
    
        // Get all users with role_id 1
        $users = User::where('role_id', 1)->get();
    
        foreach ($users as $user) {
            // Send the email
            Mail::to($user->email)->send(new ContactEmail($emailData));
        }
    
        return redirect()->route('home')->with('success', 'Your message has been sent successfully!');
    }

    // Forgot password email
    public function forgotPasswordEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $emailData = $request->only('email');
    
        // Get the user with the given email
        $user = User::where('email', $emailData['email'])->first();
    
        if ($user) {
            // Create a new token
            $token = Str::random(60);
            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => hash('sha256', $token),
                'created_at' => Carbon::now(),
            ]);
    
            // Send the email
            Mail::to($user->email)->send(new ForgotPasswordEmail(['email' => $emailData['email'], 'token' => $token]));
    
            return redirect()->route('login')->with('success', 'An email has been sent to you with instructions on how to reset your password.');
        }
    
        return redirect()->back()->with('error', 'No account found with the provided email.');
    }    

}
