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
    public function forgetPasswordpost(Request $request)
    {
        set_time_limit(120);


        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        
        Mail::send('emails.forget-password', ['token' => $token], function ($message) use ($request) {
            // $emailsattic= 'hammourileen14@gmail.com';
            $message->to('hammourileen14@gmail.com');
            $message->subject('Reset Password');
        });
        return redirect()->to(route('forget.password'))->with('success', 'We have sent a link to your email address to reset your password.');

    }
    public function resetPassword($token)
    {
        return view('new-password', compact('token'));

    }
    public function resetPasswordpost(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();
        if (!$updatePassword) {
            return redirect()->to(route('reset.password', $request->token))->with('error', 'Invalid token!');
        }
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);
        Db::table('password_resets')->where(['email' => $request->email])->delete();
        

        return redirect()->to(route('login'))->with('success', 'Your password has been changed!');

    }
}
