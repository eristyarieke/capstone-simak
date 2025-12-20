<?php

namespace App\Http\Controllers\landingpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import semua model sesuai tabel di database
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Artikel;
use App\Models\Kontak;
use App\Models\Slider;
use App\Models\SambutanKepsek;
use App\Models\ProfilSekolah;
use App\Models\Visi;
use App\Models\Misi;
use App\Models\Feedback;
use App\Models\Pengumuman;

class KelolaHalamanController extends Controller
{
    // Dashboard Utama Kelola Halaman
    public function index()
    {
        return view('admin.halaman.index');
    }

    // Mengelola Banner / Sliders
    public function banner()
    {
        $banners = Slider::all();
        return view('admin.halaman.banner.index', compact('banners'));
    }

    // Mengelola Sambutan Kepala Sekolah
    public function sambutan()
    {
        $sambutan = SambutanKepsek::first(); // Biasanya hanya ada satu data
        return view('admin.halaman.sambutan.edit', compact('sambutan'));
    }

    // Mengelola Profil Sekolah (Tentang Sekolah)
    public function profil()
    {
        $profil = ProfilSekolah::first();
        return view('admin.halaman.profil.edit', compact('profil'));
    }

    // Mengelola Visi & Misi
    public function visiMisi()
    {
        $visi = Visi::all();
        $misi = Misi::all();
        return view('admin.halaman.visimisi.index', compact('visi', 'misi'));
    }

    // Mengelola Galeri (Foto Kegiatan/Prestasi/Umum)
    public function galeri()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')->get();
        return view('admin.halaman.galeri.index', compact('galeri'));
    }

    // Mengelola Kegiatan
    public function kegiatan()
    {
        $kegiatan = Kegiatan::orderBy('tanggal_kegiatan', 'desc')->get();
        return view('admin.halaman.kegiatan.index', compact('kegiatan'));
    }

    // Mengelola Prestasi
    public function prestasi()
    {
        $prestasi = Prestasi::orderBy('tahun', 'desc')->get();
        return view('admin.halaman.prestasi.index', compact('prestasi'));
    }

    // Mengelola Artikel / Berita
    public function artikel()
    {
        $artikel = Artikel::orderBy('tanggal_publish', 'desc')->get();
        return view('admin.halaman.artikel.index', compact('artikel'));
    }

    // Mengelola Pengumuman
    public function pengumuman()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->get();
        return view('admin.halaman.pengumuman.index', compact('pengumuman'));
    }

    // Mengelola Kontak & Alamat
    public function kontak()
    {
        $kontak = Kontak::first();
        return view('admin.halaman.kontak.edit', compact('kontak'));
    }

    // Melihat Feedback dari pengunjung
    public function feedback()
    {
        $feedback = Feedback::orderBy('created_at', 'desc')->get();
        return view('admin.halaman.feedback.index', compact('feedback'));
    }
}