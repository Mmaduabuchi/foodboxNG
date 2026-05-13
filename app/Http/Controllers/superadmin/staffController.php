<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class staffController extends Controller
{
    public function store (Request $request) {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:staffs,email',
            'role' => 'required|in:editor,dispatcher,support',
            'nin' => 'required|string|max:20|unique:staffs,NIN',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Staff::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'state' => $request->state,
            'address' => $request->address,
            'NIN' => $request->nin,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'New staff member added successfully!');
    }
}
