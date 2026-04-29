<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_report_id',
        'image_path',
    ];

    public function issue()
    {
        return $this->belongsTo(IssueReport::class, 'issue_report_id');
    }
}
