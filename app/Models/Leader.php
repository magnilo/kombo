<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = ['name', 'position', 'photo', 'division', 'order', 'period', 'batch', 'is_active'];
}
