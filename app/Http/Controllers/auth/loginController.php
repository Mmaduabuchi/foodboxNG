<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

            // Check suspended
            if ($user->is_suspended) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been suspended. Contact support.']);
            }

            // Check email verification
            if (!$user->email_verified_at) {
                Auth::logout();
                return back()->withErrors(['email' => 'Email not verified']);
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard');
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
