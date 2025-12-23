<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\JadwalPelajaran;
use App\Models\Artikel;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Feedback;
use App\Models\Kontak;
use App\Models\Slider;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function ensureRole($roles)
    {
        if (is_string($roles)) {
            $roles = [$roles];
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Akses ditolak');
        }
    }

    private function getStatistikUmum()
    {
        return [
            'totalSiswa' => Siswa::count(),
            'totalGuru'  => Guru::count(),
            'totalKelas' => Kelas::count(),
            'totalMapel' => Mapel::count(),
        ];
    }

    /**
     * Helper aman ambil data terbaru (timestamp-aware)
     */
    private function ambilTerbaru(string $modelClass, string $kolomWaktu = 'created_at', int $limit = 2)
    {
        $model = new $modelClass;
        $table = $model->getTable();
        $pk    = $model->getKeyName();

        if (Schema::hasColumn($table, $kolomWaktu)) {
            return $model->newQuery()
                         ->orderByDesc($kolomWaktu)
                         ->take($limit)
                         ->get();
        }

        return $model->newQuery()
                     ->orderByDesc($pk)
                     ->take($limit)
                     ->get();
    }

    public function admin()
    {
        $this->ensureRole('admin');

       $stats = $this->getStatistikUmum();

        // ====== DISTRIBUSI SISWA PER KELAS ======
        $kelasDistribusi = Kelas::query()
            ->select('id_kelas', 'nama_kelas')
            ->withCount('siswa')
            ->orderBy('nama_kelas')
            ->get()
            ->map(fn ($k) => [
                'label'  => $k->nama_kelas,
                'jumlah' => (int) $k->siswa_count,
            ]);

        // ====== AKTIVITAS TERBARU ======
        $aktivitas = collect([]);

        // SISWA
        foreach ($this->ambilTerbaru(Siswa::class, 'created_at', 3) as $s) {
            $aktivitas->push([
                'icon'  => 'user-plus',
                'judul' => 'Siswa baru',
                'desc'  => $s->nama,
                'time'  => $s->created_at ?? now(),
            ]);
        }

        // GURU
        foreach ($this->ambilTerbaru(Guru::class, 'created_at', 2) as $g) {
            $aktivitas->push([
                'icon'  => 'user',
                'judul' => 'Guru ditambahkan',
                'desc'  => $g->nama_guru ?? 'Data guru baru',
                'time'  => $g->created_at ?? now(),
            ]);
        }

        // KELAS
        foreach ($this->ambilTerbaru(Kelas::class, 'created_at', 2) as $k) {
            $aktivitas->push([
                'icon'  => 'school',
                'judul' => 'Kelas baru',
                'desc'  => $k->nama_kelas,
                'time'  => $k->created_at ?? now(),
            ]);
        }

        // MAPEL
        foreach ($this->ambilTerbaru(Mapel::class, 'created_at', 2) as $m) {
            $aktivitas->push([
                'icon'  => 'book',
                'judul' => 'Mata pelajaran',
                'desc'  => $m->nama_mapel,
                'time'  => $m->created_at ?? now(),
            ]);
        }

        // JADWAL
        foreach ($this->ambilTerbaru(JadwalPelajaran::class, 'updated_at', 2) as $j) {
            $aktivitas->push([
                'icon'  => 'calendar',
                'judul' => 'Jadwal diperbarui',
                'desc'  => 'Jadwal pelajaran diubah',
                'time'  => $j->updated_at ?? now(),
            ]);
        }

        // ARTIKEL
        foreach ($this->ambilTerbaru(Artikel::class, 'created_at', 2) as $a) {
            $aktivitas->push([
                'icon'  => 'file-text',
                'judul' => 'Artikel baru',
                'desc'  => $a->judul,
                'time'  => $a->created_at ?? now(),
            ]);
        }

        // PENGUMUMAN
        foreach ($this->ambilTerbaru(Pengumuman::class, 'created_at', 2) as $p) {
            $aktivitas->push([
                'icon'  => 'megaphone',
                'judul' => 'Pengumuman',
                'desc'  => $p->judul,
                'time'  => $p->created_at ?? now(),
            ]);
        }

        // PRESTASI
        foreach ($this->ambilTerbaru(Prestasi::class, 'created_at', 2) as $pr) {
            $aktivitas->push([
                'icon'  => 'award',
                'judul' => 'Prestasi',
                'desc'  => $pr->judul,
                'time'  => $pr->created_at ?? now(),
            ]);
        }

        // GALERI
        foreach ($this->ambilTerbaru(Galeri::class, 'created_at', 2) as $g) {
            $aktivitas->push([
                'icon'  => 'image',
                'judul' => 'Galeri',
                'desc'  => 'Foto baru ditambahkan',
                'time'  => $g->created_at ?? now(),
            ]);
        }

        // KEGIATAN
        foreach ($this->ambilTerbaru(Kegiatan::class, 'created_at', 2) as $k) {
            $aktivitas->push([
                'icon'  => 'activity',
                'judul' => 'Kegiatan',
                'desc'  => $k->nama_kegiatan ?? 'Kegiatan baru',
                'time'  => $k->created_at ?? now(),
            ]);
        }

        // FEEDBACK
        foreach ($this->ambilTerbaru(Feedback::class, 'created_at', 2) as $f) {
            $aktivitas->push([
                'icon'  => 'message-circle',
                'judul' => 'Feedback masuk',
                'desc'  => 'Feedback dari pengunjung',
                'time'  => $f->created_at ?? now(),
            ]);
        }

        // KONTAK
        foreach ($this->ambilTerbaru(Kontak::class, 'created_at', 2) as $k) {
            $aktivitas->push([
                'icon'  => 'mail',
                'judul' => 'Pesan kontak',
                'desc'  => 'Pesan baru diterima',
                'time'  => $k->created_at ?? now(),
            ]);
        }

        // SLIDER
        foreach ($this->ambilTerbaru(Slider::class, 'created_at', 1) as $s) {
            $aktivitas->push([
                'icon'  => 'sliders',
                'judul' => 'Slider',
                'desc'  => 'Slider diperbarui',
                'time'  => $s->created_at ?? now(),
            ]);
        }

        $aktivitas = $aktivitas
            ->sortByDesc('time')
            ->values()
            ->take(5);

        return view('admin.dashboard', array_merge($stats, [
            'title'           => 'Dashboard Admin',
            'kelasDistribusi' => $kelasDistribusi,
            'aktivitas'       => $aktivitas,
        ]));
    }

   public function guru()
    {
        $this->ensureRole('guru');

        $stats = $this->getStatistikUmum();

        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd');
        $jadwalHariIni = JadwalPelajaran::with(['mapel', 'kelas'])
                            ->where('hari', $hariIni)
                            ->orderBy('jam_mulai')
                            ->get();

        $pengumuman = Pengumuman::latest()->take(3)->get();

        return view('guru.dashboard', array_merge($stats, [
            'title'         => 'Dashboard Guru',
            'jadwalHariIni' => $jadwalHariIni,
            'pengumuman'    => $pengumuman,
            'hariIni'       => $hariIni
        ]));
    }

    public function kepsek()
    {
        // Support dua kemungkinan nama role
        $this->ensureRole(['kepsek', 'kepala_sekolah']);

        $stats = $this->getStatistikUmum();

        $totalPrestasi   = Prestasi::count();
        $prestasiTerbaru = Prestasi::latest()->take(5)->get();
        $kelasDistribusi = Kelas::withCount('siswa')->orderBy('nama_kelas')->get();

        return view('kepsek.dashboard', array_merge($stats, [
            'title'           => 'Dashboard Kepala Sekolah',
            'totalPrestasi'   => $totalPrestasi,
            'prestasiTerbaru' => $prestasiTerbaru,
            'kelasDistribusi' => $kelasDistribusi
        ]));
    }
}
