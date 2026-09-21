<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class forgotpasswordController extends Controller
{
    //
    public function index(){
        return view("forgotpassword");
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);

        $email = strtolower(trim($credentials['email']));

        //Rate Limiting
        // Limit reset requests for this email + IP
        $emailRateLimitKey = 'forgot-password|' . $request->ip() . '|' . $email;

        if (RateLimiter::tooManyAttempts($emailRateLimitKey, 3)) {

            $seconds = RateLimiter::availableIn($emailRateLimitKey);

            Log::warning('Forgot password email rate limit exceeded', [
                'email' => $email,
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);


            return back()->with('status', 'If the email exists, a reset link has been sent.');
        }

        // Limit requests from the same IP
        $ipRateLimitKey = 'forgot-password-ip|' . $request->ip();

        if (RateLimiter::tooManyAttempts($ipRateLimitKey, 10)) {

            $seconds = RateLimiter::availableIn($ipRateLimitKey);

            Log::warning('Forgot password IP rate limit exceeded', [
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);

            return back()->with('status', 'If the email exists, a reset link has been sent.');
        }


        RateLimiter::hit($emailRateLimitKey, 600);
        RateLimiter::hit($ipRateLimitKey, 600);

        //Find User
        $user = User::where('email', $email)->first();

        if (!$user) {

            Log::info('Password reset requested for unknown email', [
                'email' => $email,
                'ip' => $request->ip(),
            ]);

            return back()->with('status', 'If the email exists, a reset link has been sent');
        }


        //Generate Reset Token
        try {
            // Delete old reset tokens
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            
            // Generate secure random token
            $plainToken = Str::random(60);

            // Store only the hashed token
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => Hash::make($plainToken),
                'created_at' => now(),
            ]);

            //Send Reset Email
            Mail::to($user->email)->send(new ResetPasswordMail($plainToken, $user->email));

            Log::info('Password reset email sent', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);
        } catch (\Exception $e) {
            
            Log::error('Failed to send password reset email', [
                'user_id' => $user->id ?? null,
                'email' => $email,
                'ip' => $request->ip(),
                'exception' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to send email. Try again later.');
        }

        return back()->with('status', 'If your email exists, a reset link has been sent.');
    }
}
