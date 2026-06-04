<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $user = User::find($request->id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $newSuspendStatus = !$user->is_suspended;

        $user->update([
            'is_suspended' => $newSuspendStatus,
            'is_active' => !$newSuspendStatus,
        ]);

        return back()->with(
            'success',
            $newSuspendStatus
                ? 'User suspended successfully'
                : 'User activated successfully'
        );
    }

    public function export(Request $request)
    {
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
            if ($roleValue === 'customer') $roleValue = 'user';
            $query->where('role', $roleValue);
        }

        // Status Filter
        if ($request->filled('status') && $request->status !== 'All Statuses') {
            if ($request->status === 'Active') {
                $query->where('is_suspended', false);
            } elseif ($request->status === 'Inactive' || $request->status === 'Banned') {
                $query->where('is_suspended', true);
            }
        }

        $users = $query->latest()->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=users_export_' . now()->format('Y-m-d_H-i-s') . '.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['User ID', 'Name', 'Email', 'Phone', 'Role', 'Status', 'Registered Date', 'Last Updated'];

        $callback = function() use ($users, $columns) {
            $file = fopen('php://output', 'w');
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
    }
}
