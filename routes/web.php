<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jadwal\JadwalPelajaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
});

Route::middleware(['auth','role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', fn() => view('guru.dashboard'))->name('dashboard');
});

Route::middleware(['auth','role:kepala_sekolah'])->prefix('kepsek')->name('kepsek.')->group(function () {
    Route::get('/dashboard', fn() => view('kepsek.dashboard'))->name('dashboard');
});

// ADMIN
Route::prefix('admin/jadwal')->group(function () {
    Route::get('/', [JadwalPelajaranController::class, 'admin'])->name('jadwal.admin');
    Route::get('/create', [JadwalPelajaranController::class, 'create'])->name('jadwal.create');
    Route::post('/store', [JadwalPelajaranController::class, 'store'])->name('jadwal.store');
    Route::get('/edit/{id}', [JadwalPelajaranController::class, 'edit'])->name('jadwal.edit');
    Route::match(['put','patch'], '/update/{id}', [JadwalPelajaranController::class, 'update'])->name('jadwal.update');
    Route::delete('/delete/{id}', [JadwalPelajaranController::class, 'destroy'])->name('jadwal.delete');
});

// GURU
Route::get('/guru/jadwal', [JadwalPelajaranController::class, 'guru'])->name('jadwal.guru');

// KEPSEK
Route::get('/kepsek/jadwal',
    [JadwalPelajaranController::class, 'kepsek']
)->name('kepsek.jadwal');

Route::get('/kepsek/jadwal/pdf',
    [JadwalPelajaranController::class, 'exportPdf']
)->name('kepsek.jadwal.pdf');

Route::prefix('admin/siswa')->group(function () {
    Route::get('/', [SisController::class, 'admin'])->name('jadwal.admin');
    Route::get('/create', [JadwalPelajaranController::class, 'create'])->name('jadwal.create');
    Route::post('/store', [JadwalPelajaranController::class, 'store'])->name('jadwal.store');
    Route::get('/edit/{id}', [JadwalPelajaranController::class, 'edit'])->name('jadwal.edit');
    Route::match(['put','patch'], '/update/{id}', [JadwalPelajaranController::class, 'update'])->name('jadwal.update');
    Route::delete('/delete/{id}', [JadwalPelajaranController::class, 'destroy'])->name('jadwal.delete');
});


