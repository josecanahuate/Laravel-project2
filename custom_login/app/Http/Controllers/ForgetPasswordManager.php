<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordManager extends Controller
{
    public function forgetPassword()
    {
        return view("forget-password");
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",      
        ]);

        $token = Str::random(64); 
        
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forget-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->route("forget.password")->with('success', "We have sent a password reset link to your registered e-mail address.");
    }

    public function resetPassword(Request $request, $token)
    {
        return view("new-password", compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users", 
            "password" => "required|string|min:6|confirmed",
            "password_confirmation" => "required"
        ]);

        $updatePassword = DB::table("password_reset_tokens")->where([
            "email" => $request->email,
            "token" => $request->token,
        ])->first();

        if (!$updatePassword) {
            return redirect()->route("reset.password")->with(["error" => "Invalid Token"]);
        }

        User::where("email", $request->email)
            ->update(["password" => Hash::make($request->password)]);

        DB::table("password_reset_tokens")->where(["email" => $request->email])->delete();

        return redirect()->route("login")->with('success', "Password reset success");
    }
}
