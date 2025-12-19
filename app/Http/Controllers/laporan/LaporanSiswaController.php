<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\Siswa;

class LaporanSiswaController extends Controller
{
    public function index()
    {
        $title = 'Laporan Data Siswa';

        $sidebar = 'layouts.sidebar-kepsek';

        $siswa = Siswa::with('kelas')
            ->orderBy('nama', 'asc')
            ->get();

        return view('kepsek.laporan.siswa', compact(
            'title',
            'sidebar',
            'siswa'
        ));
    }
}
