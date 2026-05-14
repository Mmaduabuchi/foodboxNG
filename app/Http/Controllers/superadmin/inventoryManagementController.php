<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageItem;

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

        // packages with least items
        $leastItemsPackage = Package::withCount('items')
            ->orderBy('items_count', 'asc')
            ->take(3)
            ->get();

        // packages with most items
        $mostItemsPackage = Package::withCount('items')
            ->orderBy('items_count', 'desc')
            ->take(3)
            ->get();

        // Fetch all packages for the selection list
        $packages = Package::withCount(['items', 'subscriptions'])->get();

        return view('superAdminDashboard.inventoryStock', compact(
            'adminName',
            'packagesCount',
            'packageItems',
            'leastItemsPackage',
            'packages'
        ));
    }
}
