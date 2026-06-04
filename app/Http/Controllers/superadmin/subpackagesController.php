<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\SubPackages;
use Illuminate\Http\Request;

class subpackagesController extends Controller
{
    /**
     * Store a newly created sub package.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'billing_cycle' => 'required|in:daily,weekly,monthly',
            'status' => 'nullable|in:active,inactive,draft',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subpackages', 'public');
        }

        $subPackage = SubPackages::create([
            'package_id' => $validated['package_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'billing_cycle' => $validated['billing_cycle'],
            'status' => $validated['status'] ?? 'active',
            'image' => $imagePath,
            'is_available' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sub package created successfully!',
            'subPackage' => $subPackage,
        ]);
    }

    /**
     * Delete a sub package.
     */
    public function destroy($id)
    {
        $subPackage = SubPackages::findOrFail($id);
        $subPackage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sub package deleted successfully!',
        ]);
    }
}
