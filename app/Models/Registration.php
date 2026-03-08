<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jurusan',
        'prodi',
        'domisili',
        'campus',
        'division_id',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
