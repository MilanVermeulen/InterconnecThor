<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    
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

}
