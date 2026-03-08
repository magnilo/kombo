<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'division',
        'date',
        'time',
        'location',
        'image',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
