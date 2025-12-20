<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

// --- IMPORT SEMUA MODEL ---
use App\Models\Slider;
use App\Models\SambutanKepsek;
use App\Models\Pengumuman;
use App\Models\Artikel;
use App\Models\ProfilSekolah;
use App\Models\Visi;
use App\Models\Misi;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Kontak;
use App\Models\Feedback;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;

class PublicController extends Controller
{
    /**
     * Halaman Utama (Beranda)
     */
    public function index()
    {
        // 1. KONTEN
        $sliders = Slider::where('status', 'aktif')->get();
        $sambutan = SambutanKepsek::first();
        $pengumuman = Pengumuman::latest('tanggal')->take(2)->get();
        $artikelTerbaru = Artikel::where('status', 'publish')
                            ->latest('tanggal_publish')
                            ->take(3)
                            ->get();

        // 2. STATISTIK
        $total_siswa = Siswa::count();
        $total_guru  = Guru::count();
        $total_kelas = Kelas::count();
        $total_mapel = Mapel::count(); // Tambahan untuk statistik mapel

        // 3. TAHUN AJARAN (Logika Smart Format)
        $ta_aktif = TahunAjaran::where('is_aktif', 1)->first();
        
        if ($ta_aktif) {
            $rawTahun = $ta_aktif->nama_tahun;
            if (str_contains($rawTahun, '/')) {
                $tahun_ajaran = $rawTahun;
            } else {
                $tahun_ajaran = $rawTahun . '/' . ((int)$rawTahun + 1);
            }
        } else {
            $tahun_ajaran = date('Y') . '/' . (date('Y') + 1);
        }

        return view('frontend.home', compact(
            'sliders', 'sambutan', 'pengumuman', 'artikelTerbaru',
            'total_siswa', 'total_guru', 'total_kelas', 'total_mapel',
            'tahun_ajaran'
        ));
    }

    /**
     * Halaman Profil Sekolah
     */
    public function profil()
    {
        // 1. Ambil data Profil
        $profil = ProfilSekolah::first();

        // 2. Ambil data Visi & Misi
        $visi = Visi::all();
        $misi = Misi::all();
        
        // 3. Ambil data Galeri (Ambil 4 foto terbaru untuk footer halaman profil)
        // Jika belum ada data Galeri, kode view tetap aman (tidak error)
        $galeri = Galeri::latest()->take(4)->get(); 
        
        return view('frontend.profil', compact('profil', 'visi', 'misi', 'galeri'));
    }

    /**
     * Halaman Galeri Kegiatan
     */
    public function kegiatan()
    {
        // Tampilkan 9 foto per halaman
        $kegiatan = Kegiatan::latest('tanggal_kegiatan')->paginate(9);
        return view('frontend.kegiatan', compact('kegiatan'));
    }

    /**
     * Halaman Prestasi
     */
    public function prestasi()
    {
        // Tampilkan 9 prestasi per halaman
        $prestasi = Prestasi::latest('tahun')->paginate(9);
        return view('frontend.prestasi', compact('prestasi'));
    }

    /**
     * Halaman List Artikel
     */
    public function artikel()
    {
        // Hanya yang status publish, 6 artikel per halaman
        $artikel = Artikel::where('status', 'publish')
                    ->latest('tanggal_publish')
                    ->paginate(6);
        
        return view('frontend.artikel.index', compact('artikel'));
    }

    /**
     * Halaman Baca Detail Artikel
     */
    public function detailArtikel($slug)
    {
        // Cari berdasarkan Slug dulu, kalau tidak ketemu coba cari by ID
        $berita = Artikel::where('slug', $slug)
                    ->orWhere('id', $slug)
                    ->firstOrFail();

        return view('frontend.artikel.detail', compact('berita'));
    }

    /**
     * Halaman Kontak
     */
    public function kontak()
    {
        $kontak = Kontak::first();
        return view('frontend.kontak', compact('kontak'));
    }

    /**
     * Proses Simpan Pesan dari Pengunjung (Feedback)
     */
    public function kirimFeedback(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Feedback::create([
            'nama'      => $request->nama,
            'email'     => $request->email,
            'komentar'  => $request->pesan, // Pastikan kolom di DB namanya 'komentar'
            'tanggal'   => now(), // Opsional jika tidak auto-timestamp
        ]);

        return back()->with('success', 'Terima kasih! Pesan Anda telah terkirim.');
    }
}