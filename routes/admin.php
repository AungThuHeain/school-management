<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->name('admin.')->group(function () {
    //login routes
    Route::middleware(['guest','guest:admin'])->group(function () {
        Route::get('/login',[LoginController::class,'create'])->name('login.create');
        Route::post('/login',[LoginController::class,'store'])->name('login');
    });

    //logout routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    });

    //dashboard routes

    Route::get('/dashboard',function(){
            return view('admin.dashboard');
        })->name('dashboard');

    //school
    Route::get('schools',[SchoolController::class,'index'])->name('schools');
    //user
    Route::get('users',[UserController::class,'index'])->name('users');


});
