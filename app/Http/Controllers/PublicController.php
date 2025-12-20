<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 1. Import Model CMS (Konten)
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
use App\Models\TahunAjaran; 
use App\Models\Mapel;

class PublicController extends Controller
{
    /**
     * Halaman Utama (Beranda)
     */
    public function index()
    {
        // --- BAGIAN KONTEN ---
        $sliders = Slider::where('status', 'aktif')->get();
        $sambutan = SambutanKepsek::first(); // Mengambil satu data sambutan
        $pengumuman = Pengumuman::latest('tanggal')->take(2)->get();
        $artikelTerbaru = Artikel::where('status', 'publish')
                            ->latest('tanggal_publish')
                            ->take(3)
                            ->get();

        // --- BAGIAN STATISTIK (Count Data Real) ---
        // Menghitung jumlah baris di database
        $total_siswa = Siswa::count(); 
        $total_guru  = Guru::count();
        $total_kelas = Kelas::count(); 
        $total_mapel = Mapel::count(); 

        // --- BAGIAN TAHUN AJARAN ---
        // Mengambil tahun ajaran yang statusnya aktif (jika ada kolom status)
        // Atau ambil yang paling baru dibuat
        $ta_aktif = TahunAjaran::where('is_aktif', 1)->first();

        // Logika Format Tahun (Supaya jadi 2024/2025)
        if ($ta_aktif) {
            // Ambil kolom 'nama_tahun' dari database
            $rawTahun = $ta_aktif->nama_tahun; 

            // Cek apakah admin nulisnya sudah "2024/2025" atau cuma "2024"
            if (str_contains($rawTahun, '/')) {
                // Kalau sudah ada garis miring, pakai langsung
                $tahun_ajaran = $rawTahun; 
            } else {
                // Kalau cuma angka "2024", kita format manual jadi "2024/2025"
                $tahun_ajaran = $rawTahun . '/' . ((int)$rawTahun + 1);
            }
        } else {
            // Fallback jika belum ada tahun ajaran yang diset aktif
            $tahun_ajaran = date('Y') . '/' . (date('Y') + 1);
        }

        // Kirim semua variabel ke View
        return view('frontend.home', compact(
            'sliders', 
            'sambutan', 
            'pengumuman', 
            'artikelTerbaru',
            'total_siswa',
            'total_guru',
            'total_kelas',
            'total_mapel',
            'tahun_ajaran'
        ));
    }

    /**
     * Halaman Profil Sekolah
     */
    public function profil()
    {
        $profil = ProfilSekolah::first();
        $visi   = Visi::all();
        $misi   = Misi::all();
        
        return view('frontend.profil', compact('profil', 'visi', 'misi'));
    }

    /**
     * Halaman Kegiatan (Galeri Kegiatan)
     */
    public function kegiatan()
    {
        $kegiatan = Kegiatan::latest('tanggal_kegiatan')->paginate(9);
        return view('frontend.kegiatan', compact('kegiatan'));
    }

    /**
     * Halaman Prestasi
     */
    public function prestasi()
    {
        $prestasi = Prestasi::latest('tahun')->paginate(9);
        return view('frontend.prestasi', compact('prestasi'));
    }

    /**
     * Halaman Daftar Artikel/Berita
     */
    public function artikel()
    {
        $artikel = Artikel::where('status', 'publish')
                    ->latest('tanggal_publish')
                    ->paginate(6); 
        return view('frontend.artikel.index', compact('artikel'));
    }

    /**
     * Halaman Detail Artikel
     */
    public function detailArtikel($slug)
    {
        // Cek apakah pencarian by Slug atau ID (flexible)
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
     * Proses Kirim Feedback
     */
    public function kirimFeedback(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Feedback::create([
            'nama'  => $request->nama,
            'email' => $request->email,
            'komentar' => $request->pesan, // Sesuaikan dengan nama kolom di DB (komentar)
        ]);

        return back()->with('success', 'Terima kasih! Pesan Anda telah terkirim.');
    }
}