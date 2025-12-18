<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    protected $sidebar;

    public function __construct()
    {
        $this->sidebar = 'layouts.sidebar-admin'; // sesuaikan dengan punya kamu
    }

    // List data guru
        public function index(Request $request)
        {
            $sidebar = $this->sidebar;

            $q = trim($request->query('q')); // pastikan ambil dari ?q=

            $guru = Guru::query()
                ->when($q !== '', function ($query) use ($q) {
                    $qLike = "%{$q}%";

                    $query->where(function ($sub) use ($qLike) {
                        $sub->where('nama', 'like', $qLike)
                            ->orWhere('jabatan', 'like', $qLike)
                            ->orWhere('status_kepegawaian', 'like', $qLike);
                    });
                })
                ->orderBy('naphpma', 'asc')
                ->get();

            return view('guru.index', compact('guru', 'sidebar', 'q'));
        }

    // Form tambah guru
    public function create()
    {
        // user yang bisa dijadikan akun guru (opsional)
        $users   = User::where('role', 'guru')->get();
        $sidebar = $this->sidebar;

        // pilihan untuk select
        $jabatan = [
            'Kepala Sekolah','Guru Kelas I-A','Guru Kelas I-B','Guru Kelas II-A','Guru Kelas II-B',
            'Guru Kelas III-A','Guru Kelas III-B','Guru Kelas IV-A','Guru Kelas IV-B','Guru Kelas V-A',
            'Guru Kelas V-B','Guru Kelas VI-A','Guru Kelas VI-B','Guru PJOK','Guru PAI','Guru B.Inggris',
            'Guru PAK','Pustakawati','Penjaga Sekolah','Administrasi','Kebersihan','Keamanan',
        ];

        $statusKepegawaian = [
            'Induk',
            'Non Induk',
        ];

        return view('guru.create', compact(
            'users',
            'jabatan',
            'statusKepegawaian',
            'sidebar'
        ));
    }

    // Simpan data guru baru
    public function store(Request $request)
    {
        $request->validate([                   
            'nama'               => 'required|string|max:100',
            'jabatan'            => 'required|string|max:100',
            'status_kepegawaian' => 'required|string|max:50',
            
        ]);

        // kalau id_user tidak dipilih, pakai user yang login (admin) atau null
        $idUser = $request->id_user ?? (Auth::check() ? Auth::user()->id_user : null);

        Guru::create([
            'id_user'            => $idUser,        
            'nama'               => $request->nama,
            'jabatan'            => $request->jabatan,
            'status_kepegawaian' => $request->status_kepegawaian,
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan!');
    }

    // Form edit guru
    public function edit($id)
    {
        $guru    = Guru::findOrFail($id);
        $users   = User::where('role', 'guru')->get();
        $sidebar = $this->sidebar;

        $jabatan = [
            'Kepala Sekolah','Guru Kelas I-A','Guru Kelas I-B','Guru Kelas II-A','Guru Kelas II-B',
            'Guru Kelas III-A','Guru Kelas III-B','Guru Kelas IV-A','Guru Kelas IV-B','Guru Kelas V-A',
            'Guru Kelas V-B','Guru Kelas VI-A','Guru Kelas VI-B','Guru PJOK','Guru PAI','Guru B.Inggris',
            'Guru PAK','Pustakawati','Penjaga Sekolah','Administrasi','Kebersihan','Keamanan',
        ];

        $statusKepegawaian = [
            'Induk',
            'Non Induk',
        ];

        return view('guru.edit', compact(
            'guru',
            'users',
            'jabatan',
            'statusKepegawaian',
            'sidebar'
        ));
    }

    // Update data guru
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([        
            'nama'               => 'required|string|max:100',
            'jabatan'            => 'required|string|max:100',
            'status_kepegawaian' => 'required|string|max:50',
        ]);

        $guru->update([
            
            'nama'               => $request->nama,
            'jabatan'            => $request->jabatan,
            'status_kepegawaian' => $request->status_kepegawaian,
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui!');
    }

    // Hapus guru
    public function destroy($id)
    {
        Guru::findOrFail($id)->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus!');
    }
}
