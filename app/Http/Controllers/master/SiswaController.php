<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /* ============================================================
       =======================  INDEX  ============================
       ============================================================ */
    public function index(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $siswa = Siswa::with('kelas')
            ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)

            ->when($request->search, function ($q, $search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhereHas('kelas', fn ($k) =>
                        $k->where('nama_kelas', 'like', "%$search%"));
            })

            ->when($request->id_kelas, fn ($q, $id) =>
                $q->where('id_kelas', $id))

            ->orderBy('nama')
            ->get();

        return view('admin.siswa.index', [
            'title' => 'Data Siswa',
            'siswa' => $siswa,
            'kelas' => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                            ->orderBy('nama_kelas')->get(),
        ]);
    }

    /* =========================
       ====== CREATE ===========
       ========================= */
    public function create()
    {
        $tahunAktif = TahunAjaran::aktif();
        
        return view('admin.siswa.create', [
            'agama' => ['Islam','Kristen','Katolik','Buddha','Hindu','Konghucu'],
            'kelas' => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)->get()
        ]);
    }

    /* ============================================================
       ========================  STORE  ===========================
       ============================================================ */
    public function store(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|string',
            'agama'         => 'required|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghucu',
            'id_kelas'      => 'required|exists:kelas,id_kelas',
        ]);

        $validated['id_tahun_ajaran'] = $tahunAktif->id_tahun_ajaran;

        Siswa::create($validated);

        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        $tahunAktif = TahunAjaran::aktif();

        return view('admin.siswa.edit', [
            'title' => 'Edit Data Siswa',
            'siswa' => $siswa,
            'agama' => ['Islam','Kristen','Katolik','Buddha','Hindu','Konghucu'],
            'kelas' => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                            ->orderBy('nama_kelas')
                            ->get()
        ]);
    }

    /* ============================================================
       ========================  UPDATE  ==========================
       ============================================================ */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|string',
            'agama'         => 'required|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghucu',
            'id_kelas'      => 'required|exists:kelas,id_kelas',
        ]);

        Siswa::findOrFail($id)->update($validated);

        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /* ============================================================
       ========================  DELETE  ==========================
       ============================================================ */
    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();

        return back()->with('success', 'Data siswa berhasil dihapus!');
    }

    public function laporan() {
    // Logika ambil data untuk laporan
    return view('kepsek.laporan.siswa'); 
}
}
