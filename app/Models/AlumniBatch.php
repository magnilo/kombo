<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniBatch extends Model
{
    protected $fillable = ['year', 'group_photo', 'description'];

    public function members()
    {
        return $this->hasMany(AlumniMember::class);
    }
}
