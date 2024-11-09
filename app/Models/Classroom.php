<?php

namespace App\Models;

use App\Traits\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassRoom extends Model
{
    use HasFactory,Tenant;

    protected $fillable = [
        'name',
        'school_id'
    ];

    //filter scope
    public function scopeFilter($query,$filter)
    {
        $query->when($filter['s'] ?? false,function($query,$s){
            $query->where('name','like','%'.$s.'%');
        });
    }
    //relationships
    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function schedules():BelongsToMany
    {
        return $this->belongsToMany(Schedule::class,'class_room_schedule');
    }
}
