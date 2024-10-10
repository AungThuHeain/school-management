<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRoom extends Model
{
    use HasFactory;

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
}
