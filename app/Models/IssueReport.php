<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'package_id',
        'issue_type',
        'description',
        'affected_items',
        'status',
        'reference',
        'admin_notes',
        'resolution',
    ];

    protected $casts = [
        'affected_items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function images()
    {
        return $this->hasMany(IssueImage::class);
    }

    public function comments()
    {
        return $this->hasMany(IssueComment::class)->orderBy('created_at', 'asc');
    }

    // Status helpers
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeInvestigating($query)
    {
        return $query->where('status', 'investigating');
    }
}
