<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'services',
        'other_info',
        'qualification',
        'description',
        'url',
        'ref_url',
        'source_url',
        'source',
        'medium',
        'ip_data',
        'section',
        'cv',
        'country',
        'ip',
    ];
}
