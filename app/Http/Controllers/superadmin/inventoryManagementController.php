<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageItem;
use App\Models\SubPackages;

class inventoryManagementController extends Controller
{
    public function index()
    {
        $adminName = Auth::user()->name;
        $packagesCount = Package::count();
        $packageItems = PackageItem::count();
        $subpackages = SubPackages::count();

        $leastItemsPackage = SubPackages::withCount('items')
            ->orderBy('items_count', 'asc')
            ->take(3)
            ->get();

        $mostItemsPackage = SubPackages::withCount('items')
            ->orderBy('items_count', 'desc')
            ->take(3)
            ->get();

        // Load packages with their subpackages and items
        $packages = Package::with(['subPackages.items'])->withCount('subPackages')->get();

        // Default: first package's sub packages
        $activePackage = $packages->first();
        $activeSubPackages = $activePackage ? $activePackage->subPackages : collect();

        return view('superAdminDashboard.inventoryStock', compact(
            'adminName',
            'packagesCount',
            'packageItems',
            'subpackages',
            'leastItemsPackage',
            'mostItemsPackage',
            'packages',
            'activePackage',
            'activeSubPackages'
        ));
    }
}
