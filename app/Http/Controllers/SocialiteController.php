<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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

                $newUser = User::create([
                    'first_name' => $user->user['given_name'] ?? '',
                    'last_name' => $user->user['family_name'] ?? '',
                    'email' => $user->email,
                    'password' => encrypt('my-google'),
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'email_verified_at' => Carbon::now(),

                ]);
                Auth::login($newUser);
            }

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }

}
