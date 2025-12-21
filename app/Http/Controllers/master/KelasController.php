<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /* ===================== INDEX ===================== */
    public function index(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $kelas = Kelas::with('waliKelas')
            ->where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
            ->when($request->search, function ($q, $search) {
                $q->where('nama_kelas', 'like', "%$search%")
                  ->orWhereHas('waliKelas', fn ($g) =>
                        $g->where('nama', 'like', "%$search%"));
            })
            ->orderBy('nama_kelas')
            ->get();

        return view('admin.kelas.index', [
            'title' => 'Data Kelas',
            'kelas' => $kelas,
        ]);
    }

    /* ===================== CREATE ===================== */
    public function create()
    {
        $tahunAktif = TahunAjaran::aktif();

        return view('admin.kelas.create', [
            'title' => 'Tambah Kelas',
            'guru'  => Guru::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                        ->orderBy('nama')->get(),
        ]);
    }

    /* ===================== STORE ===================== */
    public function store(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'nullable|exists:guru,id_guru',
        ]);

        $validated['id_tahun_ajaran'] = $tahunAktif->id_tahun_ajaran;

        Kelas::create($validated);

        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /* ===================== EDIT ===================== */
    public function edit($id)
    {
        $tahunAktif = TahunAjaran::aktif();

        return view('admin.kelas.edit', [
            'title' => 'Edit Kelas',
            'kelas' => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                        ->findOrFail($id),
            'guru'  => Guru::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                        ->orderBy('nama')->get(),
        ]);
    }

    /* ===================== UPDATE ===================== */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'nullable|exists:guru,id_guru',
        ]);

        Kelas::findOrFail($id)->update($validated);

        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /* ===================== DESTROY ===================== */
    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
