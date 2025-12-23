<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Models\TahunAjaran;
use App\Models\Kelas;

class JadwalGuruController extends Controller
{
    public function index(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();
        
        // Pastikan relasi user ke guru benar. 
        // Jika di tabel users ada kolom id_guru:
        $guruLogin = auth()->user()->id_guru; 
        
        // Jika menggunakan relasi (user hasOne guru):
        // $guruLogin = auth()->user()->guru->id_guru;

        $jadwal = JadwalPelajaran::with(['kelas','mapel'])
            ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
            ->where('id_guru', $guruLogin)

            // Filter Pencarian (Mapel / Kelas)
            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('mapel', fn ($m) =>
                            $m->where('nama_mapel', 'like', "%$search%"))
                        ->orWhereHas('kelas', fn ($k) =>
                            $k->where('nama_kelas', 'like', "%$search%"));
                });
            })

            // Filter Hari
            ->when($request->hari, fn ($q, $hari) =>
                $q->where('hari', $hari))

            // Filter Kelas Specific
            ->when($request->id_kelas, fn ($q, $id) =>
                $q->where('id_kelas', $id))

            // ORDER BY: FIELD agar urutan Senin -> Sabtu (Bukan Abjad)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('jam_mulai', 'ASC')
            ->get();

        // Ambil list kelas yang diajar oleh guru ini saja (untuk dropdown filter)
        // Atau semua kelas di tahun aktif (opsional)
        $listKelas = Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                          ->orderBy('nama_kelas')
                          ->get();

        return view('guru.jadwal.index', [
            'title'      => 'Jadwal Mengajar Saya',
            'jadwal'     => $jadwal,
            'kelas'      => $listKelas,
            'tahunAktif' => $tahunAktif
        ]);
    }
}