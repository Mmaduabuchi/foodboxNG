<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageItem;
use App\Models\SubPackages;

class PackageItemController extends Controller
{
    //
    public function store(Request $request) { 
        $validated = $request->validate([
            'sub_package_id' => 'required|exists:sub_packages,id',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'estimated_price' => 'required|numeric|min:0',
        ]);

        $item = PackageItem::create([ 
            'sub_package_id' => $validated['sub_package_id'],
            'item_name' => $validated['item_name'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'], 
            'estimated_price' => $validated['estimated_price'], 
        ]); 
            
        return response()->json([ 
            'success' => true, 
            'message' => 'Package item created successfully.',
            'item' => $item 
        ], 201); 
    }

    public function destroy(PackageItem $item) {
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully.'
        ]);
    }

}