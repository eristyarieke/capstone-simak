<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class GuruController extends Controller
{
    /* =========================
       ====== INDEX ============
       ========================= */
    public function index(Request $request)
    {
        $search = $request->search;

        $guru = Guru::with('tahunAjaran')
            ->when($search, function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('jabatan', 'like', "%$search%");
            })
            ->orderBy('nama')
            ->get();

        return view('admin.guru.index', compact('guru', 'search'));
    }

    /* =========================
       ====== CREATE ===========
       ========================= */
    public function create()
    {
        return view('admin.guru.create', [
            'agama' => ['Islam','Kristen','Katolik','Buddha','Hindu','Konghucu'],
        ]);
    }

    /* =========================
       ====== STORE ============
       ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:100',
            'jabatan'       => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required',
        ]);

        $tahunAktif = TahunAjaran::aktif();

        Guru::create([
            'id_user'         => Auth::user()->id_user ?? 1,
            'nama'            => $request->nama,
            'jabatan'         => $request->jabatan,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'agama'           => $request->agama,
            'id_tahun_ajaran' => $tahunAktif->id_tahun_ajaran,
        ]);

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /* =========================
       ====== EDIT =============
       ========================= */
    public function edit($id)
    {
        return view('admin.guru.edit', [
            'guru'  => Guru::findOrFail($id),
            'agama' => ['Islam','Kristen','Katolik','Buddha','Hindu','Konghucu'],
        ]);
    }

    /* =========================
       ====== UPDATE ===========
       ========================= */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required|string|max:100',
            'jabatan'       => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required',
        ]);

        Guru::findOrFail($id)->update($request->only([
            'nama',
            'jabatan',
            'jenis_kelamin',
            'agama',
        ]));

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /* =========================
       ====== DESTROY ==========
       ========================= */
    public function destroy($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            $guru->delete();

            // Kalo BERHASIL, kirim session key 'success'
            return back()->with('success', 'Data guru berhasil dihapus.');

        } catch (\Illuminate\Database\QueryException $e) {
            
            // Kalo GAGAL (karena Foreign Key / Relasi), kirim session key 'error'
            // Error Code 23000 = Integrity constraint violation
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Gagal menghapus! Guru ini masih terdaftar sebagai Wali Kelas atau memiliki Jadwal.');
            }

            // Error database lainnya
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Error umum lainnya
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function laporan() {
    // Logika ambil data untuk laporan
    return view('kepsek.laporan.siswa'); 
}
}
