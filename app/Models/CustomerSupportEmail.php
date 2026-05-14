<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerSupportEmail extends Model
{
    use SoftDeletes;

    protected $table = "customer_support_email";
    
    protected $fillable = [
        'email',
        'phone',
    ];
}
