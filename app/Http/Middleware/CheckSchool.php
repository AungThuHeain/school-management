<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSchool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()){
            if((auth()->user()->school->is_active == 0) || (auth()->user()->school_id !== $request->route('school_id')) || auth()->user()->status ==0){
                abort(403);
            }
        }
        if(auth('student')->user()){
            if((auth('student')->user()->school->is_active == 0) || (auth('student')->user()->school_id !== $request->route('school_id'))){
                abort(403);
            }
        }

        return $next($request);
    }
}
