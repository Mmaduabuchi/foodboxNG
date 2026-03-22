<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;

class registerController extends Controller
{
    //
    public function index(){
        return view("register");
    }

    public function store(Request $request){
        $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:11|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()]
        ]);

        do {
            $token = Str::random(36);
        } while (User::where('token', $token)->exists());

        do {
            $referral_code = Str::random(10);
        } while (User::where('referral_code', $referral_code)->exists());

        try {
            $user = User::create([
                'name' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'token' => $token,
                'referral_code' => $referral_code,
                'is_suspended' => false,
            ]);
            
            Mail::to($user->email)->send(new VerifyEmailMail($user));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong, try again']);
        }
        
        return redirect()->route('login')->with('success', 'Account created! Please check your email to verify.');
    }

    public function verifyEmail($token){
        $user = User::where('token', $token)->first();

        if(!$user){
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }

        $user->email_verified_at = now();
        // $user->token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Email verified successfully! You can now login.');
    }
}