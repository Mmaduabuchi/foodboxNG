<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class userManagementController extends Controller
{
    public function index(Request $request)
    {
        // Authenticated admin name
        $adminName = Auth::user()->name;

        // Total user stats
        $totalUsers = User::where('role', 'user')->count();

        // Active users (not suspended)
        $activeUsers = User::where('role', 'user')
            ->where('is_suspended', false)
            ->count();

        $activeUsersPercent = $totalUsers > 0
            ? round(($activeUsers / $totalUsers) * 100, 1)
            : 0;

        // Suspended users
        $suspendedUsers = User::where('role', 'user')
            ->where('is_suspended', true)
            ->count();

        // Users who have placed orders
        $usersWithOrders = User::whereHas('orders')
            ->where('role', 'user')
            ->count();

        // Users with active subscriptions
        $usersWithSubscriptions = User::whereHas('subscriptions', function ($query) {
            $query->where('status', 'active');
        })->where('role', 'user')->count();

        $newUsersThisMonth = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Users who have never placed an order
        $newUsers = User::whereDoesntHave('orders')->where('role', 'user')->count();

        //User Management Table with Filtering
        $query = User::where('role', 'user');

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Role Filter
        if ($request->filled('role') && $request->role !== 'All Roles') {
            $roleValue = strtolower(str_replace(' ', '_', $request->role));
            // "Customer" -> "user", "Admin" -> "admin", "Delivery Agent" -> "delivery_agent"
            if ($roleValue === 'customer') $roleValue = 'user';
            $query->where('role', $roleValue);
        }

        // Status Filter
        if ($request->filled('status') && $request->status !== 'All Statuses') {
            if ($request->status === 'Active') {
                $query->where('is_suspended', false);
            } elseif ($request->status === 'Inactive') {
                // Following existing logic where suspended != active.
                $query->where('is_suspended', true);
            } elseif ($request->status === 'Banned') {
                $query->where('is_suspended', true);
            }
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('superAdminDashboard.usersManagement', compact(
            'adminName',
            'totalUsers',
            'activeUsers',
            'activeUsersPercent',
            'suspendedUsers',
            'newUsersThisMonth',
            'usersWithOrders',
            'usersWithSubscriptions',
            'newUsers',
            'users'
        ));
    }

    // Toggle user suspension
    public function toggleSuspend(Request $request)
    {
        // $request->validate([
        //     'id' => 'required|integer|exists:users,id',
        // ]);

        $user = User::find($request->id);

        if (!$user) {

            Log::warning('Admin attempted to suspend/activate nonexistent user', [
                'target_user_id' => $request->id,
                'admin_user_id' => Auth::id(),
                'ip' => $request->ip(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Prevent an admin from accidentally suspending another admin
        if ($user->role === 'admin') {
            Log::warning('Admin attempted to modify another admin account status', [
                'target_user_id' => $user->id,
                'target_email' => $user->email,
                'admin_user_id' => Auth::id(),
                'ip' => $request->ip(),
            ]);

            return back()->with(
                'error',
                'Admin accounts cannot be suspended from this section.'
            );
        }
        
        // Capture current status
        $oldSuspendStatus = (bool) $user->is_suspended;
        // Toggle status
        $newSuspendStatus = !$user->is_suspended;

        // Update account status
        $user->update([
            'is_suspended' => $newSuspendStatus,
            'is_active' => !$newSuspendStatus,
        ]);

        // Log the status change
        Log::info(
            $newSuspendStatus
                ? 'User account suspended by admin'
                : 'User account activated by admin',
            [
                'admin_user_id' => Auth::id(),
                'target_user_id' => $user->id,
                'target_email' => $user->email,
                'previous_suspended_status' => $oldSuspendStatus,
                'new_suspended_status' => $newSuspendStatus,
                'new_active_status' => !$newSuspendStatus,
                'ip' => $request->ip(),
            ]
        );

        return back()->with(
            'success',
            $newSuspendStatus
                ? 'User suspended successfully'
                : 'User activated successfully'
        );
    }

    public function export(Request $request) {

        //Validate Export Filters
        $validated = $request->validate([
            'search' => [
                'nullable',
                'string',
                'max:100',
            ],

            'role' => [
                'nullable',
                'string',
                'max:50',
            ],

            'status' => [
                'nullable',
                'string',
                'max:50',
            ],
        ]);

        try {
            
            //Build Query
            $query = User::where('role', 'user');

            // Search Filter
            if (!empty($validated['search'])) {
                $search = trim($validated['search']);
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
                });
            }

            // Role Filter
            if (!empty($validated['role']) && $validated['role'] !== 'All Roles') {
                $roleValue = strtolower(str_replace(' ', '_', $validated['role']));
                if ($roleValue === 'customer') $roleValue = 'user';

                // Since this export is specifically for users,
                // don't allow another role to be exported.
                if ($roleValue !== 'user') {

                    Log::warning('Admin attempted invalid role filter during user export', [
                        'admin_user_id' => Auth::id(),
                        'requested_role' => $validated['role'],
                        'ip' => $request->ip(),
                    ]);

                    return back()->withErrors([
                        'role' => 'Invalid role filter.',
                    ]);
                }
                
                $query->where('role', $roleValue);
            }

            // Status Filter
            if (!empty($validated['status']) && $validated['status'] !== 'All Statuses') {
                if ($validated['status'] === 'Active') {
                    $query->where('is_suspended', false);
                } elseif ($validated['status'] === 'Inactive' || $validated['status'] === 'Banned') {
                    $query->where('is_suspended', true);
                } else {

                    Log::warning('Admin attempted invalid status filter during user export', [
                        'admin_user_id' => Auth::id(),
                        'requested_status' => $validated['status'],
                        'ip' => $request->ip(),
                    ]);

                    return back()->withErrors([
                        'status' => 'Invalid status filter.',
                    ]);
                }
            }

            //Retrieve Users
            $users = $query->latest()->get();

            //Audit Log
            Log::info('Admin exported users CSV', [
                'admin_user_id' => Auth::id(),
                'ip' => $request->ip(),
                'user_count' => $users->count(),
                'filters' => [
                    'search' => !empty($validated['search'])
                        ? '[FILTERED]'
                        : null,
                    'role' => $validated['role'] ?? null,
                    'status' => $validated['status'] ?? null,
                ],
            ]);


            //CSV Response
            $filename = 'users_export_' . now()->format('Y-m-d_H-i-s') . '.csv';
            $headers = [
                'Content-type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
                'Expires' => '0'
            ];

            $columns = ['User ID', 'Name', 'Email', 'Phone', 'Role', 'Status', 'Registered Date', 'Last Updated'];

            $callback = function() use ($users, $columns) {
                $file = fopen('php://output', 'w');

                if ($file === false) {
                    throw new \RuntimeException(
                        'Unable to open output stream for CSV export.'
                    );
                }

                fputcsv($file, $columns);

                foreach ($users as $user) {
                    $row['User ID'] = 'UID-' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
                    $row['Name'] = $user->name;
                    $row['Email'] = $user->email;
                    $row['Phone'] = $user->phone ?? '—';
                    $row['Role'] = ucfirst(str_replace('_', ' ', $user->role));
                    $row['Status'] = $user->is_suspended ? 'Suspended' : 'Active';
                    $row['Registered Date'] = $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '—';
                    $row['Last Updated'] = $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : '—';

                    fputcsv($file, array_values($row));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);


        } catch (\Throwable $e) {

            Log::error('Admin user CSV export failed', [
                'admin_user_id' => Auth::id(),
                'ip' => $request->ip(),
                'exception' => $e->getMessage(),
            ]);

            return back()->withErrors([
                'error' => 'Unable to export users at this time. Please try again.',
            ]);
        }
    }
}
