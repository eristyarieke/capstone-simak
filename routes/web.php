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
use App\Http\Controllers\kepsek\UserController;
use App\Http\Controllers\guru\JadwalGuruController;
use App\Http\Controllers\landingpage\KelolaHalamanController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\laporan\LaporanSiswaController;
use App\Http\Controllers\laporan\LaporanGuruController;
use App\Http\Controllers\laporan\LaporanJadwalController;

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
    Route::get('/artikel/{id}', 'detailArtikel')->name('artikel.detail'); // Detail berita
    Route::get('/kontak', 'kontak')->name('kontak');
    Route::post('/kontak', 'kirimFeedback')->name('feedback.kirim');
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
    Route::get('/kelola-halaman/galeri/create', [KelolaHalamanController::class, 'galeriCreate'])->name('kelola-halaman.galeri.create');
    Route::post('/kelola-halaman/galeri', [KelolaHalamanController::class, 'galeriStore'])->name('kelola-halaman.galeri.store');
    Route::delete('/kelola-halaman/galeri/{id}', [KelolaHalamanController::class, 'galeriDestroy'])->name('kelola-halaman.galeri.destroy');

    Route::get('/kelola-halaman/kegiatan', [KelolaHalamanController::class, 'kegiatan'])
    ->name('kelola-halaman.kegiatan');
    Route::get('/kelola-halaman/kegiatan/create', [KelolaHalamanController::class, 'kegiatanCreate'])->name('kelola-halaman.kegiatan.create');
    Route::post('/kelola-halaman/kegiatan', [KelolaHalamanController::class, 'kegiatanStore'])->name('kelola-halaman.kegiatan.store');
    Route::get('/kelola-halaman/kegiatan/{id}/edit', [KelolaHalamanController::class, 'kegiatanEdit'])->name('kelola-halaman.kegiatan.edit');
    Route::put('/kelola-halaman/kegiatan/{id}', [KelolaHalamanController::class, 'kegiatanUpdate'])->name('kelola-halaman.kegiatan.update');
    Route::delete('/kelola-halaman/kegiatan/{id}', [KelolaHalamanController::class, 'kegiatanDestroy'])->name('kelola-halaman.kegiatan.destroy');

    Route::get('/kelola-halaman/prestasi', [KelolaHalamanController::class, 'prestasi'])
    ->name('kelola-halaman.prestasi');
    Route::get('/kelola-halaman/prestasi/create', [KelolaHalamanController::class, 'prestasiCreate'])->name('kelola-halaman.prestasi.create');
    Route::post('/kelola-halaman/prestasi', [KelolaHalamanController::class, 'prestasiStore'])->name('kelola-halaman.prestasi.store');
    Route::get('/kelola-halaman/prestasi/{id}/edit', [KelolaHalamanController::class, 'prestasiEdit'])->name('kelola-halaman.prestasi.edit');
    Route::put('/kelola-halaman/prestasi/{id}', [KelolaHalamanController::class, 'prestasiUpdate'])->name('kelola-halaman.prestasi.update');
    Route::delete('/kelola-halaman/prestasi/{id}', [KelolaHalamanController::class, 'prestasiDestroy'])->name('kelola-halaman.prestasi.destroy');

    Route::get('/kelola-halaman/artikel', [KelolaHalamanController::class, 'artikel'])
    ->name('kelola-halaman.artikel');
    Route::get('/kelola-halaman/artikel/create', [KelolaHalamanController::class, 'artikelCreate'])->name('kelola-halaman.artikel.create');
    Route::post('/kelola-halaman/artikel', [KelolaHalamanController::class, 'artikelStore'])->name('kelola-halaman.artikel.store');
    Route::get('/kelola-halaman/artikel/{id}/edit', [KelolaHalamanController::class, 'artikelEdit'])->name('kelola-halaman.artikel.edit');
    Route::put('/kelola-halaman/artikel/{id}', [KelolaHalamanController::class, 'artikelUpdate'])->name('kelola-halaman.artikel.update');
    Route::delete('/kelola-halaman/artikel/{id}', [KelolaHalamanController::class, 'artikelDestroy'])->name('kelola-halaman.artikel.destroy');

    Route::get('/kelola-halaman/pengumuman', [KelolaHalamanController::class, 'pengumuman'])->name('kelola-halaman.pengumuman');
    Route::get('/kelola-halaman/pengumuman/create', [KelolaHalamanController::class, 'pengumumanCreate'])->name('kelola-halaman.pengumuman.create');
    Route::post('/kelola-halaman/pengumuman', [KelolaHalamanController::class, 'pengumumanStore'])->name('kelola-halaman.pengumuman.store');
    Route::get('/kelola-halaman/pengumuman/{id}/edit', [KelolaHalamanController::class, 'pengumumanEdit'])->name('kelola-halaman.pengumuman.edit');
    Route::put('/kelola-halaman/pengumuman/{id}', [KelolaHalamanController::class, 'pengumumanUpdate'])->name('kelola-halaman.pengumuman.update');
    Route::delete('/kelola-halaman/pengumuman/{id}', [KelolaHalamanController::class, 'pengumumanDestroy'])->name('kelola-halaman.pengumuman.destroy');

    Route::get('/kelola-halaman/kontak', [KelolaHalamanController::class, 'kontak'])
    ->name('kelola-halaman.kontak');
    Route::put('/kelola-halaman/kontak', [KelolaHalamanController::class, 'kontakUpdate'])->name('kelola-halaman.kontak.update');

    Route::get('/kelola-halaman/banner', [KelolaHalamanController::class, 'banner'])
    ->name('kelola-halaman.banner');
    Route::post('/kelola-halaman/banner', [KelolaHalamanController::class, 'bannerStore'])
    ->name('kelola-halaman.banner.store');
    Route::get('/kelola-halaman/banner/create', [KelolaHalamanController::class, 'bannerCreate'])
    ->name('kelola-halaman.banner.create');
    Route::get('/kelola-halaman/banner/{id}/edit', [KelolaHalamanController::class, 'bannerEdit'])
    ->name('kelola-halaman.banner.edit');
    Route::put('/kelola-halaman/banner/{id}', [KelolaHalamanController::class, 'bannerUpdate'])
    ->name('kelola-halaman.banner.update');
    Route::delete('/kelola-halaman/banner/{id}', [KelolaHalamanController::class, 'bannerDestroy'])
    ->name('kelola-halaman.banner.destroy');

    Route::get('/kelola-halaman/sambutan', [KelolaHalamanController::class, 'sambutan'])
    ->name('kelola-halaman.sambutan');
    Route::put('/kelola-halaman/sambutan', [KelolaHalamanController::class, 'sambutanUpdate'])
    ->name('kelola-halaman.sambutan.update');

    Route::get('/kelola-halaman/profil', [KelolaHalamanController::class, 'profil'])
    ->name('kelola-halaman.profil');
    Route::put('/kelola-halaman/profil-sekolah', [KelolaHalamanController::class, 'profilUpdate'])
    ->name('kelola-halaman.profil.update');

    Route::get('/kelola-halaman/visi-misi', [KelolaHalamanController::class, 'visiMisi'])->name('kelola-halaman.visimisi');

    Route::post('/kelola-halaman/visi', [KelolaHalamanController::class, 'visiStore'])->name('kelola-halaman.visi.store');
    Route::delete('/kelola-halaman/visi/{id}', [KelolaHalamanController::class, 'visiDestroy'])->name('kelola-halaman.visi.destroy');

    // CRUD MISI
    Route::post('/kelola-halaman/misi', [KelolaHalamanController::class, 'misiStore'])->name('kelola-halaman.misi.store');
    Route::delete('/kelola-halaman/misi/{id}', [KelolaHalamanController::class, 'misiDestroy'])->name('kelola-halaman.misi.destroy');

    Route::get('/kelola-halaman/feedback', [KelolaHalamanController::class, 'feedback'])->name('kelola-halaman.feedback');
    Route::delete('/kelola-halaman/feedback/{id}', [KelolaHalamanController::class, 'feedbackDestroy'])->name('kelola-halaman.feedback.destroy');

    });

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'guru'])->name('dashboard');

    // Jadwal (Menggunakan JadwalController yang sudah ada)
    // Tips: Di controller, pastikan function 'index' bisa filter jadwal berdasarkan ID Guru yang login
    Route::get('/jadwal', [JadwalGuruController::class, 'index'])->name('jadwal');

});

/*
|--------------------------------------------------------------------------
| ROUTES KEPALA SEKOLAH (KEPSEK)
|--------------------------------------------------------------------------
| Kepsek: Dashboard, Manage User, dan Laporan (Cetak).
*/
Route::middleware(['auth', 'role:kepsek'])->prefix('kepsek')->name('kepsek.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'kepsek'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])
    ->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
    ->name('users.edit');
    Route::put('/users/{id}/update', [UserController::class, 'update'])
    ->name('users.update');
    Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])
    ->name('users.destroy');

    Route::get('/laporan/siswa', [LaporanSiswaController::class, 'index'])->name('laporan.siswa');
    Route::get('/laporan/siswa/cetak', [LaporanSiswaController::class, 'cetakPdf'])->name('laporan.siswa.pdf');

    Route::get('/laporan/guru', [LaporanGuruController::class, 'index'])->name('laporan.guru');
    Route::get('/laporan/guru/cetak', [LaporanGuruController::class, 'cetakPdf'])->name('laporan.guru.pdf');

    Route::get('/laporan/jadwal', [LaporanJadwalController::class, 'index'])->name('laporan.jadwal');
    Route::get('/laporan/jadwal/cetak', [LaporanJadwalController::class, 'cetakPdf'])->name('laporan.jadwal.pdf');

    });