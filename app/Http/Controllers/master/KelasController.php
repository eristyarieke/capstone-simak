<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    protected $sidebar;

    public function __construct()
    {
        $this->sidebar = 'layouts.sidebar-admin';
    }

    // List data kelas
    public function index()
    {
        $kelas   = Kelas::with('wali')->orderBy('nama_kelas')->get();
        $sidebar = $this->sidebar;

        return view('admin.kelas.index', compact('kelas', 'sidebar'));
    }

    // Form tambah kelas
    public function create()
    {
        $guru    = Guru::orderBy('nama')->get();
        $sidebar = $this->sidebar;

        return view('admin.kelas.create', compact('guru', 'sidebar'));
    }

    // Simpan kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'nullable|exists:guru,id_guru',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan!');
    }

    // Form edit kelas
    public function edit($id)
    {
        $kelas   = Kelas::findOrFail($id);
        $guru    = Guru::orderBy('nama')->get();
        $sidebar = $this->sidebar;

        return view('admin.kelas.edit', compact('kelas', 'guru', 'sidebar'));
    }

    // Update kelas
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'nullable|exists:guru,id_guru',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui!');
    }

    // Hapus kelas
    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus!');
    }
}
