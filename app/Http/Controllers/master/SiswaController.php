<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    protected $sidebar;

    public function __construct()
    {
        $this->sidebar = 'layouts.sidebar-admin';
    }

    // List data siswa
    public function index(Request $request)
    {
        $sidebar = 'layouts.sidebar-admin';
        $q = $request->q;

        $siswa = Siswa::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama', 'like', "%$q%")
                      ->orWhereHas('kelas', function ($k) use ($q) {
                        $k->where('nama_kelas', 'like', "%$q%");
                  });
            })
            ->orderBy('nama')
            ->get();

        return view('admin.siswa.index', compact('siswa', 'sidebar', 'q'));
    }


    // Form tambah siswa
    public function create()
    {
        $kelas   = Kelas::orderBy('nama_kelas')->get();
        $agama   = ['Islam','Kristen','Katolik','Buddha','Hindu','Konghucu'];
        $sidebar = $this->sidebar;

        return view('admin.siswa.create', compact('kelas','agama','sidebar'));
    }

    // Proses tambah siswa
    public function store(Request $request)
    {
        $request->validate([
            // id_user TIDAK lagi divalidasi dari input
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghucu',
            'id_kelas'      => 'required|exists:kelas,id_kelas',
            'tahun_masuk'   => 'required|digits:4',
        ]);

        // Ambil id_user dari user login, kalau belum kebaca pakai default 1 (admin)
        $idUser = Auth::check() ? Auth::user()->id_user : 1;

        Siswa::create([
            'id_user'       => $idUser,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'id_kelas'      => $request->id_kelas,
            'tahun_masuk'   => $request->tahun_masuk,
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $siswa   = Siswa::findOrFail($id);
        $kelas   = Kelas::orderBy('nama_kelas')->get();
        $agama   = ['Islam','Kristen','Katolik','Buddha','Hindu','Konghucu'];
        $sidebar = $this->sidebar;

        return view('admin.siswa.edit', compact('siswa','kelas','agama','sidebar'));
    }

    // Proses update
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            // id_user juga tidak perlu dari form
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required|in:Islam,Kristen,Katolik,Buddha,Hindu,Konghucu',
            'id_kelas'      => 'required|exists:kelas,id_kelas',
            'tahun_masuk'   => 'required|digits:4',
        ]);

        $siswa->update([
            // kalau mau, id_user bisa dibiarkan seperti sebelumnya:
            // 'id_user'       => $siswa->id_user,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'id_kelas'      => $request->id_kelas,
            'tahun_masuk'   => $request->tahun_masuk,
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}
