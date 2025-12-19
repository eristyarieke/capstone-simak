<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Kegiatan';
        $data['sidebar'] = 'partials.sidebar-admin';
        $data['kegiatan'] = Kegiatan::orderBy('tanggal', 'desc')->get();

        return view('admin.kegiatan.index', $data);
    }

    public function create()
    {
        return view('admin.kegiatan.create', [
            'title' => 'Tambah Kegiatan',
            'sidebar' => 'partials.sidebar-admin'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image'
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->foto->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'foto' => $foto
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.kegiatan.edit', [
            'title' => 'Edit Kegiatan',
            'sidebar' => 'partials.sidebar-admin',
            'kegiatan' => Kegiatan::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $foto = $kegiatan->foto;
        if ($request->hasFile('foto')) {
            $foto = $request->foto->store('kegiatan', 'public');
        }

        $kegiatan->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'foto' => $foto
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate');
    }

    public function destroy($id)
    {
        Kegiatan::destroy($id);

        return back()->with('success', 'Kegiatan berhasil dihapus');
    }
}
