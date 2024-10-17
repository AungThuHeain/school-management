<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class School extends Model
{
    use HasFactory;


    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->id = rand(1000,9999);
        });
    }

    protected $fillable = [
        'name',
        'is_active',
    ];

    //scop filter
    public function scopeFilter($query,$filters){
        $query->when($filters['s'] ?? false,function($query,$s){
            $query->where('name','like','%',$s.'%');
        });
    }


    //relationships

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

}
