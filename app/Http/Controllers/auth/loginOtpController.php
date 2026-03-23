<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;

class loginOtpController extends Controller
{
    public function show(){
        return view('2fa.otp_verify');
    }

    public function verify(Request $request){
        $request->validate([
            'otp' => 'required',
        ]);

        session([
            '2fa_attempts' => session('2fa_attempts', 0) + 1
        ]);

        // Block if too many attempts
        if (session('2fa_attempts') > 5) {
            session()->forget(['2fa_user_id', '2fa_otp', '2fa_expires_at', '2fa_attempts']);
            return redirect()->route('login')->with('error', 'Too many attempts. Please login again.');
        }

        if (!session()->has('2fa_user_id')) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        // Check expiry
        if (now()->greaterThan(session('2fa_expires_at'))) {
            session()->forget(['2fa_user_id', '2fa_otp', '2fa_expires_at', '2fa_attempts']);
            return back()->with('error', 'OTP has expired. Please login again.');
        }

        $otp = $request->otp;

        if ((string)$otp == (string) session('2fa_otp')) {

            $user = User::find($request->session()->get('2fa_user_id'));
            Auth::login($user);

            session()->forget(['2fa_user_id', '2fa_otp', '2fa_expires_at', '2fa_attempts']);
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    public function resend(Request $request){
        $userId = $request->session()->get('2fa_user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }
        $otp = rand(100000, 999999);
        $request->session()->put('2fa_otp', $otp);

        $request->session()->put('2fa_expires_at', now()->addMinutes(5));

        //reset attempts
        session()->forget('2fa_attempts');
        
        //send mail
        Mail::to($user->email)->send(new OtpMail($otp, $user));
        
        return back()->with('success', 'OTP resent successfully');
    }
}
