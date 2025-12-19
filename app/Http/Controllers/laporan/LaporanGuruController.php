<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\Guru;

class LaporanGuruController extends Controller
{
    public function index()
    {
        $title = 'Laporan Data Guru';
        $sidebar = 'layouts.sidebar-kepsek';

        $guru = Guru::orderBy('nama', 'asc')->get();

        return view('kepsek.laporan.guru', compact(
            'title',
            'sidebar',
            'guru'
        ));
    }
}
