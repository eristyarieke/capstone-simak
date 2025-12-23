<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanJadwalController extends Controller
{
    public function index(Request $request)
    {
        // 1. Data untuk Dropdown Filter
        $kelas = Kelas::orderBy('nama_kelas', 'ASC')->get();
        $tahunAjaran = TahunAjaran::orderBy('nama_tahun', 'DESC')->get();
        $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

        // 2. Query Jadwal
        $query = JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'tahunAjaran']);

        // Filter Kelas
        if ($request->has('id_kelas') && $request->id_kelas != '') {
            $query->where('id_kelas', $request->id_kelas);
        }

        // Filter Tahun Ajaran
        if ($request->has('id_tahun_ajaran') && $request->id_tahun_ajaran != '') {
            $query->where('id_tahun_ajaran', $request->id_tahun_ajaran);
        }

        // Filter Hari
        if ($request->has('hari') && $request->hari != '') {
            $query->where('hari', $request->hari);
        }

        // Sorting: Hari (Senin-Sabtu) lalu Jam Mulai
        $jadwals = $query->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
                         ->orderBy('jam_mulai', 'ASC')
                         ->get();

        return view('kepsek.laporan.jadwal', [
            'title' => 'Laporan Jadwal Pelajaran',
            'jadwals' => $jadwals,
            'kelas' => $kelas,
            'tahun_ajaran' => $tahunAjaran,
            'hari_list' => $hariList
        ]);
    }

    public function cetakPdf(Request $request)
    {
        // 1. Query (Sama persis dengan index)
        $query = JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'tahunAjaran']);

        if ($request->has('id_kelas') && $request->id_kelas != '') {
            $query->where('id_kelas', $request->id_kelas);
        }
        if ($request->has('id_tahun_ajaran') && $request->id_tahun_ajaran != '') {
            $query->where('id_tahun_ajaran', $request->id_tahun_ajaran);
        }
        if ($request->has('hari') && $request->hari != '') {
            $query->where('hari', $request->hari);
        }

        $jadwals = $query->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
                         ->orderBy('jam_mulai', 'ASC')
                         ->get();

        // 2. Siapkan Label Filter untuk Judul PDF
        $labelKelas = $request->id_kelas ? Kelas::find($request->id_kelas)->nama_kelas : 'Semua Kelas';
        
        $labelTahun = 'Semua Tahun';
        if ($request->id_tahun_ajaran) {
            $dt = TahunAjaran::find($request->id_tahun_ajaran);
            if ($dt) $labelTahun = $dt->nama_tahun;
        }

        $labelHari = $request->hari ? $request->hari : 'Semua Hari';

        // 3. Generate PDF
        $pdf = Pdf::loadView('kepsek.laporan.jadwal_pdf', [
            'jadwals' => $jadwals,
            'filter_kelas' => $labelKelas,
            'filter_tahun' => $labelTahun,
            'filter_hari' => $labelHari,
        ]);

        return $pdf->download('laporan-jadwal-' . date('d-m-Y') . '.pdf');
    }
}