<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';

    protected $fillable = [
        'title',
        'message',
        'type',
        'icon',
        'url',
        'reference_id',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    // Create a new admin notification.
    public static function notify(
        string $title,
        string $message,
        string $type,
        ?string $icon = null,
        ?string $url = null
    ): self {
        return self::create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'icon' => $icon ?? 'fas fa-bell',
            'url' => $url,
        ]);
    }
}
