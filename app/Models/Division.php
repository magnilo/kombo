<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'order',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
