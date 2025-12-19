<?php

namespace App\Http\Controllers\landingpage;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $title = 'Kelola Data Prestasi';
        $sidebar = 'layouts.sidebar-admin';

        $prestasi = Prestasi::with('siswa')
            ->orderBy('tahun', 'desc')
            ->get();

        $siswa = Siswa::orderBy('nama', 'asc')->get();

        return view('admin.prestasi.index', compact(
            'title',
            'sidebar',
            'prestasi',
            'siswa'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa'       => 'required',
            'nama_prestasi'  => 'required',
            'tingkat'        => 'required',
            'tahun'          => 'required|numeric',
        ]);

        Prestasi::create($request->all());

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit Data Prestasi';
        $sidebar = 'layouts.sidebar.admin';

        $prestasi = Prestasi::findOrFail($id);
        $siswa = Siswa::orderBy('nama', 'asc')->get();

        return view('admin.prestasi.edit', compact(
            'title',
            'sidebar',
            'prestasi',
            'siswa'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa'       => 'required',
            'nama_prestasi'  => 'required',
            'tingkat'        => 'required',
            'tahun'          => 'required|numeric',
        ]);

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->update($request->all());

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        Prestasi::destroy($id);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus');
    }
}
