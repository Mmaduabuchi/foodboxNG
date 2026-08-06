<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageAdminMail;
use App\Mail\ContactMessageUserMail;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Exception;

class usersupportController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tickets = SupportTicket::where('user_id', auth()->id())->latest()->paginate(10);
        
        return view('dashboard.usersupport', compact('user', 'tickets'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'subject' => [
                'required',
                'string',
                'max:100',
                'in:Order Placement & Delivery Issue,Subscription Package & Billing,Produce Quality & Freshness Guarantee,Delivery Address Modification,Payment Confirmation & Receipts,Account Security & Login Help,General Inquiry or Feedback',
            ],

            'priority' => [
                'required',
                'in:Low,Medium,High',
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120', // 5MB
            ],
        ], [
            'subject.in' => 'Please select a valid support category.',
            'priority.in' => 'Please select a valid priority level.',
            'message.min' => 'Your message must be at least 10 characters.',
            'message.max' => 'Your message cannot exceed 5000 characters.',
            'attachment.mimes' => 'Only JPG, JPEG, PNG and PDF files are allowed.',
            'attachment.max' => 'The attachment must not be larger than 5 MB.',
        ]);

        DB::beginTransaction();

        try {
            $user = auth()->user();

            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('support_attachments', 'public');
            }

            do {
                $ticketId = 'TKT-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            } while (SupportTicket::where('ticket_id', $ticketId)->exists());

            $ticket = SupportTicket::create([
                'user_id' => $user->id,
                'ticket_id' => $ticketId,
                'subject' => $request->subject,
                'priority' => $request->priority ?? 'Medium',
                'message' => $request->message,
                'attachment' => $attachmentPath,
                'status' => 'Open',
            ]);

            $mailData = [
                'name' => $user->name ?? 'Valued Customer',
                'email' => $user->email ?? '',
                'phone' => $user->phone ?? 'N/A',
                'subject' => '[' . $ticketId . '] ' . $request->subject,
                'message' => $request->message,
                'created_at' => $ticket->created_at,
            ];

            // Send notification email to user
            if (!empty($user->email)) {
                Mail::to($user->email)->send(new ContactMessageUserMail($mailData));
            }

            // Send notification email to admin
            $adminEmail = config('mail.admin_address') ?: 'admin@foodbox.ng';
            Mail::to($adminEmail)->send(new ContactMessageAdminMail($mailData));

            DB::commit();

            return redirect()->back()->with('success', 'Your support ticket (' . $ticketId . ') has been submitted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Support Ticket Creation Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to submit support ticket. Please try again later.');
        }
    }
}
