<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\SubPackages;

class subPackageDetailController extends Controller
{
    public function show($id)
    {
        $subPackage = SubPackages::with(['items', 'package'])
            ->where('status', 'active')
            ->where('is_available', 1)
            ->findOrFail($id);

        return view('subpackage_detail', compact('subPackage'));
    }
}
