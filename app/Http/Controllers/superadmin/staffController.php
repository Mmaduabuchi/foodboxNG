<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Throwable;

class staffController extends Controller
{
    public function store (Request $request) {

        //Normalize Input
        $request->merge([
            'fullname' => trim($request->input('fullname', '')),
            'phone' => trim($request->input('phone', '')),
            'email' => strtolower(trim($request->input('email', ''))),
            'nin' => trim($request->input('nin', '')),
            'address' => trim($request->input('address', '')),
            'state' => trim($request->input('state', '')),
        ]);

        //Rate Limiting
        $rateLimitKey = 'staff-create:' . (
            Auth::id() ?? $request->ip()
        );

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Staff creation rate limit exceeded.', [
                'user_id' => Auth::id(),
                'ip' => $request->ip(),
                'seconds_remaining' => $seconds,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => "Too many staff creation attempts. Please try again in {$seconds} seconds.",
            ], 429);
        }



        //Validation
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:staffs,phone',
                'unique:users,phone',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:staffs,email',
                'unique:users,email',
            ],
            'role' => [
                'required',
                Rule::in([
                    'editor',
                    'dispatcher',
                    'support',
                ]),
            ],
            'nin' => 'required|string|max:20|unique:staffs,NIN',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        // Count Creation Attempt
        RateLimiter::hit($rateLimitKey, 60);

        //Create Staff
        try {

            $staff = DB::transaction(function () use ($validated) {

                return Staff::create([
                    'fullname' => $validated['fullname'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'state' => $validated['state'],
                    'address' => $validated['address'],
                    'NIN' => $validated['nin'],
                    'password' => Hash::make($validated['password']),
                    'role' => $validated['role'],
                    'status' => 'active',
                ]);
            });

            //Success Log
            Log::info('New staff member created successfully.', [
                'staff_id' => $staff->id,
                'staff_email' => $staff->email,
                'role' => $staff->role,
                'created_by' => Auth::id(),
                'ip' => $request->ip(),
            ]);

            //Response
            return response()->json([
                'status' => 'success',
                'message' => 'New staff member added successfully!',
                'data' => [
                    'id' => $staff->id,
                    'fullname' => $staff->fullname,
                    'email' => $staff->email,
                    'phone' => $staff->phone,
                    'role' => $staff->role,
                    'status' => $staff->status,
                ],
            ], 201);
        
        } catch (Throwable $e) {
            //Error Log
            Log::error('Failed to create new staff member.', [
                'created_by' => Auth::id(),
                'ip' => $request->ip(),
                'email' => $validated['email'] ?? null,
                'role' => $validated['role'] ?? null,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ]);

            //Error Response
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to create staff member at the moment. Please try again later.',
            ], 500);
        }
    }

    // public function edit($id)
    // {
    //     $staff = Staff::findOrFail($id);
    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $staff
    //     ]);
    // }


    public function edit(Request $request, $id)
    {

        //Rate Limiting
        $rateLimitKey = 'staff-edit:' . (
            Auth::id() ?? $request->ip()
        );

        if (RateLimiter::tooManyAttempts($rateLimitKey, 30)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Staff edit rate limit exceeded.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
                'seconds_remaining' => $seconds,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => "Too many requests. Please try again in {$seconds} seconds.",
            ], 429);
        }

        RateLimiter::hit($rateLimitKey, 60);


        //Find Staff
        $staff = Staff::find($id);

        if (!$staff) {

            Log::warning('Attempt to retrieve non-existent staff for editing.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Staff member not found.',
            ], 404);
        }

        //Success Log
        Log::info('Staff record retrieved for editing.', [
            'staff_id' => $staff->id,
            'admin_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);


        //Response
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $staff->id,
                'fullname' => $staff->fullname,
                'email' => $staff->email,
                'phone' => $staff->phone,
                'role' => $staff->role,
                'NIN' => $staff->NIN,
                'address' => $staff->address,
                'state' => $staff->state,
                'status' => $staff->status,
            ],
        ], 200);
    }

    // public function update(Request $request, $id)
    // {
    //     $staff = Staff::findOrFail($id);

    //     $request->validate([
    //         'fullname' => 'required|string|max:255',
    //         'phone' => 'required|string|max:20',
    //         'email' => 'required|email|unique:staffs,email,' . $id,
    //         'role' => 'required|in:editor,dispatcher,support',
    //         'nin' => 'required|string|max:20|unique:staffs,NIN,' . $id,
    //         'address' => 'required|string|max:255',
    //         'state' => 'required|string|max:100',
    //         'password' => 'nullable|string|min:6|confirmed',
    //     ]);

    //     $staff->fullname = $request->fullname;
    //     $staff->email = $request->email;
    //     $staff->phone = $request->phone;
    //     $staff->state = $request->state;
    //     $staff->address = $request->address;
    //     $staff->NIN = $request->nin;
    //     $staff->role = $request->role;

    //     if ($request->password) {
    //         $staff->password = Hash::make($request->password);
    //     }

    //     $staff->save();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Staff record updated successfully!'
    //     ]);
    // }


    public function update(Request $request, $id) {
        
        //Rate Limiting
        $rateLimitKey = 'staff-update:' . (
            Auth::id() ?? $request->ip()
        );

        if (RateLimiter::tooManyAttempts($rateLimitKey, 10)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Staff update rate limit exceeded.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
                'seconds_remaining' => $seconds,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => "Too many update attempts. Please try again in {$seconds} seconds.",
            ], 429);
        }


        //Find Staff
        $staff = Staff::find($id);

        if (!$staff) {

            Log::warning('Attempt to update non-existent staff.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Staff member not found.',
            ], 404);
        }


        //Normalize Input
        $request->merge([
            'fullname' => trim($request->input('fullname', '')),
            'phone' => trim($request->input('phone', '')),
            'email' => strtolower(trim($request->input('email', ''))),
            'nin' => trim($request->input('nin', '')),
            'address' => trim($request->input('address', '')),
            'state' => trim($request->input('state', '')),
        ]);


        //Validation
        $validated = $request->validate([

            'fullname' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:staffs,phone,' . $id,
                'unique:users,phone',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:staffs,email,' . $id,
                'unique:users,email',
            ],

            'role' => [
                'required',
                Rule::in([
                    'editor',
                    'dispatcher',
                    'support',
                ]),
            ],

            'nin' => [
                'required',
                'string',
                'max:20',
                'unique:staffs,NIN,' . $id,
            ],

            'address' => [
                'required',
                'string',
                'max:255',
            ],

            'state' => [
                'required',
                'string',
                'max:100',
            ],

            'password' => [
                'nullable',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);


        //Count Update Attempt
        RateLimiter::hit($rateLimitKey, 60);


        //Update Staff
        try {

            DB::transaction(function () use ($staff, $validated) {

                $staff->fullname = $validated['fullname'];
                $staff->email = $validated['email'];
                $staff->phone = $validated['phone'];
                $staff->state = $validated['state'];
                $staff->address = $validated['address'];
                $staff->NIN = $validated['nin'];
                $staff->role = $validated['role'];


                //Update Password Only If Supplied
                if (!empty($validated['password'])) {

                    $staff->password = Hash::make(
                        $validated['password']
                    );
                }

                $staff->save();
            });


            //Success Log
            Log::info('Staff record updated successfully.', [
                'staff_id' => $staff->id,
                'staff_email' => $staff->email,
                'staff_role' => $staff->role,
                'updated_by' => Auth::id(),
                'ip' => $request->ip(),
                'password_changed' => !empty($validated['password']),
            ]);


            //Response
            return response()->json([
                'status' => 'success',
                'message' => 'Staff record updated successfully!',
            ], 200);


        } catch (Throwable $e) {

            //Error Log
            Log::error('Failed to update staff record.', [
                'staff_id' => $staff->id,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ]);


            //Error Response
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to update staff record at the moment. Please try again later.',
            ], 500);
        }
    }

    public function suspend(Request $request, $id) {

        //Rate Limiting
        $rateLimitKey = 'staff-suspend:' . (
            Auth::id() ?? $request->ip()
        );

        if (RateLimiter::tooManyAttempts($rateLimitKey, 10)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Staff suspension rate limit exceeded.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
                'seconds_remaining' => $seconds,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => "Too many suspension attempts. Please try again in {$seconds} seconds.",
            ], 429);
        }


        //Find Staff
        $staff = Staff::find($id);

        if (!$staff) {

            Log::warning('Attempt to suspend non-existent staff.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Staff member not found.',
            ], 404);
        }

        //Prevent Unnecessary Action
        if ($staff->status === 'inactive') {

            return response()->json([
                'status' => 'error',
                'message' => "{$staff->fullname} is already suspended.",
            ], 422);
        }

        //Count Actual Suspension Attempt
        RateLimiter::hit($rateLimitKey, 60);

        // Suspend Staff
        try {

            DB::transaction(function () use ($staff) {

                $staff->update([
                    'status' => 'inactive',
                ]);
            });

            //Activity Log
            Log::info('Staff member suspended successfully.', [
                'staff_id' => $staff->id,
                'staff_email' => $staff->email,
                'staff_role' => $staff->role,
                'previous_status' => 'active',
                'new_status' => 'inactive',
                'suspended_by' => Auth::id(),
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => "{$staff->fullname} has been suspended.",
            ], 200);

        } catch (Throwable $e) {

            Log::error('Failed to suspend staff member.', [
                'staff_id' => $staff->id,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to suspend staff member at the moment. Please try again later.',
            ], 500);
        }

    }

    public function activate(Request $request, $id) {

        //Rate Limiting
        $rateLimitKey = 'staff-activate:' . (
            Auth::id() ?? $request->ip()
        );

        if (RateLimiter::tooManyAttempts($rateLimitKey, 10)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Staff activation rate limit exceeded.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
                'seconds_remaining' => $seconds,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => "Too many activation attempts. Please try again in {$seconds} seconds.",
            ], 429);
        }
        

        //Find Staff
        $staff = Staff::find($id);

        if (!$staff) {

            Log::warning('Attempt to activate non-existent staff.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Staff member not found.',
            ], 404);
        }

        //Prevent Unnecessary Action
        if ($staff->status === 'active') {

            return response()->json([
                'status' => 'error',
                'message' => "{$staff->fullname} is already active.",
            ], 422);
        }

        // Count Actual Activation Attempt
        RateLimiter::hit($rateLimitKey, 60);

        //Activate Staff
        try {

            DB::transaction(function () use ($staff) {

                $staff->update([
                    'status' => 'active',
                ]);
            });
        
            //Activity Log
            Log::info('Staff member activated successfully.', [
                'staff_id' => $staff->id,
                'staff_email' => $staff->email,
                'staff_role' => $staff->role,
                'previous_status' => 'inactive',
                'new_status' => 'active',
                'activated_by' => Auth::id(),
                'ip' => $request->ip(),
            ]);


            return response()->json([
                'status' => 'success',
                'message' => "{$staff->fullname}'s access has been restored.",
            ], 200);

        } catch (Throwable $e) {
            
            Log::error('Failed to activate staff member.', [
                'staff_id' => $staff->id,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to activate staff member at the moment. Please try again later.',
            ], 500);
        }
    }



    public function destroy(Request $request, $id) {

        //Rate Limiting
        $rateLimitKey = 'staff-delete:' . (
            Auth::id() ?? $request->ip()
        );

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {

            $seconds = RateLimiter::availableIn($rateLimitKey);

            Log::warning('Staff deletion rate limit exceeded.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
                'seconds_remaining' => $seconds,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => "Too many deletion attempts. Please try again in {$seconds} seconds.",
            ], 429);
        }


        //Find Staff
        $staff = Staff::find($id);

        if (!$staff) {

            Log::warning('Attempt to delete non-existent staff.', [
                'admin_id' => Auth::id(),
                'staff_id' => $id,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Staff member not found.',
            ], 404);
        }


        //Prevent Deleting Current Staff/Admin
        if ($staff->id === Auth::id()) {

            Log::warning('Admin attempted to delete their own staff account.', [
                'admin_id' => Auth::id(),
                'staff_id' => $staff->id,
                'ip' => $request->ip(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'You cannot delete your own account.',
            ], 403);
        }


        //Count Actual Delete Attempt
        RateLimiter::hit($rateLimitKey, 60);


        //Delete Staff
        try {

            DB::transaction(function () use ($staff) {
                $staff->delete();
            });



            // Activity Log
            Log::info('Staff member deleted successfully.', [
                'staff_id' => $staff->id,
                'staff_email' => $staff->email,
                'staff_role' => $staff->role,
                'deleted_by' => Auth::id(),
                'ip' => $request->ip(),
            ]);


            return response()->json([
                'status' => 'success',
                'message' => "{$staff->fullname} has been deleted successfully.",
            ], 200);

        } catch (Throwable $e) {

            Log::error('Failed to delete staff member.', [
                'staff_id' => $staff->id,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete staff member at the moment. Please try again later.',
            ], 500);
        }
    }
}