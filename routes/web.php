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
Route::get('/kepsek/jadwal', [JadwalPelajaranController::class, 'kepsek'])->name('jadwal.kepsek');


