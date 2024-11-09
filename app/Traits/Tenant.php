<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Tenant
{
    //trait to auto add school_id and scope for school_id except  super admin
   protected static function bootTenant()
   {
        if (auth()->check()) {
            static::creating(function ($model) {
                $model->school_id = auth()->user()->school_id;
            });
        };

        if(auth()->check() && !Auth::guard('admin')->check()){
            static::addGlobalScope('school_id', function ($builder) {
                $builder->where('school_id', auth()->user()->school_id);
            });
        }
   }
}
