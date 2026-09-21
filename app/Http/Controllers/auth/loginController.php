<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;

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

        $email = strtolower(trim($request->email));

        // Limit attempts for this specific email + IP
        $emailRateLimitKey = 'login|' . $request->ip() . '|' . $email;

        if (RateLimiter::tooManyAttempts($emailRateLimitKey, 5)) {

            $seconds = RateLimiter::availableIn($emailRateLimitKey);

            Log::warning('Login rate limit exceeded', [
                'email' => $email,
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
                ]);
        }

        // Limit attempts from the same IP
        $ipRateLimitKey = 'login-ip|' . $request->ip();

        if (RateLimiter::tooManyAttempts($ipRateLimitKey, 20)) {

            $seconds = RateLimiter::availableIn($ipRateLimitKey);

            Log::warning('Login IP rate limit exceeded', [
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many login attempts from this network. Please try again in {$seconds} seconds.",
                ]);
        }

        // Count this login attempt
        RateLimiter::hit($emailRateLimitKey, 60);
        RateLimiter::hit($ipRateLimitKey, 60);


        //Authentication
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Check email verification
            if (!$user->email_verified_at) {

                Log::warning('Login attempt with unverified email', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);

                Auth::logout();
                return back()->withErrors(['email' => 'Email not verified']);
            }

            // Check suspended
            if ($user->is_suspended) {

                Log::warning('Login attempt on suspended account', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);

                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been suspended. Contact support.']);
            }

            // Check if account is deactivated
            if (!$user->is_active) {

                Log::warning('Login attempt on deactivated account', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);
                
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been deactivated.']);
            }

            //check user role
            if ($user->role !== 'user') {

                Log::warning('Unauthorized role attempted user login', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'ip' => $request->ip(),
                ]);

                Auth::logout();
                return back()->withErrors(['email' => 'You are not authorized to login as a user.']);
            }

            //2fa
            if ($user->two_factor_enabled) {
                // Generate OTP
                $otp = random_int(100000, 999999);

                session([
                    '2fa_user_id' => $user->id,
                    '2fa_otp' => $otp,
                    '2fa_expires_at' => now()->addMinutes(5)
                ]);

                Log::info('2FA OTP generated for login', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);

                // Send OTP email
                Mail::to($user->email)->send(new OtpMail($otp, $user));
                Auth::logout();

                return redirect()->route('otp_verify');
            }   

            //normal login
            $request->session()->regenerate();

            // Create a new active session ID
            $sessionId = (string) Str::uuid();

            // Make this the user's only active session
            $user->update([
                'active_session_id' => $sessionId,
            ]);

            // Store the session ID in the current browser session
            $request->session()->put('active_session_id', $sessionId);

            Log::info('User logged in successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        //Invalid Credentials
        Log::warning('Failed login attempt', [
            'email' => $email,
            'ip' => $request->ip(),
        ]);

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
