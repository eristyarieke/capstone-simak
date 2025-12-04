<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    /* ============================================================
       ===============  HALAMAN LIST UNTUK ADMIN  =================
       ============================================================ */

    public function admin(Request $request)
    {
        $search = $request->search;

        $jadwal = JadwalPelajaran::with(['kelas','mapel','guru'])
            ->when($search, function($q) use ($search) {
                $q->whereHas('kelas', fn($c) => $c->where('nama_kelas','like','%'.$search.'%'))
                  ->orWhereHas('mapel', fn($m) => $m->where('nama_mapel','like','%'.$search.'%'))
                  ->orWhere('hari','like','%'.$search.'%');
            })
            ->get();

        return view('admin.jadwal.index', [
            'title'   => 'Admin - Jadwal Pelajaran',
            'sidebar' => 'layouts.sidebar-admin',
            'jadwal'  => $jadwal,
        ]);
    }

    /* ============================================================
       ====================  FORM TAMBAH  =========================
       ============================================================ */

    public function create()
    {
        return view('admin.jadwal.create', [
            'title'   => 'Tambah Jadwal',
            'sidebar' => 'layouts.sidebar-admin',
            'kelas'   => Kelas::all(),
            'mapel'   => Mapel::all(),
            'guru'    => Guru::all(),
        ]);
    }

    /* ============================================================
       ======================  SIMPAN DATA  =======================
       ============================================================ */

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas'    => 'required',
            'id_mapel'    => 'required',
            'id_guru'     => 'required',
            'hari'        => 'required',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
            'ruang'       => 'required',
        ]);

        JadwalPelajaran::create($request->all());

        return redirect()->route('jadwal.admin')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /* ============================================================
       ========================  EDIT  ============================
       ============================================================ */

    public function edit($id)
{
    return view('admin.jadwal.edit', [
        'title'   => 'Edit Jadwal',
        'sidebar' => 'layouts.sidebar-admin',
        'jadwal' => JadwalPelajaran::findOrFail($id),
        'kelas'   => Kelas::all(),
        'mapel'   => Mapel::all(),
        'guru'    => Guru::all(),
    ]);
}


    /* ============================================================
       ======================  UPDATE  ============================
       ============================================================ */

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kelas'    => 'required',
            'id_mapel'    => 'required',
            'id_guru'     => 'required',
            'hari'        => 'required',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
            'ruang'       => 'required',
        ]);

        $data = JadwalPelajaran::findOrFail($id);
        $data->update($request->all());

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
       ===============  HALAMAN LIST UNTUK GURU  ==================
       ============================================================ */

    public function guru()
    {
        return view('guru.jadwal.index', [
            'title'   => 'Guru - Jadwal Pelajaran',
            'sidebar' => 'layouts.sidebar-guru',
            'jadwal'  => JadwalPelajaran::with(['kelas','mapel','guru'])->get(),
        ]);
    }

    /* ============================================================
       ================  LIST UNTUK KEPSEK  =======================
       ============================================================ */

    public function kepsek()
    {
        return view('kepsek.jadwal.index', [
            'title'   => 'Kepala Sekolah - Jadwal Pelajaran',
            'sidebar' => 'layouts.sidebar-kepsek',
            'jadwal'  => JadwalPelajaran::with(['kelas','mapel','guru'])->get(),
        ]);
    }
}
