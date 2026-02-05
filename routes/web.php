<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ActivitylogController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetugasMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\PetugasPeminjamanController;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Grup admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // USER
        Route::resource('users', UserController::class);

        // ALAT
        Route::resource('alat', AlatController::class);

        // KATEGORI
        Route::resource('kategori', KategoriController::class);

        // PEMINJAMAN
        Route::resource('peminjaman', PeminjamanController::class);

        // PENGEMBALIAN
        Route::get('pengembalian', [PeminjamanController::class, 'pengembalian'])
            ->name('pengembalian.index');

        Route::post('pengembalian/{peminjaman}', [PeminjamanController::class, 'kembalikan'])
            ->name('pengembalian.kembalikan');

        // ACTIVITY LOG
        Route::get('aktivity-log', [ActivitylogController::class, 'index'])
            ->name('aktivity.index');
    });


Route::middleware(['auth', 'petugas'])->group(function () {

    Route::get('/petugas/peminjaman', [PetugasPeminjamanController::class, 'index'])
        ->name('petugas.peminjaman.index');

    Route::get('/petugas/peminjaman/{id}', [PetugasPeminjamanController::class, 'show'])
        ->name('petugas.peminjaman.show');

    Route::put('/petugas/peminjaman/{id}/approve', [PetugasPeminjamanController::class, 'approve'])
        ->name('petugas.peminjaman.approve');

    Route::put('/petugas/peminjaman/{id}/reject', [PetugasPeminjamanController::class, 'reject'])
        ->name('petugas.peminjaman.reject');

});

Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('alat', [AlatController::class, 'userIndex'])
            ->name('alat.index');

        Route::get('peminjaman/create/{alat}', [PeminjamanController::class, 'create'])
            ->name('peminjaman.create');
});



Route::get('/dashboard', [Dashboardcontroller::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
