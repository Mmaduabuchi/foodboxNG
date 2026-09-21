<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\RateLimiter;

class registerController extends Controller
{
    //
    public function index(){
        return view("register");
    }

    public function store(Request $request){

        $email = strtolower(trim($request->email ?? ''));

        // Overall IP protection
        $ipKey = 'register-ip|' . $request->ip();

        if (RateLimiter::tooManyAttempts($ipKey, 20)) {
            $seconds = RateLimiter::availableIn($ipKey);

            Log::warning('Registration rate limit exceeded', [
                'ip' => $request->ip(),
                'email' => $email,
                'retry_after' => $seconds,
            ]);

            return back()
                ->withErrors([
                    'error' => "Too many registration attempts from this network. Please try again in {$seconds} seconds.",
                ]);
        }

        // IP + email protection
        $rateLimitKey = 'register|' . $request->ip() . '|' . $email;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Registration email rate limit exceeded', [
                'ip' => $request->ip(),
                'email' => $email,
                'retry_after' => $seconds,
            ]);

            return back()
                ->withInput($request->except([
                    'password',
                    'password_confirmation',
                ]))
                ->withErrors([
                    'error' => "Too many registration attempts. Please try again in {$seconds} seconds.",
                ]);
        }

        // Count this attempt
        RateLimiter::hit($ipKey, 60);
        RateLimiter::hit($rateLimitKey, 60);


        $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:11|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()]
        ]);

        // Normalize name
        $name = trim($request->fullname);

        // Generate a secure email verification token
        $verificationToken = Str::random(64);

        // Store only the hash in the database
        $verificationTokenHash = hash(
            'sha256',
            $verificationToken
        );

        // Token expires after 24 hours
        $verificationExpiresAt = now()->addHours(24);

        // Generate unique token
        do {
            $token = Str::random(36);
        } while (User::where('token', $token)->exists());

        // Generate unique referral code
        do {
            $referralCode = Str::upper(Str::random(10));
        } while (User::where('referral_code', $referralCode)->exists());

        try {
            $user = User::create([
                'name' => $name,
                'phone' => trim($request->phone),
                'email' => $email,
                'password' => $request->password,

                'email_verification_token_hash' => $verificationTokenHash,
                'email_verification_expires_at' => $verificationExpiresAt,

                'token' => $token,
                'referral_code' => $referralCode,

                'is_suspended' => false,
                'is_active' => true,
                'role' => "user",
            ]);
            
            // Send the RAW token to the user.
            // The database only contains the hash.
            Mail::to($user->email)->send(new VerifyEmailMail($user, $verificationToken));

        } catch (QueryException $e) {
            Log::error('FOODBOXNG registration failed', [
                'email' => $email,
                'exception' => $e->getMessage(),
            ]);

            return back()
                ->withInput(
                        $request->except([
                            'password',
                            'password_confirmation',
                        ])
                    )
                ->withErrors(['error' => 'Something went wrong, try again']);
        }
        
        return redirect()->route('login')->with('success', 'Account created! Please check your email to verify.');
    }

    public function verifyEmail(Request $request, $token){

        // Rate limit email verification attempts by IP
        $rateLimitKey = 'verify-email|' . $request->ip();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 10)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Email verification rate limit exceeded', [
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    "Too many verification attempts. Please try again in {$seconds} seconds."
                );
        }

        RateLimiter::hit($rateLimitKey, 60);

        // Hash the token received from the email
        $tokenHash = hash(
            'sha256',
            $token
        );

        // Find the user using the hashed token
        $user = User::where('email_verification_token_hash', $tokenHash)->first();

        if(!$user){
            Log::warning('Invalid email verification attempt', [
                'ip' => $request->ip(),
            ]);
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }

        // Check if already verified
        if ($user->email_verified_at) {
            Log::info('Already verified email link accessed', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Your email is already verified.'
                );
        }

        // Check token expiration
        if (
            !$user->email_verification_expires_at ||
            now()->greaterThan(
                $user->email_verification_expires_at
            )
        ) {
            Log::warning('Expired email verification link used', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'This verification link has expired. Please request a new one.'
                );
        }
        
        // Verify email and invalidate the token
        $user->update([
            'email_verified_at' => now(),
            'email_verification_token_hash' => null,
            'email_verification_expires_at' => null,
        ]);

        Log::info('User email verified successfully', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('login')->with('success', 'Email verified successfully! You can now login.');
    }
}