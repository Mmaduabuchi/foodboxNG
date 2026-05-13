<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Staff;

class adminManagementController extends Controller
{
    public function index(Request $request)
    {
        // Authenticated admin name
        $adminName = Auth::user()->name;

        // Fetch all admins
        $admins = User::where('role', 'admin')->latest()->get();

        $search = $request->query('search');

        // Fetch staffs with search
        $staffs = Staff::when($search, function($query, $search) {
            return $query->where('fullname', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        // Counts
        $adminCount = $admins->count();

        $editorCount = Staff::where('role', 'editor')->count();

        $dispatcherCount = Staff::where('role', 'dispatcher')->count();

        $supportCount = Staff::where('role', 'support')->count();
        
        return view('superAdminDashboard.adminManagement', compact(
            'adminName',
            'admins',
            'staffs',
            'adminCount',
            'editorCount',
            'dispatcherCount',
            'supportCount'
        ));
    }
}
