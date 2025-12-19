<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Guru;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    protected $sidebar;

    public function __construct()
    {
        $this->sidebar = 'layouts.sidebar-admin';
    }

    public function index()
    {
        $mapel = Mapel::with('guru')->get();
        $sidebar = $this->sidebar;

        return view('mapel.index', compact('mapel', 'sidebar'));
    }

    public function create()
    {
        $guru = Guru::all();
        $sidebar = $this->sidebar;

        return view('mapel.create', compact('guru', 'sidebar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|string|max:20',
            'nama_mapel' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:9',
            'id_guru'    => 'nullable|exists:guru,id_guru',
        ]);

        Mapel::create($request->all());

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Data mapel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        $guru = Guru::all();
        $sidebar = $this->sidebar;

        return view('mapel.edit', compact('mapel', 'guru', 'sidebar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mapel' => 'required|string|max:20',
            'nama_mapel' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:9',
            'id_guru'    => 'nullable|exists:guru,id_guru',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update($request->all());

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Data mapel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Mapel::findOrFail($id)->delete();

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Data mapel berhasil dihapus!');
    }
}
