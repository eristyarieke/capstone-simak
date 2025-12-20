<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Jadwal\JadwalPelajaranController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Master\SiswaController;
use App\Http\Controllers\Master\GuruController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Master\MapelController;
use App\Http\Controllers\Master\PembagianKelasController;
use App\Http\Controllers\landingpage\KelolaHalamanController;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(PublicController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/profil', 'profil')->name('profil');
    Route::get('/kegiatan', 'kegiatan')->name('kegiatan');
    Route::get('/prestasi', 'prestasi')->name('prestasi');
    Route::get('/artikel', 'artikel')->name('artikel');
    Route::get('/artikel/{slug}', 'detailArtikel')->name('artikel.detail'); // Detail berita
    Route::get('/kontak', 'kontak')->name('kontak');
    Route::post('/feedback', 'kirimFeedback')->name('feedback.store'); // Form kirim pesan
});
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
        Route::delete('/jadwal/{id}/destroy', [JadwalPelajaranController::class, 'destroy'])
            ->name('jadwal.destroy');

        Route::get('/siswa', [SiswaController::class, 'index'])
            ->name('siswa');
        Route::get('/siswa/create', [SiswaController::class, 'create'])
            ->name('siswa.create');
        Route::post('/siswa/store', [SiswaController::class, 'store'])
            ->name('siswa.store');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])
            ->name('siswa.edit');
        Route::put('/siswa/{id}/update', [SiswaController::class, 'update'])
            ->name('siswa.update');
        Route::delete('/siswa/{id}/destroy', [SiswaController::class, 'destroy'])
            ->name('siswa.destroy');

        Route::get('/guru', [GuruController::class, 'index'])
            ->name('guru');
        Route::get('/guru/create', [GuruController::class, 'create'])
            ->name('guru.create');
        Route::post('/guru/store', [GuruController::class, 'store'])
            ->name('guru.store');
        Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])
            ->name('guru.edit');
        Route::put('/guru/{id}/update', [GuruController::class, 'update'])
            ->name('guru.update');
        Route::delete('/guru/{id}/destroy', [GuruController::class, 'destroy'])
            ->name('guru.destroy');

        Route::get('/kelas', [KelasController::class, 'index'])
            ->name('kelas');
        Route::get('/kelas/create', [KelasController::class, 'create'])
            ->name('kelas.create');
        Route::post('/kelas/store', [KelasController::class, 'store'])
            ->name('kelas.store');
        Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])
            ->name('kelas.edit');
        Route::put('/kelas/{id}/update', [KelasController::class, 'update'])
            ->name('kelas.update');
        Route::delete('/kelas/{id}/destroy', [KelasController::class, 'destroy'])
            ->name('kelas.destroy');

        Route::get('/mapel', [MapelController::class, 'index'])
            ->name('mapel');
        Route::get('/mapel/create', [MapelController::class, 'create'])
            ->name('mapel.create');
        Route::post('/mapel/store', [MapelController::class, 'store'])
            ->name('mapel.store');
        Route::get('/mapel/{id}/edit', [MapelController::class, 'edit'])
            ->name('mapel.edit');
        Route::put('/mapel/{id}/update', [MapelController::class, 'update'])
            ->name('mapel.update');
        Route::delete('/mapel/{id}/destroy', [MapelController::class, 'destroy'])
            ->name('mapel.destroy');

        Route::get('/pembagian-kelas', [PembagianKelasController::class, 'index']
        )->name('pembagian-kelas');
        Route::post('/pembagian-kelas', [PembagianKelasController::class, 'store']
        )->name('pembagian-kelas.store');

    Route::get('/kelola-halaman', [KelolaHalamanController::class, 'index'])
    ->name('kelola-halaman');
    Route::get('/kelola-halaman/galeri', [KelolaHalamanController::class, 'galeri'])
    ->name('kelola-halaman.galeri');
    Route::get('/kelola-halaman/kegiatan', [KelolaHalamanController::class, 'kegiatan'])
    ->name('kelola-halaman.kegiatan');
    Route::get('/kelola-halaman/prestasi', [KelolaHalamanController::class, 'prestasi'])
    ->name('kelola-halaman.prestasi');
    Route::get('/kelola-halaman/artikel', [KelolaHalamanController::class, 'artikel'])
    ->name('kelola-halaman.artikel');
    Route::get('/kelola-halaman/kontak', [KelolaHalamanController::class, 'kontak'])
    ->name('kelola-halaman.kontak');
    Route::get('/kelola-halaman/banner', [KelolaHalamanController::class, 'banner'])
    ->name('kelola-halaman.banner');
    Route::get('/kelola-halaman/sambutan', [KelolaHalamanController::class, 'sambutan'])
    ->name('kelola-halaman.sambutan');
    Route::get('/kelola-halaman/profil', [KelolaHalamanController::class, 'profil'])
    ->name('kelola-halaman.profil');
    Route::get('/kelola-halaman/visi', [KelolaHalamanController::class, 'visi'])
    ->name('kelola-halaman.visi');
    Route::get('/kelola-halaman/misi', [KelolaHalamanController::class, 'misi'])
    ->name('kelola-halaman.kegiatan.misi');

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
