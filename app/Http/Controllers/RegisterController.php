<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function verifyAcount($token)
    {
        if (!is_null($token)) {
            $db = DB::table('password_reset_tokens')->where('token', $token)->first()->email;
            // $user = DB::table('users')->where('email', $db)->first();
            $user = User::where('email', $db)->first();
            // dd($user);
            Auth()->login($user);

            return redirect()->route('home')->with('success', 'Your email has been verified. You can now log in.');
        }
    }
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webg|max:5120',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if (User::create($data)) {
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token]);
            Mail::send('emails.verify', ['token' => $token], function ($message) use ($request) {
                $message->subject('Email Verification Mail from MASA')->to($request->email);

            });
            return redirect()->route('login')->withErrors(['success' => 'We have sent a mail to your email address. Please check your email and click on the link to reset your password.']);
        }

        // Set the default image path
        $imagePath = 'uploads/usersprofiles/defultimage/userimage.png';

        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/usersprofiles', 'public');
        }

        // Check if the user is already registered
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // If the user is already registered, log them in
            auth()->login($existingUser);
            // Redirect to the home page after login
            return redirect()->route('home')->with('success', 'You are already registered and have been logged in.');
        }

        // If the user does not exist, create a new one
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'image' => $imagePath, // Store the path of the uploaded or default image
        ]);

        // Log the user in automatically
        auth()->login($user);

        // Redirect to the home page after successful login
        return redirect()->route('home')->with('success', 'Registration successful. You are now logged in.');
    }

}
