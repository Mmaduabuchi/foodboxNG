<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staffs';
    
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'state',
        'address',
        'NIN',
        'password',
        'last_login',
        'role',
        'status',
    ];
    
    protected $casts = [
        'password' => 'hashed',
        'last_login' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    public function scopeStaff($query)
    {
        return $query->where('role', 'staff');
    }
}
