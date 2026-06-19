<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MktWatiTemplate extends Model
{
    use HasFactory;

    protected $table = 'mkt_wati_template';

    public $timestamps = false;

    protected $fillable = [
        'course_id',
        'config',
        'description',
        'updated_at',
    ];

    protected $casts = [
        'config' => 'array',
        'updated_at' => 'datetime',
    ];
}
