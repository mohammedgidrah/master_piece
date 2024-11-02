<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Include the Storage facade
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
            // Get user information from Google
            $user = Socialite::driver('google')->user();
            // Find user in the database
            $findUser = User::where('social_id', $user->id)->first();

            if ($findUser) {
                // User exists, log them in
                Auth::login($findUser);
            } else {
                // Create a new user if they do not exist
                $imagePath = $this->storeImage($user->user['picture'] ?? null); // Store the image
                
                $newUser = User::create([
                    'first_name' => $user->user['given_name'] ?? '',
                    'last_name' => $user->user['family_name'] ?? '',
                    'email' => $user->email,
                    'password' => bcrypt('my-google'), // Use bcrypt for password hashing
                    'social_id' => $user->id,
                    'image' => $imagePath,
                    'social_type' => 'google',
                    'email_verified_at' => now(),
                ]);

                // Create a welcome notification for the new user
                Notification::create([
                    'user_id' => $newUser->id,
                    'type' => 'google Registration',
                    'data' => json_encode([
                        'message' => 'Welcome, ' . $newUser->first_name . '! A new account has been registered by Google.',
                        'user_name' => $newUser->first_name . ' ' . $newUser->last_name,
                        'user_id' => $newUser->id,
                        'user_image' => $newUser->image,
                        'user_image' => $newUser->image,
                        'user_email' => $newUser->email,
                    ]),
                    'is_read' => false, // Set as unread
                ]);

                // Log the new user in
                Auth::login($newUser);
            }

            // Redirect based on user role
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard'); // Admin dashboard
            }

            return redirect('/'); // Regular user home page
        } catch (\Exception $e) {
            // Handle the exception, log it if necessary
            return redirect('/login')->with('error', 'Could not authenticate. Please try again.'); // Add an error message
        }
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
        return  $imagePath; // Adjust the path according to your needs
    }
}
