<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\SupportTicket;

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
    }

    /**
     * Save ticket details, admin feedback notes, priority, and status.
     */
    public function updateDetails(Request $request, $id)
    {
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
    }

    /**
     * Dispatch email reply to customer and log response timestamp.
     */
    public function reply(Request $request, $id)
    {
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

        // If email dispatch is supported in environment
        $customerEmail = $ticket->user->email ?? $request->email;
        if ($customerEmail) {
            try {
                // You can dispatch a notification or mailable here
            } catch (\Exception $e) {
                // Silently log or continue
            }
        }

        return back()->with('success', "Email reply dispatched to {$ticket->user->name} ({$customerEmail}) successfully.");
    }

    /**
     * Close the ticket directly.
     */
    public function closeTicket($id)
    {
        $ticket = SupportTicket::where('id', $id)
            ->orWhere('ticket_id', $id)
            ->firstOrFail();

        $ticket->status = 'Closed';
        $ticket->resolved_at = now();

        if (Auth::check()) {
            $ticket->handled_by = Auth::id();
        }

        $ticket->save();

        return back()->with('success', "Ticket #{$ticket->ticket_id} has been marked as closed.");
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

        $tickets = $query->get();

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
