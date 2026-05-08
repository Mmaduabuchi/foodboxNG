<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Package;

class managePackagesController extends Controller
{
    public function index()
    {
        // Authenticated admin name
        $adminName = Auth::user()->name;

        // Statistics
        $totalPackages = Package::count();
        $activePackages = Package::active()->count();
        $inactivePackages = Package::inactive()->count();
        $draftPackages = Package::draft()->count();

        // Get Top Seller (Most Subscribed Package)
        $topSeller = Package::withCount('subscriptions')
            ->orderBy('subscriptions_count', 'desc')
            ->first();

        // Paginated Packages for Table
        $packages = Package::withCount('subscriptions')
            ->latest()
            ->paginate(10);

        return view('superAdminDashboard.managePackages', compact(
            'adminName',
            'totalPackages',
            'activePackages',
            'inactivePackages',
            'draftPackages',
            'topSeller',
            'packages'
        ));
    }

    public function deactivate($id) {
        $package = Package::findOrFail($id);
        $package->status = Package::STATUS_INACTIVE;
        $package->save();

        return redirect()->back()->with('success', 'Package deactivated successfully');
    }

    public function activate($id) {
        $package = Package::findOrFail($id);
        $package->status = Package::STATUS_ACTIVE;
        $package->save();

        return redirect()->back()->with('success', 'Package activated successfully');
    }

    public function destroy($id) {
        $package = Package::findOrFail($id);

        $package->delete();

        return redirect()->back()->with('success', 'Package deleted successfully');
    }
}
