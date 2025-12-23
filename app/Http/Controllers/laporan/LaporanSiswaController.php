<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanSiswaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data dropdown (sebaiknya diurutkan agar rapi)
        $kelas = Kelas::orderBy('nama_kelas', 'ASC')->get();
        $tahunAjaran = TahunAjaran::orderBy('nama_tahun', 'DESC')->get();

        // 2. Query Data Siswa dengan Filter
        $query = Siswa::with(['kelas', 'tahunAjaran']); 

        if ($request->has('id_kelas') && $request->id_kelas != '') {
            $query->where('id_kelas', $request->id_kelas);
        }

        if ($request->has('id_tahun_ajaran') && $request->id_tahun_ajaran != '') {
            $query->where('id_tahun_ajaran', $request->id_tahun_ajaran);
        }

        // Ambil data
        $siswas = $query->get();

        return view('kepsek.laporan.siswa', [
            'title' => 'Laporan Data Siswa',
            'siswas' => $siswas,
            'kelas' => $kelas,
            'tahun_ajaran' => $tahunAjaran
        ]);
    }

    public function cetakPdf(Request $request)
    {
        // 1. Logika query filter (SAMA PERSIS dengan index)
        $query = Siswa::with(['kelas', 'tahunAjaran']);

        if ($request->has('id_kelas') && $request->id_kelas != '') {
            $query->where('id_kelas', $request->id_kelas);
        }

        if ($request->has('id_tahun_ajaran') && $request->id_tahun_ajaran != '') {
            $query->where('id_tahun_ajaran', $request->id_tahun_ajaran);
        }

        $siswas = $query->get();

        // 2. Ambil Label untuk Judul Laporan
        // PERBAIKAN DI SINI: Menggunakan safe navigation (?->) dan kolom 'nama_tahun'
        
        $labelKelas = 'Semua Kelas';
        if ($request->id_kelas) {
            $dataKelas = Kelas::find($request->id_kelas);
            // Cek jika data ditemukan untuk menghindari error
            if ($dataKelas) { 
                $labelKelas = $dataKelas->nama_kelas; 
            }
        }

        $labelTahun = 'Semua Tahun';
        if ($request->id_tahun_ajaran) {
            $dataTahun = TahunAjaran::find($request->id_tahun_ajaran);
            // PERBAIKAN: Gunakan 'nama_tahun' sesuai Model, bukan 'tahun'
            if ($dataTahun) { 
                $labelTahun = $dataTahun->nama_tahun; 
            }
        }

        // 3. Load view PDF
        $pdf = Pdf::loadView('kepsek.laporan.siswa_pdf', [
            'siswas' => $siswas,
            'filter_kelas' => $labelKelas,
            'filter_tahun' => $labelTahun,
        ]);

        // Set ukuran kertas (opsional, default A4 portrait)
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('laporan-siswa-' . date('d-m-Y') . '.pdf');
    }
}