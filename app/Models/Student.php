<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    public function schoolStatus()
    {
        return $this->school->is_active;
    }
    //relations
    public function school():BelongsTo
    {
        return $this->belongsTo(School::class);
    }

}
