<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // pastikan sudah login
        $this->middleware('auth');
    }

    public function admin()
    {
        // proteksi tambahan: role
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        return view('admin.dashboard', [
            'title' => 'Dashboard Admin',
        ]);
    }

    public function guru()
    {
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Akses ditolak');
        }

        return view('guru.dashboard', [
            'title' => 'Dashboard Guru',
        ]);
    }

    public function kepsek()
    {
        if (Auth::user()->role !== 'kepala_sekolah') {
            abort(403, 'Akses ditolak');
        }

        return view('kepsek.dashboard', [
            'title' => 'Dashboard Kepala Sekolah',
        ]);
    }
}
