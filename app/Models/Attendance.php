<?php

namespace App\Models;

use App\Traits\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory,Tenant;

    protected $fillable = [
        'user_id',
        'attendance_date',
        'attendance_time',
        'type',
    ];
}
