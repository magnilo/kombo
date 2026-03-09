<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlumniBatch extends Model
{
    protected $fillable = [
        'year',
        'group_photo',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all members for this batch
     */
    public function members(): HasMany
    {
        return $this->hasMany(AlumniMember::class);
    }
}
