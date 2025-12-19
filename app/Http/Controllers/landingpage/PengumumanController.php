<?php

namespace App\Http\Controllers\landingpage;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $title = 'Kelola Pengumuman';
        $sidebar = 'layouts.sidebar-admin';

        $pengumuman = Pengumuman::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.pengumuman.index', compact(
            'title',
            'sidebar',
            'pengumuman'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required',
            'isi'     => 'required',
            'tanggal' => 'required|date',
        ]);

        Pengumuman::create([
            'judul'       => $request->judul,
            'isi'         => $request->isi,
            'tanggal'     => $request->tanggal,
            'dibuat_oleh' => Auth::id(), // user login
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit Pengumuman';
        $sidebar = 'layouts.sidebar.admin';

        $pengumuman = Pengumuman::findOrFail($id);

        return view('admin.pengumuman.edit', compact(
            'title',
            'sidebar',
            'pengumuman'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'   => 'required',
            'isi'     => 'required',
            'tanggal' => 'required|date',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update($request->only('judul', 'isi', 'tanggal'));

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pengumuman::destroy($id);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}
