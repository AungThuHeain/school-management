<?php

use App\Http\Controllers\ClassRoomController;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Models\TeacherModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/student.php';

//home page
Route::get('/', function () {
    return view('welcome');
});

//profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//tenant routes
Route::group(['middleware'=>['auth','checkSchool']],function(){
    Route::get('/dashboard', function () {
        return view('/web/dashboard');
    })->name('dashboard');

    //class
    Route::resource('classes',ClassRoomController::class);
    //teacher
    Route::resource('teachers',TeacherController::class);

});


