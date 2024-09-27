<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\Auth\LoginController;

Route::prefix('student')->name('student.')->group(function () {
    //login routes
    Route::middleware(['guest','guest:student'])->group(function () {
        Route::get('/login',[LoginController::class,'create'])->name('login.create');
        Route::post('/login',[LoginController::class,'store'])->name('login');
    });

    //logout routes
    Route::middleware(['auth:student'])->group(function () {
        Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    });

    //tenant routes
    Route::middleware(['auth:student','checkSchool'])->group(function () {
        Route::get('/dashboard/{school_id}',function(){
            return view('student.dashboard');
        })->name('dashboard');
    });
});
