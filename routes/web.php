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

        Route::resource('users', UserController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('kategori', KategoriController::class);

        // lihat semua peminjaman
        Route::get('peminjaman', [PeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        // pengembalian
        Route::patch(
            'peminjaman/{peminjaman}/kembalikan',
            [PeminjamanController::class, 'kembalikan']
        )
            ->name('peminjaman.kembalikan');

        Route::get('pengembalian', [PeminjamanController::class, 'pengembalian'])
            ->name('pengembalian.index');

        Route::get('aktivity-log', [ActivitylogController::class, 'index'])
            ->name('aktivity.index');
    });

Route::middleware(['auth', 'petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('peminjaman', [PetugasPeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        Route::get('peminjaman/{peminjaman}', [PetugasPeminjamanController::class, 'show'])
            ->name('peminjaman.show');

        Route::patch(
            'peminjaman/{peminjaman}/approve',
            [PetugasPeminjamanController::class, 'approve']
        )
            ->name('peminjaman.approve');

        Route::patch('peminjaman/{peminjaman}/reject', [PetugasPeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');
    });

Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('alat', [AlatController::class, 'userIndex'])
            ->name('alat.index');

        Route::get('peminjaman', [PeminjamanController::class, 'userIndex'])
            ->name('peminjaman.index');

        Route::get('peminjaman/create/{alat}', [PeminjamanController::class, 'create'])
            ->name('peminjaman.create');

        Route::post('peminjaman', [PeminjamanController::class, 'store'])
            ->name('peminjaman.store');

        Route::get('pengembalian', [PeminjamanController::class, 'userPengembalian'])
            ->name('pengembalian.index');

        Route::post('pengembalian/{peminjaman}', [PeminjamanController::class, 'kembalikan'])
            ->name('pengembalian.store');
    });




Route::get('/dashboard', [Dashboardcontroller::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
