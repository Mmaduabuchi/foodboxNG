<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageAdminMail;
use App\Mail\ContactMessageUserMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class contactusController extends Controller
{
    public function index(){
        return view('contact_us');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[\pL\s\'\-\.]+$/u',
            ],

            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'regex:/^\+?[0-9\s\-\(\)]{7,20}$/',
            ],

            'subject' => [
                'required',
                'string',
                'max:100',
                'in:General Inquiry,Package Recommendation,Order Placement,Order Issue,Delivery Inquiry,Subscription Help,Payment Issue,Order Cancellation or Modification,Complaint or Feedback,Business & Partnership',
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:2000',
            ],
        ]);


        DB::beginTransaction();
        
        try {

            // Save message
            $contact = ContactMessage::create($validated);

            // Email customer
            Mail::to($contact->email)
                ->send(new ContactMessageUserMail($contact));

            // Email admin
            Mail::to(config('mail.admin_address'))
                ->send(new ContactMessageAdminMail($contact));


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully. We will get back to you shortly.'
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            //log err
            Log::error($e);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while sending your message. Please try again later.'
            ], 500);
        }
    }

}
