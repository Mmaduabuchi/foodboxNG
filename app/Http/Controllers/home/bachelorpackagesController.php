<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Package;

class bachelorpackagesController extends Controller
{
    public function index()
    {
        $bachelorPackages = Package::where('category', 'bachelor')
            ->with([
                'subPackages' => function ($query) {

                    $query->where('status', 'active')
                        ->where('is_available', 1)
                        ->with('items');
                }
            ])
            ->get();

        return view('bachelor', compact('bachelorPackages'));
    }
}