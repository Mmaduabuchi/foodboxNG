<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class userprofileController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        return view('dashboard.user_profile', compact('user'));
    }

    //update profile
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

    //update password
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


    //update profile image
    public function uploadProfileImage(Request $request) {

        try {

            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $user = Auth::user();

            // Delete old image if it exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Store new image
            $path = $request->file('profile_image')->store('profile-images', 'public');

            $user->update([
                'profile_image' => $path,
            ]);

            return redirect()->back()->with('profile_success_image', 'Profile image updated successfully.');

        } catch (\Exception $e) {

            return back()->with(
                'profile_error_image',
                'Unable to upload profile image. Please try again.'
            );
        }
    }


    //update notifications
    public function updateNotifications(Request $request) {
        try {
            
            $user = Auth::user();

            $user->update([
                'delivery_notifications' => $request->has('delivery_notifications'),
                'billing_notifications' => $request->has('billing_notifications'),
                'marketing_notifications' => $request->has('marketing_notifications'),
            ]);

            return redirect()->back()->with(
                'notification_success',
                'Notification preferences updated successfully.'
            );

            
        } catch (\Exception $e) {

            return back()->with(
                'notification_error',
                'Unable to update notification preferences. Please try again.'
            );
        }
    }

    //deactivate account
    public function deactivate(Request $request) {
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }

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
