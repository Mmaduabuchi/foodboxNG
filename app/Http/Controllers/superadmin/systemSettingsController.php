<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CustomerSupportEmail;
use Illuminate\Support\Facades\Hash;

class systemSettingsController extends Controller
{
    public function index()
    {
        // Authenticated admin name
        $adminName = Auth::user()->name;

        $customerSupport = CustomerSupportEmail::first();

        return view('superAdminDashboard.systemSettings', compact(
            'adminName',
            'customerSupport'
        ));
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect'
            ]);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect
        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function updateCustomerSupport(Request $request) {
        $validated = $request->validate([
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
        ]);

        CustomerSupportEmail::updateOrCreate(
            ['id' => 1],
            [
                'email' => $validated['contact_email'],
                'phone' => $validated['contact_phone'],
            ]
        );

        return response()->json([
            'status' => "success",
            'message' => 'Customer support info updated successfully!',
        ]);
    }
}
