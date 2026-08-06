<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportTicket extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'subject',
        'priority',
        'message',
        'admin_feedback',
        'attachment',
        'status',
        'resolved_at',
        'replied_at',
        'handled_by',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    // Customer who created the ticket
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // To get the admin who replied/handled the ticket
    public function handledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by', 'id');
    }
}
