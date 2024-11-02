<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // If the user exists but is not verified, resend the verification email
                if (!$user->is_verified) {
                    $this->sendVerificationEmail($user);
                    return redirect()->route('login')->with('info', 'Your account is not verified. Please check your email for the verification link.');
                }
                // Log in the verified user
                Auth::login($user);

                // Redirect based on user role
                if ($user->role === 'admin') {
                    return redirect()->route('dashboard.maindasboard')->with('success', 'Welcome to your dashboard.');
                } else {
                    return redirect()->route('home')->with('success', 'You are logged in successfully.');
                }
            } else {
                // Split the Google name into first and last names
                $fullName = $googleUser->getName();
                $nameParts = explode(' ', $fullName, 2);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

                // Store the Google profile image, if available
                $imagePath = $this->storeImage($googleUser->avatar);

                // Create a new user with is_verified set to false
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $googleUser->getEmail(),
                    'image' => $imagePath,
                    'is_verified' => false, // Email verification required
                    'password' => bcrypt(Str::random(16)), // Generate a random password
                    'role' => 'user', // Assign a default role (adjust as necessary)
                    'social_type' => 'google',
                ]);

                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'google Registration',
                    'data' => json_encode([
                        'message' => ' An account has been registered by Google.',
                        'user_name' => $user->first_name . ' ' . $user->last_name,
                        'user_id' => $user->id,
                        'user_image' => $user->image ? asset('storage/' . $user->image) : asset('assets/img/default-avatar.png'),
                        'user_email' => $user->email,
                    ]),
                    'is_read' => false, // Set as unread
                ]);

                // Send a verification email to the new user
                $this->sendVerificationEmail($user);
                return redirect()->route('login')->with('success', 'Registration successful. A verification email has been sent to your email address.');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to login with Google. Please try again.');
        }
    }

    private function sendVerificationEmail($user)
    {
        // Generate a unique verification token
        $token = Str::random(64);

        // Insert token and email into password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Send verification email with token
        Mail::send('emails.verify', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Email Verification Required');
        });
    }

    protected function storeImage($imageUrl)
    {
        if (!$imageUrl) {
            return null; // No image to store
        }

        // Get the image content from the URL
        $imageContent = file_get_contents($imageUrl);

        if ($imageContent === false) {
            // Handle the error if the image could not be retrieved
            return null; // Or you can throw an exception or log the error
        }

        // Generate a unique filename
        $filename = uniqid('google_profile_', true) . '.jpg';

        // Store the image in the public storage under 'uploads/usersprofiles'
        $imagePath = 'uploads/usersprofiles/' . $filename;
        Storage::disk('public')->put($imagePath, $imageContent);

        // Return the path where the image is stored
        return $imagePath; // Adjust the path according to your needs
    }
}
