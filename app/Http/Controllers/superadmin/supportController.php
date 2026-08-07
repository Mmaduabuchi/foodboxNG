<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\SupportTicket;
use App\Mail\ContactMessageUserMail;

class supportController extends Controller
{
    public function index(Request $request)
    {
        // Authenticated admin name
        $adminName = Auth::user() ? Auth::user()->name : 'Super Admin';

        // Summary Metric Counts (always global)
        $totalTickets = SupportTicket::count();

        $openTickets = SupportTicket::whereIn('status', [
            'Open',
            'Pending'
        ])->count();

        $inProgressTickets = SupportTicket::where('status', 'In Progress')
            ->count();

        $resolvedTickets = SupportTicket::whereIn('status', [
            'Resolved',
            'Closed'
        ])->count();

        // Build Ticket Query with User & User Addresses
        $query = SupportTicket::with(['user.addresses', 'handledBy'])->latest();

        // Keyword Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('ticket_id', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
            });
        }

        // Status Filter
        if ($request->filled('status') && strtoupper($request->status) !== 'ALL') {
            $status = str_replace('_', ' ', $request->status);
            $query->where('status', 'like', $status);
        }

        // Priority Filter
        if ($request->filled('priority') && strtoupper($request->priority) !== 'ALL') {
            $priority = $request->priority;
            $query->where('priority', 'like', $priority);
        }

        $tickets = $query->paginate(10)->withQueryString();

        return view('superAdminDashboard.support_ticket', compact(
            'adminName',
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'resolvedTickets',
            'tickets'
        ));
    }

    /**
     * Update the ticket status & optional quick note.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|string',
                'admin_feedback' => 'nullable|string',
            ]);

            $ticket = SupportTicket::where('id', $id)
                ->orWhere('ticket_id', $id)
                ->firstOrFail();

            // Map status cleanly
            $statusMap = [
                'OPEN' => 'Open',
                'IN_PROGRESS' => 'In Progress',
                'RESOLVED' => 'Resolved',
                'CLOSED' => 'Closed',
            ];
            $newStatus = $statusMap[strtoupper($request->status)] ?? $request->status;

            $ticket->status = $newStatus;
            if ($request->filled('admin_feedback')) {
                $ticket->admin_feedback = $request->admin_feedback;
            }

            if (in_array($newStatus, ['Resolved', 'Closed'])) {
                $ticket->resolved_at = now();
            }

            if (Auth::check()) {
                $ticket->handled_by = Auth::id();
            }

            $ticket->save();

            return back()->with('success', "Ticket #{$ticket->ticket_id} status updated to {$ticket->status} successfully.");
        } catch (\Exception $e) {
            Log::error("Error updating support ticket status [ID: {$id}]: " . $e->getMessage(), [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', "Unable to update status for ticket #{$id}. Please try again.");
        }
    }

    /**
     * Save ticket details, admin feedback notes, priority, and status.
     */
    public function updateDetails(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|string',
                'priority' => 'required|string',
                'admin_feedback' => 'nullable|string',
            ]);

            $ticket = SupportTicket::where('id', $id)
                ->orWhere('ticket_id', $id)
                ->firstOrFail();

            $statusMap = [
                'OPEN' => 'Open',
                'IN_PROGRESS' => 'In Progress',
                'RESOLVED' => 'Resolved',
                'CLOSED' => 'Closed',
            ];
            $priorityMap = [
                'LOW' => 'Low',
                'MEDIUM' => 'Medium',
                'HIGH' => 'High',
                'URGENT' => 'High', // database enum supports Low, Medium, High
            ];

            $ticket->status = $statusMap[strtoupper($request->status)] ?? $request->status;
            $ticket->priority = $priorityMap[strtoupper($request->priority)] ?? $request->priority;
            $ticket->admin_feedback = $request->admin_feedback;

            if (in_array($ticket->status, ['Resolved', 'Closed']) && !$ticket->resolved_at) {
                $ticket->resolved_at = now();
            }

            if (Auth::check()) {
                $ticket->handled_by = Auth::id();
            }

            $ticket->save();

            return back()->with('success', "Support ticket #{$ticket->ticket_id} updated successfully.");
        } catch (\Exception $e) {
            Log::error("Error updating support ticket details [ID: {$id}]: " . $e->getMessage(), [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', "Unable to save changes for ticket #{$id}. Please try again.");
        }
    }

    /**
     * Dispatch email reply to customer and log response timestamp.
     */
    public function reply(Request $request, $id)
    {
        try {
            $request->validate([
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
                'status' => 'nullable|string',
            ]);

            $ticket = SupportTicket::with('user')
                ->where('id', $id)
                ->orWhere('ticket_id', $id)
                ->firstOrFail();

            $ticket->replied_at = now();

            if ($request->filled('status')) {
                $statusMap = [
                    'OPEN' => 'Open',
                    'IN_PROGRESS' => 'In Progress',
                    'RESOLVED' => 'Resolved',
                    'CLOSED' => 'Closed',
                ];
                $ticket->status = $statusMap[strtoupper($request->status)] ?? $request->status;
                if (in_array($ticket->status, ['Resolved', 'Closed'])) {
                    $ticket->resolved_at = now();
                }
            }

            if (Auth::check()) {
                $ticket->handled_by = Auth::id();
            }

            $ticket->save();

            // Dispatch notification email to customer
            $customerEmail = $ticket->user->email ?? $request->email;
            if (!empty($customerEmail)) {
                try {
                    $mailData = [
                        'name' => $ticket->user->name ?? 'Valued Customer',
                        'email' => $customerEmail,
                        'phone' => $ticket->user->phone ?? 'N/A',
                        'subject' => $request->subject,
                        'message' => $request->message,
                        'created_at' => now(),
                    ];

                    Mail::to($customerEmail)->send(new ContactMessageUserMail($mailData));
                } catch (\Exception $mailEx) {
                    Log::error("Failed to send reply email for ticket #{$ticket->ticket_id}: " . $mailEx->getMessage(), [
                        'ticket_id' => $ticket->ticket_id,
                        'recipient' => $customerEmail,
                        'error' => $mailEx->getMessage(),
                    ]);
                }
            }

            return back()->with('success', "Email reply dispatched to " . ($ticket->user->name ?? 'Customer') . " ({$customerEmail}) successfully.");
        } catch (\Exception $e) {
            Log::error("Error processing reply for ticket [ID: {$id}]: " . $e->getMessage(), [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', "Unable to send reply for ticket #{$id}. Please try again.");
        }
    }

    /**
     * Close the ticket directly with try/catch, error logging, and email notification to the user.
     */
    public function closeTicket($id)
    {
        try {
            $ticket = SupportTicket::with('user')
                ->where('id', $id)
                ->orWhere('ticket_id', $id)
                ->firstOrFail();

            $ticket->status = 'Closed';
            $ticket->resolved_at = now();

            if (Auth::check()) {
                $ticket->handled_by = Auth::id();
            }

            $ticket->save();

            // Send ticket closure notification email to the user
            $customerEmail = $ticket->user->email ?? null;
            if (!empty($customerEmail)) {
                try {
                    $mailData = [
                        'name' => $ticket->user->name ?? 'Valued Customer',
                        'email' => $customerEmail,
                        'phone' => $ticket->user->phone ?? 'N/A',
                        'subject' => "[{$ticket->ticket_id}] Your Support Ticket has been Closed - FoodBox NG",
                        'message' => "Hello " . ($ticket->user->name ?? 'Valued Customer') . ",\n\nYour support ticket (#{$ticket->ticket_id}) regarding \"{$ticket->subject}\" has been marked as resolved and closed by our customer care team.\n\n" . (!empty($ticket->admin_feedback) ? "Admin Resolution Notes:\n" . $ticket->admin_feedback . "\n\n" : "") . "If you have any further questions or require additional assistance, please feel free to open a new inquiry.\n\nThank you for choosing FoodBox NG!",
                        'created_at' => $ticket->created_at ?? now(),
                    ];

                    Mail::to($customerEmail)->send(new ContactMessageUserMail($mailData));
                } catch (\Exception $mailEx) {
                    Log::error("Failed to send ticket closure notification email for ticket #{$ticket->ticket_id}: " . $mailEx->getMessage(), [
                        'ticket_id' => $ticket->ticket_id,
                        'recipient' => $customerEmail,
                        'error' => $mailEx->getMessage(),
                    ]);
                }
            }

            return back()->with('success', "Ticket #{$ticket->ticket_id} has been marked as closed and notification sent to the customer.");
        } catch (\Exception $e) {
            Log::error("Error closing support ticket [ID: {$id}]: " . $e->getMessage(), [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', "Unable to close ticket #{$id}. Please try again later.");
        }
    }

    /**
     * Export support tickets to CSV format.
     */
    public function export(Request $request)
    {
        $fileName = 'foodbox_support_tickets_' . date('Y_m_d_His') . '.csv';

        $query = SupportTicket::with(['user.addresses', 'handledBy'])->latest();

        if ($request->filled('status') && strtoupper($request->status) !== 'ALL') {
            $status = str_replace('_', ' ', $request->status);
            $query->where('status', 'like', $status);
        }

        if ($request->filled('priority') && strtoupper($request->priority) !== 'ALL') {
            $query->where('priority', 'like', $request->priority);
        }

        $tickets = $query->cursor();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $columns = ['Ticket ID', 'Customer Name', 'Customer Email', 'Phone', 'Subject', 'Priority', 'Status', 'Message', 'Admin Feedback', 'Created At', 'Resolved At'];

        $callback = function () use ($tickets, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tickets as $ticket) {
                fputcsv($file, [
                    $ticket->ticket_id,
                    $ticket->user->name ?? 'N/A',
                    $ticket->user->email ?? 'N/A',
                    $ticket->user->phone ?? 'N/A',
                    $ticket->subject,
                    $ticket->priority,
                    $ticket->status,
                    $ticket->message,
                    $ticket->admin_feedback,
                    $ticket->created_at ? $ticket->created_at->format('Y-m-d H:i:s') : '',
                    $ticket->resolved_at ? $ticket->resolved_at->format('Y-m-d H:i:s') : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
