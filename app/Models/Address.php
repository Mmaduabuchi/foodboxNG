<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'phone',
        'street_address',
        'city',
        'state',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
