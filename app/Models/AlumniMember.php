<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniMember extends Model
{
    protected $fillable = ['alumni_batch_id', 'name', 'photo', 'position'];

    public function batch()
    {
        return $this->belongsTo(AlumniBatch::class, 'alumni_batch_id');
    }
}
