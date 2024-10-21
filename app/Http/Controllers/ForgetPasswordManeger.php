<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordManeger extends Controller
{
    public function forgetPassword()
    {
        return view('forgetpassword.forget-password');
    }

    public function forgetPasswordPost(Request $request)
    {
        set_time_limit(120);

        // Define custom validation messages
        $messages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email does not exist in our records.',
        ];

        // Validate the request
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], $messages);

        $token = Str::random(64);

        // Insert the reset token into the password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send the reset email
        Mail::send('emails.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        // Redirect with success message
        return redirect()->route('forget.password')->with('success', 'We have sent a link to your email address to reset your password.');
    }

    public function resetPassword($token)
    {
        return view('new-password', compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        // Define custom validation messages
        $messages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email does not match our records.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password_confirmation.required' => 'The password confirmation field is required.',
        ];

        // Validate the incoming request data with custom messages
        $request->validate([
            'email' => 'email|exists:users,email',
            'password' => [
                'string',
                'min:8', // Minimum length
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[\W_]/', // At least one special character
                'confirmed', // Ensure the confirmation matches
            ],
            'password_confirmation' => '',
        ], $messages);

        // Check if the reset token is valid
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();

        if (!$updatePassword) {
            return redirect()->route('reset.password', $request->token)->with('error', 'Invalid token!');
        }

        // Update the user's password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Delete the password reset record
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }
}
