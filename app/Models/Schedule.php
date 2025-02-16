<?php

namespace App\Models;

use App\Traits\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory,Tenant;

    protected $fillable =[
        'name',
        'school_id',
        'check_in',
        'check_out',
    ];

    public function classRooms():BelongsToMany
    {
        return $this->belongsToMany(ClassRoom::class,'class_room_schedule');
    }
}
