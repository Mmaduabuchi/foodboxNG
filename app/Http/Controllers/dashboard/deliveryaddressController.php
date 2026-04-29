<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class deliveryaddressController extends Controller
{
    //
    public function index(){
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $addresses = Address::where('user_id', Auth::id())->get();
        
        return view('dashboard.delivery_address', compact(
            'user',
            'addresses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:15',
            'recipient_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'is_default' => 'boolean',
        ]);

        if ($request->is_default) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        $address = Address::create([
            'user_id' => Auth::id(),
            'label' => $request->label,
            'recipient_name' => $request->recipient_name,
            'phone' => $request->phone,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'is_default' => $request->is_default ?? false,
        ]);

        return back()->with('success', 'Address added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:15',
            'recipient_name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^(?:\+234|0)[0-9]{10}$/'],
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        //get the address
        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        //handle default address
        $validated['is_default'] = $request->has('is_default');

        if ($validated['is_default']) {
            Address::where('user_id', Auth::id())->where('id', '!=', $id)->update(['is_default' => false]);
        }

        $address->update($validated);

        //return back with success message
        return back()->with('success', 'Address updated successfully!');
    }

    public function destroy($id)
    {
        //get the user id
        $userId = Auth::id();

        // get the address
        $address = Address::where('id', $id)->where('user_id', $userId)->firstOrFail();
        $address->delete();

        // if the deleted address was the default address, set the next address as default
        if ($address->is_default) {
            $nextAddress = Address::where('user_id', $userId)->first();
            if ($nextAddress) {
                $nextAddress->update(['is_default' => true]);
            }
        }
        return back()->with('success', 'Address deleted successfully!');
    }

    public function makeDefault($id)
    {
        //get the user id
        $userId = Auth::id();

        $address = Address::where('id', $id)->where('user_id', $userId)->firstOrFail();
        Address::where('user_id', $userId)->update(['is_default' => false]);
        $address->update(['is_default' => true]);
        return back()->with('success', 'Default address updated successfully!');
    }
}