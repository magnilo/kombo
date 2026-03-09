<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $casts = [
        'division_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the division that this registration belongs to
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
