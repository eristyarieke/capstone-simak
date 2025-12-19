<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Jadwal\JadwalPelajaranController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin'])
            ->name('dashboard');

        Route::get('/jadwal', [JadwalPelajaranController::class, 'admin'])
            ->name('jadwal');

        Route::get('/jadwal/create', [JadwalPelajaranController::class, 'create'])
            ->name('jadwal.create');

        Route::post('/jadwal/store', [JadwalPelajaranController::class, 'store'])
            ->name('jadwal.store');

        Route::get('/jadwal/{id}/edit', [JadwalPelajaranController::class, 'edit'])
            ->name('jadwal.edit');

        Route::put('/jadwal/{id}/update', [JadwalPelajaranController::class, 'update'])
            ->name('jadwal.update');

        Route::delete('/jadwal/{id}/delete', [JadwalPelajaranController::class, 'destroy'])
            ->name('jadwal.delete');
    });

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'guru'])
            ->name('dashboard');

        Route::get('/jadwal', [JadwalPelajaranController::class, 'guru'])
            ->name('jadwal');
    });

/*
|--------------------------------------------------------------------------
| KEPALA SEKOLAH
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:kepsek'])
    ->prefix('kepsek')
    ->name('kepsek.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'kepsek'])
            ->name('dashboard');

        Route::get('/jadwal', [JadwalPelajaranController::class, 'kepsek'])
            ->name('jadwal');

        Route::get('/jadwal/export/pdf', [JadwalPelajaranController::class, 'exportPdf'])
            ->name('jadwal.export.pdf');
    });
