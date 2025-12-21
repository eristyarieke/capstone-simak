<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /* ===================== INDEX ===================== */
    public function index(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $mapel = Mapel::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
            ->when($request->search, function ($q, $search) {
                $q->where('kode_mapel', 'like', "%$search%")
                  ->orWhere('nama_mapel', 'like', "%$search%");
            })
            ->orderBy('nama_mapel')
            ->get();

        return view('admin.mapel.index', [
            'title' => 'Data Mata Pelajaran',
            'mapel' => $mapel,
        ]);
    }

    /* ===================== CREATE ===================== */
    public function create()
    {
        return view('admin.mapel.create', [
            'title' => 'Tambah Mata Pelajaran',
        ]);
    }

    /* ===================== STORE ===================== */
    public function store(Request $request)
    {
        $tahunAktif = TahunAjaran::aktif();

        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:20',
            'nama_mapel' => 'required|string|max:100',
        ]);

        $validated['id_tahun_ajaran'] = $tahunAktif->id_tahun_ajaran;

        Mapel::create($validated);

        return redirect()
            ->route('admin.mapel')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    /* ===================== EDIT ===================== */
    public function edit($id)
    {
        $tahunAktif = TahunAjaran::aktif();

        return view('admin.mapel.edit', [
            'title' => 'Edit Mata Pelajaran',
            'mapel' => Mapel::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                        ->findOrFail($id),
        ]);
    }

    /* ===================== UPDATE ===================== */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:20',
            'nama_mapel' => 'required|string|max:100',
        ]);

        Mapel::findOrFail($id)->update($validated);

        return redirect()
            ->route('admin.mapel')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    /* ===================== DESTROY ===================== */
    public function destroy($id)
    {
        Mapel::findOrFail($id)->delete();

        return redirect()
            ->route('admin.mapel')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
