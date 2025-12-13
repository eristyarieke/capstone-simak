<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    /* ============================================================
       ===============  LIST JADWAL ADMIN  ========================
       ============================================================ */

    public function admin(Request $request)
{
    $search   = $request->search;
    $hari     = $request->hari;
    $idKelas  = $request->id_kelas;
    $idGuru   = $request->id_guru;

    $jadwal = JadwalPelajaran::with(['kelas','mapel','guru'])

        // SEARCH (grouped)
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->whereHas('kelas', function ($c) use ($search) {
                        $c->where('nama_kelas', 'like', "%$search%");
                    })
                    ->orWhereHas('mapel', function ($m) use ($search) {
                        $m->where('nama_mapel', 'like', "%$search%");
                    })
                    ->orWhereHas('guru', function ($g) use ($search) {
                        $g->where('nama', 'like', "%$search%");
                    });
            });
        })

        // FILTER: Hari
        ->when($hari, function ($q) use ($hari) {
            $q->where('hari', $hari);
        })

        // FILTER: Kelas
        ->when($idKelas, function ($q) use ($idKelas) {
            $q->where('id_kelas', $idKelas);
        })

        // FILTER: Guru
        ->when($idGuru, function ($q) use ($idGuru) {
            $q->where('id_guru', $idGuru);
        })

        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get();

    return view('admin.jadwal.index', [
        'title'   => 'Admin - Jadwal Pelajaran',
        'sidebar' => 'layouts.sidebar-admin',
        'jadwal'  => $jadwal,
        'kelas'   => Kelas::orderBy('nama_kelas')->get(),
        'guru'    => Guru::orderBy('nama')->get(),
    ]);
}

    /* ============================================================
       ====================  FORM TAMBAH  =========================
       ============================================================ */

    public function create()
    {
        $tahunAktif = TahunAjaran::aktif();

        return view('admin.jadwal.create', [
            'title'   => 'Tambah Jadwal',
            'sidebar' => 'layouts.sidebar-admin',
            'kelas'   => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'mapel'   => Mapel::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'guru'    => Guru::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
        ]);
    }

    /* ============================================================
       ======================  SIMPAN DATA  =======================
       ============================================================ */

    public function store(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $validated = $request->validate([
            'id_kelas'    => 'required|exists:kelas,id_kelas',
            'id_mapel'    => 'required|exists:mapel,id_mapel',
            'id_guru'     => 'required|exists:guru,id_guru',
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $validated['id_tahun_ajaran'] = $tahunAktif->id_tahun_ajaran;

        JadwalPelajaran::create($validated);

        return redirect()->route('jadwal.admin')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /* ============================================================
       ========================  EDIT  ============================
       ============================================================ */

    public function edit($id)
    {
        $tahunAktif = TahunAjaran::aktif();

        return view('admin.jadwal.edit', [
            'title'   => 'Edit Jadwal',
            'sidebar' => 'layouts.sidebar-admin',
            'jadwal'  => JadwalPelajaran::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                            ->findOrFail($id),
            'kelas'   => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'mapel'   => Mapel::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'guru'    => Guru::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
        ]);
    }

    /* ============================================================
       ======================  UPDATE  ============================
       ============================================================ */

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_kelas'    => 'required|exists:kelas,id_kelas',
            'id_mapel'    => 'required|exists:mapel,id_mapel',
            'id_guru'     => 'required|exists:guru,id_guru',
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        JadwalPelajaran::findOrFail($id)->update($validated);

        return redirect()->route('jadwal.admin')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    /* ============================================================
       ========================  HAPUS  ============================
       ============================================================ */

    public function destroy($id)
    {
        JadwalPelajaran::findOrFail($id)->delete();

        return redirect()->route('jadwal.admin')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    /* ============================================================
       ===============  LIST UNTUK GURU  ==========================
       ============================================================ */

    public function guru()
    {
        $tahunAktif = TahunAjaran::aktif();
    $guruLogin  = auth()->user()->id_guru;

    $search = $request->search;
    $hari   = $request->hari;
    $kelas  = $request->id_kelas;

    $jadwal = JadwalPelajaran::with(['kelas','mapel'])
        ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
        ->where('id_guru', $guruLogin)

        // SEARCH
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->whereHas('mapel', function ($m) use ($search) {
                        $m->where('nama_mapel', 'like', "%$search%");
                    })
                    ->orWhereHas('kelas', function ($k) use ($search) {
                        $k->where('nama_kelas', 'like', "%$search%");
                    });
            });
        })

        // FILTER HARI
        ->when($hari, function ($q) use ($hari) {
            $q->where('hari', $hari);
        })

        // FILTER KELAS
        ->when($kelas, function ($q) use ($kelas) {
            $q->where('id_kelas', $kelas);
        })

        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get();

    return view('guru.jadwal.index', [
        'title'   => 'Guru - Jadwal Pelajaran',
        'sidebar' => 'layouts.sidebar-guru',
        'jadwal'  => $jadwal,
        'kelas'   => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                            ->orderBy('nama_kelas')
                            ->get(),
    ]);
    }

    /* ============================================================
       ================  LIST UNTUK KEPSEK  =======================
       ============================================================ */

    public function kepsek(Request $request)
{
    $tahunAktif = TahunAjaran::aktif();

    $search  = $request->search;
    $hari    = $request->hari;
    $idKelas = $request->id_kelas;
    $idGuru  = $request->id_guru;

    $jadwal = JadwalPelajaran::with(['kelas','mapel','guru'])
        ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)

        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->whereHas('kelas', fn($k) =>
                        $k->where('nama_kelas','like',"%$search%"))
                    ->orWhereHas('mapel', fn($m) =>
                        $m->where('nama_mapel','like',"%$search%"))
                    ->orWhereHas('guru', fn($g) =>
                        $g->where('nama','like',"%$search%"));
            });
        })

        ->when($hari, fn($q) => $q->where('hari',$hari))
        ->when($idKelas, fn($q) => $q->where('id_kelas',$idKelas))
        ->when($idGuru, fn($q) => $q->where('id_guru',$idGuru))

        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get();

    return view('kepsek.jadwal.index', [
        'title'   => 'Kepala Sekolah - Jadwal Pelajaran',
        'sidebar' => 'layouts.sidebar-kepsek',
        'jadwal'  => $jadwal,
        'kelas'   => Kelas::orderBy('nama_kelas')->get(),
        'guru'    => Guru::orderBy('nama')->get(),
    ]);
}

public function exportPdf(Request $request)
{
    $tahunAktif = TahunAjaran::aktif();

    // Ambil kelas dari database
    $kelasList = Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
        ->orderBy('nama_kelas')
        ->get();

    // Ambil jadwal
    $jadwalRaw = JadwalPelajaran::with(['kelas','mapel','guru'])
        ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get();

    // Bentuk grid: [hari][jam][id_kelas]
    $grid = [];
    foreach ($jadwalRaw as $j) {
        $jam = $j->jam_mulai.'-'.$j->jam_selesai;
        $grid[$j->hari][$jam][$j->id_kelas] = $j;
    }

    // Daftar hari & jam unik (berdasarkan data)
    $hariList = $jadwalRaw->pluck('hari')->unique();
    $jamList  = $jadwalRaw
        ->map(fn($j) => $j->jam_mulai.'-'.$j->jam_selesai)
        ->unique();

    $pdf = Pdf::loadView('kepsek.jadwal.pdf', [
        'tahun'     => $tahunAktif,
        'kelasList' => $kelasList,
        'hariList'  => $hariList,
        'jamList'   => $jamList,
        'grid'      => $grid,
    ])->setPaper('legal', 'landscape');

    return $pdf->download('jadwal-pelajaran.pdf');
}

}
