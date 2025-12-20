<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PembagianKelasController extends Controller
{
    /* ===================== INDEX ===================== */
    public function index(Request $request)
{
    $tahunAktif = TahunAjaran::aktif();

    $siswa = Siswa::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
        ->when($request->kelas_asal === 'null', function ($q) {
            $q->whereNull('id_kelas');
        })
        ->when($request->kelas_asal && $request->kelas_asal !== 'null', function ($q) use ($request) {
            $q->where('id_kelas', $request->kelas_asal);
        })
        ->when($request->search, function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        })
        ->orderBy('nama')
        ->get();

    return view('admin.pembagian-kelas.index', [
        'siswa'      => $siswa,
        'kelas'      => Kelas::where('id_tahun_ajaran', $tahunAktif->id_tahun_ajaran)
                            ->orderBy('nama_kelas')
                            ->get(),
        'kelasAsal'  => $request->kelas_asal,
        'search'     => $request->search,
    ]);
}


    /* ===================== STORE ===================== */
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas'   => 'required|exists:kelas,id_kelas',
            'id_siswa'   => 'required|array',
            'id_siswa.*' => 'exists:siswa,id_siswa',
        ]);

        Siswa::whereIn('id_siswa', $request->id_siswa)
            ->update([
                'id_kelas' => $request->id_kelas
            ]);

        return redirect()
            ->route('admin.pembagian-kelas.index')
            ->with('success', 'Siswa berhasil ditempatkan ke kelas.');
    }
}
