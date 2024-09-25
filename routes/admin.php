<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest','guest:admin'])->group(function () {
        Route::get('/login',[LoginController::class,'create'])->name('login.create');
        Route::post('/login',[LoginController::class,'store'])->name('login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard',function(){
            return view('admin.dashboard');
        })->name('dashboard');
        Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    });
});
