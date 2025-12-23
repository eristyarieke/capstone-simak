<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanGuruController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data untuk Filter
        // Kita ambil daftar jabatan unik yang ada di database agar filter dinamis
        $jabatanList = Guru::select('jabatan')->distinct()->pluck('jabatan');
        $tahunAjaran = TahunAjaran::orderBy('nama_tahun', 'DESC')->get();

        // 2. Query Data Guru
        $query = Guru::with(['tahunAjaran']);

        // Filter Tahun Ajaran
        if ($request->has('id_tahun_ajaran') && $request->id_tahun_ajaran != '') {
            $query->where('id_tahun_ajaran', $request->id_tahun_ajaran);
        }

        // Filter Jabatan
        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->where('jabatan', $request->jabatan);
        }

        $gurus = $query->orderBy('nama', 'ASC')->get();

        return view('kepsek.laporan.guru', [
            'title' => 'Laporan Data Guru',
            'gurus' => $gurus,
            'tahun_ajaran' => $tahunAjaran,
            'jabatan_list' => $jabatanList
        ]);
    }

    public function cetakPdf(Request $request)
    {
        // 1. Query Data (Sama persis dengan index)
        $query = Guru::with(['tahunAjaran']);

        if ($request->has('id_tahun_ajaran') && $request->id_tahun_ajaran != '') {
            $query->where('id_tahun_ajaran', $request->id_tahun_ajaran);
        }

        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->where('jabatan', $request->jabatan);
        }

        $gurus = $query->get();

        // 2. Siapkan Label untuk Judul Laporan PDF
        $labelTahun = 'Semua Tahun';
        if ($request->id_tahun_ajaran) {
            $dataTahun = TahunAjaran::find($request->id_tahun_ajaran);
            if ($dataTahun) {
                $labelTahun = $dataTahun->nama_tahun; // Sesuai model TahunAjaran
            }
        }

        $labelJabatan = $request->jabatan ? $request->jabatan : 'Semua Jabatan';

        // 3. Generate PDF
        $pdf = Pdf::loadView('kepsek.laporan.guru_pdf', [
            'gurus' => $gurus,
            'filter_tahun' => $labelTahun,
            'filter_jabatan' => $labelJabatan,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('laporan-guru-' . date('d-m-Y') . '.pdf');
    }
}