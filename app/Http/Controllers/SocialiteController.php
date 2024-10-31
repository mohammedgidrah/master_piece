<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            $user = Socialite::driver('google')->user();
            $finduser = User::where('social_id', $user->id)->first();
    
            if ($finduser) {
                Auth::login($finduser);
            } else {
                // Google response may not provide first and last name separately, so check if available
                $newUser = User::create([
                    'first_name' => $user->user['given_name'] ?? '',  // Get from Google's user array
                    'last_name' => $user->user['family_name'] ?? '',   // Get from Google's user array
                    'email' => $user->email,
                    'password' => encrypt('my-google'),                // You may want to change this default
                    'social_id' => $user->id,
                    'social_type' => 'google',
                ]);
                Auth::login($newUser);
            }
    
            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
    

}
