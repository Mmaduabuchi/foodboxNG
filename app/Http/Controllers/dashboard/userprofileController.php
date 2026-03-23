<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class userprofileController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        return view('dashboard.user_profile', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50',
            'phone' => ['required', 'regex:/^(?:\+234|0)[0-9]{10}$/'],
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
    
        return redirect()->route('userprofile')->with('profile_success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('password_error', 'Incorrect current password');
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('password_error', 'New password cannot be the same as old password');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('password_success', 'Password updated successfully');
    }

    public function deactivate(Request $request) {
        $user = Auth::user();

        // Mark account as inactive
        $user->is_active = false;
        $user->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Your account has been deactivated.');
    }
            
}
