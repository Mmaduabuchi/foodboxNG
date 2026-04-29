<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\IssueReport;
use App\Models\IssueImage;
use Illuminate\Support\Str;

class reportController extends Controller
{
    public function index(){

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Fetch up to 5 most recent delivered orders
        $deliveredOrders = $user->orders()
            ->where('delivery_status', 'delivered')
            ->with(['package', 'package.items'])
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard.report_missing_item', compact('user', 'deliveredOrders'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validated = $request->validate([
            'order_id' => 'required|integer',
            'package_id' => 'required|exists:packages,id',
            'issue_type' => 'required|in:missing_item,damaged_item,wrong_item,other',
            'description' => 'required|string|min:10',
            'affected_items' => 'nullable|array',
            'affected_items.*' => 'string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $order = $user->orders()->where('id', $validated['order_id'])->first();

        if (!$order) {
            return back()->withErrors(['order_id' => 'Invalid order selected']);
        }

        $package = $order->package;

        if (!$package) {
            return back()->withErrors(['package_id' => 'Invalid package selected']);
        }

        DB::beginTransaction();

        try {

            $report = IssueReport::create([
                'user_id' => $user->id,
                'order_id' => $validated['order_id'],
                'package_id' => $order->package_id,
                'issue_type' => $validated['issue_type'],
                'description' => $validated['description'],
                'affected_items' => $validated['affected_items'] ?? [],
                'status' => 'pending',
                'reference' => 'ISSUE-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('issue_images', 'public');
                    IssueImage::create([
                        'issue_report_id' => $report->id,
                        'image_path' => $path,
                    ]);
                }
            }


            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            // return back()->with('error', 'Failed to submit report');
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('mypackages')
            ->with('success', 'Issue reported successfully! We will get back to you within 24-48 hours.');
    }
}
