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
        // Authenticated admin name
        $adminName = Auth::user()->name;

        //all packages 
        $packagesCount = Package::count();

        //all package items
        $packageItems = PackageItem::count();

        //all package items
        $subpackages = SubPackages::count();

        // packages with least items
        $leastItemsPackage = SubPackages::withCount('items')
            ->orderBy('items_count', 'asc')
            ->take(3)
            ->get();

        // packages with most items
        $mostItemsPackage = SubPackages::withCount('items')
            ->orderBy('items_count', 'desc')
            ->take(3)
            ->get();

        // Fetch all packages for the selection list
        $packages = SubPackages::withCount(['items', 'subscriptions'])->get();

        return view('superAdminDashboard.inventoryStock', compact(
            'adminName',
            'packagesCount',
            'packageItems',
            'leastItemsPackage',
            'packages',
            'subpackages'
        ));
    }
}
