<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;


    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->id = Str::uuid();
        });
    }

    protected $fillable = [
        'name',
        'is_active',
    ];

    //relationships
    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function students():HasMany
    {
        return $this->hasMany(Student::class);
    }
}
