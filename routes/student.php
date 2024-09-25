<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\Auth\LoginController;

Route::prefix('student')->name('student.')->group(function () {
    Route::middleware(['guest','guest:student'])->group(function () {
        Route::get('/login',[LoginController::class,'create'])->name('login.create');
        Route::post('/login',[LoginController::class,'store'])->name('login');
    });

    Route::middleware(['auth:student'])->group(function () {
        Route::get('/dashboard',function(){
            return view('student.dashboard');
        })->name('dashboard');
        Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    });
});
