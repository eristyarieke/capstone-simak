<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Model
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
use App\Models\Galeri;
use App\Models\TahunAjaran;

class PublicController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'aktif')->get();

        $sambutan = SambutanKepsek::first();

        $pengumuman = Pengumuman::where('status', 'tampil')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        $artikelTerbaru = Artikel::where('status', 'publish')
            ->orderBy('tanggal_publish', 'desc')
            ->limit(3)
            ->get();

        $total_siswa = Siswa::count();
        $total_guru  = Guru::count();
        $total_kelas = Kelas::count();
        $total_mapel = Mapel::count();

        $ta_aktif = TahunAjaran::where('is_aktif', 1)->first();
        $tahun_ajaran = $ta_aktif
            ? (str_contains($ta_aktif->nama_tahun, '/')
                ? $ta_aktif->nama_tahun
                : $ta_aktif->nama_tahun . '/' . ((int)$ta_aktif->nama_tahun + 1))
            : date('Y') . '/' . (date('Y') + 1);

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

    public function profil()
    {
        // 1. Ambil data SambutanKepsek lagi
        $sambutan = SambutanKepsek::first();

        return view('frontend.profil', [
            'profil'   => ProfilSekolah::first(),
            'visi'     => Visi::all(),
            'misi'     => Misi::all(),
            'galeri'   => Galeri::latest()->limit(6)->get(),
            // 2. Kirim ke view
            'sambutan' => $sambutan, 
        ]);
    }

    public function kegiatan()
    {
        return view('frontend.kegiatan', [
            'kegiatan' => Kegiatan::orderBy('tanggal_kegiatan', 'desc')->paginate(9)
        ]);
    }

    public function prestasi()
    {
        return view('frontend.prestasi', [
            'prestasi' => Prestasi::orderBy('tahun', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate(9)
        ]);
    }

    public function artikel()
    {
        return view('frontend.artikel.index', [
            'artikel' => Artikel::where('status', 'publish')
                ->orderBy('tanggal_publish', 'desc')
                ->paginate(6)
        ]);
    }

    public function detailArtikel($id)
{
    $berita = Artikel::where('status', 'publish')
        ->where('id', $id)
        ->firstOrFail();

    return view('frontend.artikel.detail', compact('berita'));
}


    public function kontak()
    {
        return view('frontend.kontak', [
            'kontak' => Kontak::first()
        ]);
    }

    public function kirimFeedback(Request $request)
{
    $request->validate([
        'nama'  => 'required|string|max:100',
        'pesan' => 'required|string',
    ]);

    Feedback::create([
        'nama'     => $request->nama,
        'komentar' => $request->pesan,
    ]);

    return back()->with('success', 'Pesan berhasil dikirim.');
}
}
