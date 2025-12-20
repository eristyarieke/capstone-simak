<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\JadwalPelajaran;
use App\Models\Prestasi;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function ensureRole(string $role)
    {
        if (Auth::user()->role !== $role) {
            abort(403, 'Akses ditolak');
        }
    }

    public function admin()
    {
        $this->ensureRole('admin');

        // ====== CARD COUNTS ======
        $totalSiswa = Siswa::count();
        $totalGuru  = Guru::count();
        $totalKelas = Kelas::count();
        $totalMapel = Mapel::count();

        // ====== DISTRIBUSI SISWA PER KELAS ======
        // Relasi sudah ada: Kelas::siswa() => hasMany(Siswa::class, 'id_kelas')
        $kelasDistribusi = Kelas::query()
            ->select('id_kelas', 'nama_kelas')
            ->withCount('siswa')              // hasilnya: siswa_count
            ->orderBy('nama_kelas')
            ->get()
            ->map(function ($k) {
                return [
                    'label'  => $k->nama_kelas,
                    'jumlah' => (int) $k->siswa_count,
                ];
            });

        // ====== AKTIVITAS TERBARU ======
        $aktivitas = collect([]);

        // 1) Siswa baru terdaftar (kalau tabel siswa punya timestamps)
        // Kalau tabel siswa tidak punya created_at, kamu bisa ganti ke orderBy('id_siswa','desc')
        $siswaBaru = Siswa::query()
            ->select('id_siswa', 'nama', 'id_kelas', 'created_at')
            ->latest('created_at')
            ->take(3)
            ->get();

        foreach ($siswaBaru as $s) {
            $aktivitas->push([
                'icon'  => 'user-plus',
                'judul' => 'Siswa baru terdaftar',
                'desc'  => $s->kelas ? "{$s->nama} mendaftar di {$s->kelas->nama_kelas}" : "{$s->nama} baru terdaftar",
                'time'  => $s->created_at,
            ]);
        }

        // 2) Jadwal pelajaran diperbarui
        $jadwalUpdate = JadwalPelajaran::query()
            ->select('id_jadwal', 'updated_at')
            ->latest('updated_at')
            ->take(2)
            ->get();

        foreach ($jadwalUpdate as $j) {
            $aktivitas->push([
                'icon'  => 'calendar',
                'judul' => 'Jadwal Pelajaran Diperbarui',
                'desc'  => 'Jadwal pelajaran telah diperbarui.',
                'time'  => $j->updated_at,
            ]);
        }

        // 3) Prestasi terbaru (jika tabel prestasi punya timestamps)
        // Jika prestasi kamu tidak ada created_at, bagian ini aman karena kita fallback.
        try {
            $prestasiTerbaru = Prestasi::query()
                ->select('judul', 'created_at')
                ->latest('created_at')
                ->take(2)
                ->get();

            foreach ($prestasiTerbaru as $p) {
                $aktivitas->push([
                    'icon'  => 'book-check',
                    'judul' => 'Prestasi ditambahkan',
                    'desc'  => "Prestasi baru: {$p->judul}",
                    'time'  => $p->created_at,
                ]);
            }
        } catch (\Throwable $e) {
            // fallback: jika kolom created_at tidak ada
        }

        // urutkan aktivitas dari yang terbaru, buang yang time null
        $aktivitas = $aktivitas
            ->filter(fn ($a) => !empty($a['time']))
            ->sortByDesc(fn ($a) => $a['time'])
            ->values()
            ->take(6);

        return view('admin.dashboard', [
            'title'           => 'Dashboard Admin',
            'totalSiswa'      => $totalSiswa,
            'totalGuru'       => $totalGuru,
            'totalKelas'      => $totalKelas,
            'totalMapel'      => $totalMapel,
            'kelasDistribusi' => $kelasDistribusi,
            'aktivitas'       => $aktivitas,
        ]);
    }

    public function guru()
    {
        $this->ensureRole('guru');

        return view('guru.dashboard', [
            'title' => 'Dashboard Guru',
        ]);
    }

    public function kepsek()
    {
        $this->ensureRole('kepala_sekolah');

        return view('kepsek.dashboard', [
            'title' => 'Dashboard Kepala Sekolah',
        ]);
    }
}
