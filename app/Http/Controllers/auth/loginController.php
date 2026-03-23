<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    //
    public function index(){
        return view("login");
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Check email verification
            if (!$user->email_verified_at) {
                Auth::logout();
                return back()->withErrors(['email' => 'Email not verified']);
            }

            // Check suspended
            if ($user->is_suspended) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been suspended. Contact support.']);
            }

            // Check if account is deactivated
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been deactivated.']);
            }

            //2fa
            if ($user->two_factor_enabled) {
                // Generate OTP
                $otp = rand(100000, 999999);

                session([
                    '2fa_user_id' => $user->id,
                    '2fa_otp' => $otp,
                    '2fa_expires_at' => now()->addMinutes(5)
                ]);

                // Send OTP email
                Mail::to($user->email)->send(new OtpMail($otp, $user));
                Auth::logout();

                return redirect()->route('otp_verify');
            }   

            //normal login
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
