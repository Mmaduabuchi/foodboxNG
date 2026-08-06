<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
        'phone',
        'profile_image',
        'referral_code',
        'referred_by',
        'delivery_notifications',
        'billing_notifications',
        'marketing_notifications',
        'two_factor_enabled',
        'is_suspended',
        'is_active',
        'role',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    //unread notifications
    public function unreadNotifications()
    {
        return $this->hasMany(UserNotification::class)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc');
    }
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
