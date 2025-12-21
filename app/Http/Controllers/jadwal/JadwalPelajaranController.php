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
       ==================  LIST JADWAL ADMIN  ====================
       ============================================================ */
    public function admin(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $jadwal = JadwalPelajaran::with(['kelas','mapel','guru'])
            ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)

            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('kelas', fn ($k) =>
                            $k->where('nama_kelas', 'like', "%$search%"))
                        ->orWhereHas('mapel', fn ($m) =>
                            $m->where('nama_mapel', 'like', "%$search%"))
                        ->orWhereHas('guru', fn ($g) =>
                            $g->where('nama', 'like', "%$search%"));
                });
            })

            ->when($request->hari, fn ($q, $hari) =>
                $q->where('hari', $hari))

            ->when($request->id_kelas, fn ($q, $id) =>
                $q->where('id_kelas', $id))

            ->when($request->id_guru, fn ($q, $id) =>
                $q->where('id_guru', $id))

            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('admin.jadwal.index', [
            'title'  => 'Admin - Jadwal Pelajaran',
            'jadwal' => $jadwal,
            'kelas'  => Kelas::orderBy('nama_kelas')->get(),
            'guru'   => Guru::orderBy('nama')->get(),
        ]);
    }

    /* ============================================================
       =====================  FORM TAMBAH  ========================
       ============================================================ */
    public function create()
    {
        $tahunAktif = TahunAjaran::aktif();

        return view('admin.jadwal.create', [
            'title' => 'Tambah Jadwal',
            'kelas' => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'mapel' => Mapel::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'guru'  => Guru::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
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

        return redirect()
            ->route('admin.jadwal')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /* ============================================================
       ========================  EDIT  ============================
       ============================================================ */
    public function edit($id)
    {
        $tahunAktif = TahunAjaran::aktif();

        return view('admin.jadwal.edit', [
            'title'  => 'Edit Jadwal',
            'jadwal' => JadwalPelajaran::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                            ->findOrFail($id),
            'kelas'  => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'mapel'  => Mapel::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
            'guru'   => Guru::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get(),
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

        return redirect()
            ->route('admin.jadwal')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    /* ============================================================
       ========================  HAPUS  ===========================
       ============================================================ */
    public function destroy($id)
    {
        JadwalPelajaran::findOrFail($id)->delete();

        return redirect()
            ->route('admin.jadwal')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    /* ============================================================
       ==================  LIST JADWAL GURU  ======================
       ============================================================ */
    public function guru(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();
        $guruLogin  = auth()->user()->id_guru;

        $jadwal = JadwalPelajaran::with(['kelas','mapel'])
            ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
            ->where('id_guru', $guruLogin)

            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('mapel', fn ($m) =>
                            $m->where('nama_mapel', 'like', "%$search%"))
                        ->orWhereHas('kelas', fn ($k) =>
                            $k->where('nama_kelas', 'like', "%$search%"));
                });
            })

            ->when($request->hari, fn ($q, $hari) =>
                $q->where('hari', $hari))

            ->when($request->id_kelas, fn ($q, $id) =>
                $q->where('id_kelas', $id))

            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('guru.jadwal.index', [
            'title'  => 'Guru - Jadwal Pelajaran',
            'jadwal' => $jadwal,
            'kelas'  => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                            ->orderBy('nama_kelas')->get(),
        ]);
    }

    /* ============================================================
       =================  LIST JADWAL KEPSEK  =====================
       ============================================================ */
    public function kepsek(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $jadwal = JadwalPelajaran::with(['kelas','mapel','guru'])
            ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)

            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('kelas', fn ($k) =>
                            $k->where('nama_kelas', 'like', "%$search%"))
                        ->orWhereHas('mapel', fn ($m) =>
                            $m->where('nama_mapel', 'like', "%$search%"))
                        ->orWhereHas('guru', fn ($g) =>
                            $g->where('nama', 'like', "%$search%"));
                });
            })

            ->when($request->hari, fn ($q, $hari) =>
                $q->where('hari', $hari))

            ->when($request->id_kelas, fn ($q, $id) =>
                $q->where('id_kelas', $id))

            ->when($request->id_guru, fn ($q, $id) =>
                $q->where('id_guru', $id))

            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('kepsek.jadwal.index', [
            'title'  => 'Kepala Sekolah - Jadwal Pelajaran',
            'jadwal' => $jadwal,
            'kelas'  => Kelas::orderBy('nama_kelas')->get(),
            'guru'   => Guru::orderBy('nama')->get(),
        ]);
    }

    /* ============================================================
       ======================  EXPORT PDF  ========================
       ============================================================ */
    public function exportPdf()
    {
        $tahunAktif = TahunAjaran::aktif();

        $kelasList = Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
            ->orderBy('nama_kelas')
            ->get();

        $jadwalRaw = JadwalPelajaran::with(['kelas','mapel','guru'])
            ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        $grid = [];
        foreach ($jadwalRaw as $j) {
            $jam = $j->jam_mulai . '-' . $j->jam_selesai;
            $grid[$j->hari][$jam][$j->id_kelas] = $j;
        }

        $pdf = Pdf::loadView('kepsek.jadwal.pdf', [
            'tahun'     => $tahunAktif,
            'kelasList' => $kelasList,
            'hariList'  => $jadwalRaw->pluck('hari')->unique(),
            'jamList'   => $jadwalRaw->map(fn ($j) =>
                            $j->jam_mulai . '-' . $j->jam_selesai)->unique(),
            'grid'      => $grid,
        ])->setPaper('legal', 'landscape');

        return $pdf->download('jadwal-pelajaran.pdf');
    }
}
