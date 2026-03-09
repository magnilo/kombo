<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniMember extends Model
{
    protected $fillable = [
        'alumni_batch_id',
        'name',
        'photo',
        'position',
    ];

    protected $casts = [
        'alumni_batch_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the batch that this member belongs to
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(AlumniBatch::class, 'alumni_batch_id');
    }
}
