<?php

namespace App\Models;

use App\Traits\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory,Tenant;

    protected $fillable = [
        'user_id',
        'attendance_date',
        'attendance_time',
        'type',
    ];

    //scope
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['s'] ?? false,function($query,$s){
            $query->where('name','like','%'.$s.'%')
            ->orWhereHas('school',function($query)use($s){
                $query->where('name','like','%'.$s.'%');
            })
            ->orWhereHas('class',function($query)use($s){
                $query->where('name','like','%'.$s.'%');
            });
        });
    }

    //relation
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
