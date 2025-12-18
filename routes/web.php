<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jadwal\JadwalPelajaranController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Master\SiswaController;
use App\Http\Controllers\Master\GuruController;
use App\Http\Controllers\Master\MataPelajaranController;
use App\Http\Controllers\Master\KelasController;

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
});

// Dashboard

Route::get('/guru/dashboard', fn () => view('guru.dashboard'))->name('guru.dashboard');
Route::get('/siswa/dashboard', fn () => view('siswa.dashboard'))->name('siswa.dashboard');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('guru', GuruController::class)->except(['show']);
        Route::resource('siswa', SiswaController::class);
        Route::resource('mapel', MataPelajaranController::class)->except(['show']);
});


// ADMIN Jadwal
Route::prefix('admin/jadwal')->group(function () {
    Route::get('/', [JadwalPelajaranController::class, 'admin'])->name('jadwal.admin');
    Route::get('/create', [JadwalPelajaranController::class, 'create'])->name('jadwal.create');
    Route::post('/store', [JadwalPelajaranController::class, 'store'])->name('jadwal.store');
    Route::get('/edit/{id}', [JadwalPelajaranController::class, 'edit'])->name('jadwal.edit');
    Route::match(['put','patch'], '/update/{id}', [JadwalPelajaranController::class, 'update'])->name('jadwal.update');
    Route::delete('/delete/{id}', [JadwalPelajaranController::class, 'destroy'])->name('jadwal.delete');
});

// GURU jadwal
Route::get('/guru/jadwal', [JadwalPelajaranController::class, 'guru'])->name('jadwal.guru');

// KEPSEK jadwal
Route::get('/kepsek/jadwal', [JadwalPelajaranController::class, 'kepsek'])->name('jadwal.kepsek');

//Admin Kelas
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::resource('kelas', KelasController::class)->except(['show']);
});