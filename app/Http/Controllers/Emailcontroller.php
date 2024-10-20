<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Str;
use Mail;

class Emailcontroller extends Controller
{
    public function storeuser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
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
                return redirect()->route('login')->withMessage('success', 'We have sent a mail to your email address. Please check your email and click on the link to reset your password.');
        }
    }
}
