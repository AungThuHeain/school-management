<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'school_id',
        'qr_url',
        'phone',
        'roles',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->qr_url = Str::random(10);
        });
    }


    //filter
    public function scopeFilter($query,$filter)
    {
        $query->when($filter['s'] ?? false,function($query,$s){
            $query->where('name','like','%'.$s.'%')
            ->orWhereHas('school',function($query)use($s){
                $query->where('name','like','%'.$s.'%');
            });
        });
    }


    //relations
    public function school():BelongsTo
    {
        return $this->belongsTo(School::class);
    }


}
