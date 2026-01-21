<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\Dashboardcontroller;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//ROUTE USER
Route::resource('users', UserController::class);

//ROUTE ALAT
Route::resource('alat', AlatController::class);


Route::get('/dashboard', [Dashboardcontroller::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
