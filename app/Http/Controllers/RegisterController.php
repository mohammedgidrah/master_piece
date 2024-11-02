<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function verifyAccount($token)
    {
        // Check if the token is valid
        if (!is_null($token)) {
            $email = DB::table('password_reset_tokens')->where('token', $token)->value('email');
            if ($email) {
                $user = User::where('email', $email)->first();
                if ($user) {
                    // Update user's verification status
                    $user->is_verified = true; // Assuming you have this column
                    $user->save();

                    // Log in the user
                    Auth::login($user);

                    return redirect()->route('home')->with('success', 'Your email has been verified. You are now logged in.');
                }
            }
        }

        return redirect()->route('home')->with('error', 'Invalid verification token.');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,web|max:5120',
        ]);
    
        // Set the default image path
        $imagePath = 'uploads/usersprofiles/defultimage/userimage.png';
    
        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/usersprofiles', 'public');
        }
    
        // Create the user with is_verified set to false
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'image' => $imagePath, // Store the path of the uploaded or default image
            'is_verified' => false, // Set verification status to false
        ]);
    
        // Create a notification for the user upon successful registration
        Notification::create([
            'user_id' => $user->id,
            'type' => 'Account Registration',
            'data' => json_encode([
                'message' =>  ' a new account has been registered successfully.',
                'user_id' => $user->id,
                'user_name' => $user->first_name . ' ' . $user->last_name,
                'user_email' => $user->email,
                'user_image' => $user->image ? asset('storage/' . $user->image) : asset('assets/img/default-avatar.png')
            ]),
            'is_read' => false, // Set as unread
        ]);

      
        
        // Generate a verification token
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token
        ]);
    
        // Send verification email
        Mail::send('emails.verify', ['token' => $token], function ($message) use ($request) {
            $message->subject('Email Verification Mail from MASA')->to($request->email);
        });
    
        // Redirect to the login page after successful registration
        return redirect()->route('login')->with('success', 'Registration successful. A verification email has been sent to your email address. Please check your email to verify your account.');
    }
    
    
}
