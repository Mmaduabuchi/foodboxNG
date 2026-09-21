<?php

namespace App\Http\Controllers\secure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class loginController extends Controller
{
    //
    public function index(){
        return view('superAdminAuth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Normalize Email
        $email = strtolower(trim($request->email));

        // Rate Limiting
        // Limit attempts for this email + IP
        $emailRateLimitKey = 'admin-login|' . $request->ip() . '|' . $email;

        if (RateLimiter::tooManyAttempts($emailRateLimitKey, 5)) {

            $seconds = RateLimiter::availableIn($emailRateLimitKey);

            Log::warning('Admin login rate limit exceeded', [
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
        $ipRateLimitKey = 'admin-login-ip|' . $request->ip();

        if (RateLimiter::tooManyAttempts($ipRateLimitKey, 10)) {

            $seconds = RateLimiter::availableIn($ipRateLimitKey);

            Log::warning('Admin login IP rate limit exceeded', [
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many login attempts from this network. Please try again in {$seconds} seconds.",
                ]);
        }


        // Count this attempt
        RateLimiter::hit($emailRateLimitKey, 60);
        RateLimiter::hit($ipRateLimitKey, 60);


        //Authenticate Admin
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ];

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            //Check Admin Account Status
            if (!$user->is_active) {

                Log::warning('Deactivated admin attempted login', [
                    'admin_user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);

                Auth::logout();

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Your admin account has been deactivated.',
                    ]);
            }


            if ($user->is_suspended) {

                Log::warning('Suspended admin attempted login', [
                    'admin_user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);

                Auth::logout();

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Your admin account has been suspended.',
                    ]);
            }

            //Regenerate Session
            $request->session()->regenerate();

            //Clear Email Rate Limit
            RateLimiter::clear($emailRateLimitKey);

            //Log Successful Admin Login
            Log::info('Admin logged in successfully', [
                'admin_user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            return redirect()->route('admin.dashboard');
        }

        //Invalid Credentials
        Log::warning('Failed admin login attempt', [
            'email' => $email,
            'ip' => $request->ip(),
        ]);

        return redirect()->back()->with('error', 'Invalid admin credentials');
    }
}
