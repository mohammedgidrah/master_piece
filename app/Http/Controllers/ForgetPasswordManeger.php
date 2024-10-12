<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordManeger extends Controller
{
    function forgetPassword(){
        return view('forgetpassword.forget-password');
    }
    function forgetPasswordpost(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users,',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('forgetpassword.forget-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

    }
}
