<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;

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

  
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
//Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(TaskController::class)->prefix('task')->group(function(){
    Route::get('','index')->name('task');
    Route::get('create','create')->name('task.create');
    Route::post('store','store')->name('task.store');

    Route::get('edit/{id}','edit')->name('task.edit');
    Route::put('edit/{id}','update')->name('task.update');

    Route::delete('destroy/{id}','destroy')->name('task.destroy');
});

