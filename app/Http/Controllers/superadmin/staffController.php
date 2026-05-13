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

        return response()->json([
            'status' => 'success',
            'message' => 'New staff member added successfully!'
        ]);
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $staff
        ]);
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:staffs,email,' . $id,
            'role' => 'required|in:editor,dispatcher,support',
            'nin' => 'required|string|max:20|unique:staffs,NIN,' . $id,
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $staff->fullname = $request->fullname;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->state = $request->state;
        $staff->address = $request->address;
        $staff->NIN = $request->nin;
        $staff->role = $request->role;

        if ($request->password) {
            $staff->password = Hash::make($request->password);
        }

        $staff->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Staff record updated successfully!'
        ]);
    }

    public function suspend($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->status = 'inactive';
        $staff->save();

        return response()->json([
            'status' => 'success',
            'message' => "{$staff->fullname} has been suspended."
        ]);
    }

    public function activate($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->status = 'active';
        $staff->save();

        return response()->json([
            'status' => 'success',
            'message' => "{$staff->fullname}'s access has been restored."
        ]);
    }
}
