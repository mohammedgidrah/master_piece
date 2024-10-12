<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
 

    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // If successful, check the user's role
            $user = Auth::user();

            if ($user->isAdmin()) { // Check if the user is an admin
                return redirect()->route('dashboard.maindasboard')->with('success', 'Welcome to the admin dashboard!');
            }

            return redirect()->intended('/') ; // Redirect to home for regular users
        }

        // If authentication fails, return error message for both email and password fields
        return back()->withErrors([
            'email' => 'email  or password is incorrect.',
         ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login') ;
    }
}
