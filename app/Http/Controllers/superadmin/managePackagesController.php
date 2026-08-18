<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Package;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    //store package
    public function store(Request $request) {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'billing_cycle' => ['required', 'in:weekly,monthly'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status' => ['required', 'in:active,inactive,draft'],
        ]); 

        try {
            // Upload package image
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('package_images', $imageName, 'public');
                $validated['image'] = $imagePath;
            }

            // Save package
            $package = Package::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Package created successfully.',
                'package' => $package,
            ], 201);

        } catch (\Throwable $exception) {

            Log::error('Failed to create package.', [
                'admin_id' => Auth::id(),
                'error' => $exception->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to create package. Please try again.',
            ], 500);
        }
    }

    public function update(Request $request, $id){

        //get package
        $package = Package::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'billing_cycle' => ['required', 'in:weekly,monthly'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status' => ['required', 'in:active,inactive,draft'],
        ]);

        try {

            //Handle New Image
            if ($request->hasFile('image')) {

                // Delete old image if it exists
                if ($package->image) {
                    Storage::disk('public')->delete($package->image);
                }

                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('package_images', $imageName, 'public');

                $validated['image'] = $imagePath;
            } else {
                // Don't overwrite the existing image
                unset($validated['image']);
            }

            //Update Package
            $package->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Package updated successfully.',
                'package' => $package->fresh(),
            ]);

        } catch (\Throwable $exception) {

            Log::error('Failed to update package.', [
                'admin_id' => Auth::id(),
                'package_id' => $id,
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to update package. Please try again.',
            ], 500);
        }
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
