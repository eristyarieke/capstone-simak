<?php

namespace App\Http\Controllers\landingpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import semua model sesuai tabel di database
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Artikel;
use App\Models\Kontak;
use App\Models\Slider;
use App\Models\SambutanKepsek;
use App\Models\ProfilSekolah;
use App\Models\Visi;
use App\Models\Misi;
use App\Models\Feedback;
use App\Models\Pengumuman;

class KelolaHalamanController extends Controller
{
    // Dashboard Utama Kelola Halaman
    public function index()
    {
        return view('admin.halaman.index');
    }

    // Mengelola Banner / Sliders
    public function banner()
    {
        $banners = Slider::all();
        return view('admin.halaman.banner.index', compact('banners'));
    }

    /**
     * 1. Menampilkan Form Tambah (Create)
     */
    public function bannerCreate()
    {
        return view('admin.halaman.banner.create');
    }

    /**
     * 2. Proses Simpan Data Baru (Store)
     */
    public function bannerStore(Request $request)
    {
        // Validasi Input
        $request->validate([
            'judul'    => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'gambar'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'status'   => 'required|in:aktif,nonaktif', // Sesuaikan opsi status
        ]);

        // Proses Upload Gambar
        $pathGambar = null;
        if ($request->hasFile('gambar')) {
            // Simpan ke folder 'public/storage/sliders'
            $pathGambar = $request->file('gambar')->store('sliders', 'public');
        }

        // Simpan ke Database
        Slider::create([
            'judul'    => $request->judul,
            'subjudul' => $request->subjudul,
            'gambar'   => $pathGambar,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.kelola-halaman.banner')->with('success', 'Banner berhasil ditambahkan!');
    }

    /**
     * 3. Menampilkan Form Edit (Edit)
     */
    public function bannerEdit($id)
    {
        $banner = Slider::findOrFail($id);
        return view('admin.halaman.banner.edit', compact('banner'));
    }

    /**
     * 4. Proses Update Data (Update)
     */
    public function bannerUpdate(Request $request, $id)
    {
        $banner = Slider::findOrFail($id);

        // Validasi (Gambar tidak wajib/nullable karena user mungkin tidak ganti gambar)
        $request->validate([
            'judul'    => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'   => 'required|in:aktif,nonaktif',
        ]);

        // Data yang akan diupdate
        $data = [
            'judul'    => $request->judul,
            'subjudul' => $request->subjudul,
            'status'   => $request->status,
        ];

        // Cek jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada
            if ($banner->gambar && Storage::disk('public')->exists($banner->gambar)) {
                Storage::disk('public')->delete($banner->gambar);
            }

            // 2. Upload gambar baru
            $pathGambar = $request->file('gambar')->store('sliders', 'public');
            $data['gambar'] = $pathGambar;
        }

        // Update Database
        $banner->update($data);

        return redirect()->route('admin.kelola-halaman.banner')->with('success', 'Banner berhasil diperbarui!');
    }

    /**
     * (Opsional) Hapus Banner
     */
    public function bannerDestroy($id)
    {
        $banner = Slider::findOrFail($id);

        // Hapus file gambar dari storage
        if ($banner->gambar && Storage::disk('public')->exists($banner->gambar)) {
            Storage::disk('public')->delete($banner->gambar);
        }

        $banner->delete();

        return redirect()->route('admin.kelola-halaman.banner')->with('success', 'Banner berhasil dihapus!');
    }

    // Mengelola Sambutan Kepala Sekolah
    public function sambutan()
{
    // Ambil data pertama. Jika kosong, tidak error (null)
    $sambutan = SambutanKepsek::first();
    return view('admin.halaman.sambutan.index', compact('sambutan'));
}

/**
 * Proses Update Sambutan
 */
public function sambutanUpdate(Request $request)
{
    $request->validate([
        'nama_kepsek'  => 'required|string|max:200',
        'isi_sambutan' => 'required|string',
        'foto'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Cek apakah data sudah ada atau belum
    $sambutan = SambutanKepsek::first();

    if (!$sambutan) {
        // Jika belum ada, buat instansiasi baru
        $sambutan = new SambutanKepsek();
    }

    // 1. Handle Upload Foto
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada & filenya eksis di storage
        if ($sambutan->foto && Storage::disk('public')->exists($sambutan->foto)) {
            Storage::disk('public')->delete($sambutan->foto);
        }

        // Simpan foto baru
        $path = $request->file('foto')->store('kepsek', 'public');
        $sambutan->foto = $path;
    }

    // 2. Update Data Teks
    $sambutan->nama_kepsek  = $request->nama_kepsek;
    $sambutan->isi_sambutan = $request->isi_sambutan;
    
    // 3. Simpan
    $sambutan->save();

    return redirect()->route('admin.kelola-halaman.sambutan')->with('success', 'Data sambutan berhasil diperbarui!');
}

    // Mengelola Profil Sekolah (Tentang Sekolah)
    public function profil()
    {
        $profil = ProfilSekolah::first();
        return view('admin.halaman.profil.edit', compact('profil'));
    }

    /**
     * 2. Proses Update Profil Sekolah
     */
    public function profilUpdate(Request $request)
    {
        // Validasi
        $request->validate([
            'deskripsi'   => 'required|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'foto_gedung' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB (Gedung biasanya lebih besar)
        ]);

        // Ambil data (atau buat baru jika kosong)
        $profil = ProfilSekolah::first();
        if (!$profil) {
            $profil = new ProfilSekolah();
        }

        // --- HANDLE LOGO ---
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            // Simpan logo baru
            $profil->logo = $request->file('logo')->store('profil/logo', 'public');
        }

        // --- HANDLE FOTO GEDUNG ---
        if ($request->hasFile('foto_gedung')) {
            // Hapus foto lama
            if ($profil->foto_gedung && Storage::disk('public')->exists($profil->foto_gedung)) {
                Storage::disk('public')->delete($profil->foto_gedung);
            }
            // Simpan foto baru
            $profil->foto_gedung = $request->file('foto_gedung')->store('profil/gedung', 'public');
        }

        // --- UPDATE DESKRIPSI ---
        $profil->deskripsi = $request->deskripsi;
        
        $profil->save();

        return redirect()->route('admin.kelola-halaman.profil')->with('success', 'Profil sekolah berhasil diperbarui!');
    }

    // Mengelola Visi & Misi
    public function visiMisi()
    {
        $visi = Visi::all(); // Mengambil semua data visi
        $misi = Misi::all(); // Mengambil semua data misi
        
        return view('admin.halaman.visimisi.index', compact('visi', 'misi'));
    }

    /**
     * Proses Tambah Visi
     */
    public function visiStore(Request $request)
    {
        $request->validate(['isi_visi' => 'required|string']);
        Visi::create(['isi_visi' => $request->isi_visi]);
        return back()->with('success', 'Visi berhasil ditambahkan!');
    }

    /**
     * Proses Hapus Visi
     */
    public function visiDestroy($id)
    {
        Visi::findOrFail($id)->delete();
        return back()->with('success', 'Visi berhasil dihapus!');
    }

    /**
     * Proses Tambah Misi
     */
    public function misiStore(Request $request)
    {
        $request->validate(['isi_misi' => 'required|string']);
        Misi::create(['isi_misi' => $request->isi_misi]);
        return back()->with('success', 'Misi berhasil ditambahkan!');
    }

    /**
     * Proses Hapus Misi
     */
    public function misiDestroy($id)
    {
        Misi::findOrFail($id)->delete();
        return back()->with('success', 'Misi berhasil dihapus!');
    }

    // Mengelola Galeri (Foto Kegiatan/Prestasi/Umum)
   public function galeri()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')->get();
        return view('admin.halaman.galeri.index', compact('galeri'));
    }

    /**
     * 2. Form Tambah Galeri (Create)
     */
    public function galeriCreate()
    {
        return view('admin.halaman.galeri.create');
    }

    /**
     * 3. Proses Simpan Galeri (Store)
     */
    public function galeriStore(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100', 
            'foto'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Upload Foto
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galeri', 'public');
        }

        // Simpan ke Database
        Galeri::create([
            'judul'    => $request->judul,
            'kategori' => $request->kategori,
            'foto'     => $path,
        ]);

        return redirect()->route('admin.kelola-halaman.galeri')->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    /**
     * 4. Hapus Galeri (Destroy)
     */
    public function galeriDestroy($id)
    {
        $item = Galeri::findOrFail($id);

        // Hapus file fisik di storage
        if ($item->foto && Storage::disk('public')->exists($item->foto)) {
            Storage::disk('public')->delete($item->foto);
        }

        // Hapus data di database
        $item->delete();

        return redirect()->route('admin.kelola-halaman.galeri')->with('success', 'Foto berhasil dihapus!');
    }

    // Mengelola Kegiatan
    public function kegiatan()
    {
        $kegiatan = Kegiatan::orderBy('tanggal_kegiatan', 'desc')->get();
        return view('admin.halaman.kegiatan.index', compact('kegiatan'));
    }

    /**
     * 2. Form Tambah Kegiatan (Create)
     */
    public function kegiatanCreate()
    {
        return view('admin.halaman.kegiatan.create');
    }

    /**
     * 3. Proses Simpan Kegiatan (Store)
     */
    public function kegiatanStore(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'tahun'            => 'required|numeric', // Tahun ajaran atau tahun kalender
            'deskripsi'        => 'required|string',
            'foto'             => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload Foto
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'judul'            => $request->judul,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'tahun'            => $request->tahun,
            'deskripsi'        => $request->deskripsi,
            'foto'             => $path,
        ]);

        return redirect()->route('admin.kelola-halaman.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * 4. Form Edit Kegiatan (Edit)
     */
    public function kegiatanEdit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.halaman.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * 5. Proses Update Kegiatan (Update)
     */
    public function kegiatanUpdate(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul'            => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'tahun'            => 'required|numeric',
            'deskripsi'        => 'required|string',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'judul'            => $request->judul,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'tahun'            => $request->tahun,
            'deskripsi'        => $request->deskripsi,
        ];

        // Cek jika ada foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            // Upload baru
            $data['foto'] = $request->file('foto')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kelola-halaman.kegiatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    /**
     * 6. Hapus Kegiatan (Destroy)
     */
    public function kegiatanDestroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kelola-halaman.kegiatan')->with('success', 'Kegiatan berhasil dihapus!');
    }

    // Mengelola Prestasi
    public function prestasi()
    {
        // Urutkan berdasarkan tahun terbaru, lalu judul
        $prestasi = Prestasi::orderBy('tahun', 'desc')->orderBy('created_at', 'desc')->get();
        return view('admin.halaman.prestasi.index', compact('prestasi'));
    }

    /**
     * 2. Form Tambah Prestasi (Create)
     */
    public function prestasiCreate()
    {
        return view('admin.halaman.prestasi.create');
    }

    /**
     * 3. Proses Simpan Prestasi (Store)
     */
    public function prestasiStore(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'tingkat'    => 'required|string', // Contoh: Kabupaten, Provinsi, Nasional
            'tahun'      => 'required|numeric|digits:4',
            'deskripsi'  => 'required|string',
            'foto'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload Foto
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create([
            'judul'      => $request->judul,
            'nama_siswa' => $request->nama_siswa,
            'tingkat'    => $request->tingkat,
            'tahun'      => $request->tahun,
            'deskripsi'  => $request->deskripsi,
            'foto'       => $path,
        ]);

        return redirect()->route('admin.kelola-halaman.prestasi')->with('success', 'Data prestasi berhasil ditambahkan!');
    }

    /**
     * 4. Form Edit Prestasi (Edit)
     */
    public function prestasiEdit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.halaman.prestasi.edit', compact('prestasi'));
    }

    /**
     * 5. Proses Update Prestasi (Update)
     */
    public function prestasiUpdate(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'judul'      => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'tingkat'    => 'required|string',
            'tahun'      => 'required|numeric|digits:4',
            'deskripsi'  => 'required|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'judul'      => $request->judul,
            'nama_siswa' => $request->nama_siswa,
            'tingkat'   => $request->tingkat,
            'tahun'      => $request->tahun,
            'deskripsi'  => $request->deskripsi,
        ];

        // Cek jika ada upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->update($data);

        return redirect()->route('admin.kelola-halaman.prestasi')->with('success', 'Data prestasi berhasil diperbarui!');
    }

    /**
     * 6. Hapus Prestasi (Destroy)
     */
    public function prestasiDestroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()->route('admin.kelola-halaman.prestasi')->with('success', 'Data prestasi berhasil dihapus!');
    }

    // Mengelola Artikel / Berita
    public function artikel()
    {
        $artikel = Artikel::orderBy('tanggal_publish', 'desc')->get();
        return view('admin.halaman.artikel.index', compact('artikel'));
    }

    /**
     * 2. Form Tambah Artikel (Create)
     */
    public function artikelCreate()
    {
        return view('admin.halaman.artikel.create');
    }

    /**
     * 3. Proses Simpan Artikel (Store)
     */
    public function artikelStore(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'penulis'         => 'required|string|max:100',
            'status'          => 'required|in:publish,draft',
            'tanggal_publish' => 'required|date',
            'thumbnail'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Wajib ada gambar
            'isi'             => 'required|string',
        ]);

        // Upload Thumbnail
        $path = null;
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('artikel', 'public');
        }

        Artikel::create([
            'judul'           => $request->judul,
            'thumbnail'       => $path,
            'isi'             => $request->isi,
            'penulis'         => $request->penulis,
            'status'          => $request->status,
            'tanggal_publish' => $request->tanggal_publish,
        ]);

        return redirect()->route('admin.kelola-halaman.artikel')->with('success', 'Artikel berhasil diterbitkan!');
    }

    /**
     * 4. Form Edit Artikel (Edit)
     */
    public function artikelEdit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.halaman.artikel.edit', compact('artikel'));
    }

    /**
     * 5. Proses Update Artikel (Update)
     */
    public function artikelUpdate(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul'           => 'required|string|max:255',
            'penulis'         => 'required|string|max:100',
            'status'          => 'required|in:publish,draft',
            'tanggal_publish' => 'required|date',
            'thumbnail'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Boleh kosong saat edit
            'isi'             => 'required|string',
        ]);

        $data = [
            'judul'           => $request->judul,
            'penulis'         => $request->penulis,
            'status'          => $request->status,
            'tanggal_publish' => $request->tanggal_publish,
            'isi'             => $request->isi,
        ];

        // Cek jika ada update thumbnail
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) {
                Storage::disk('public')->delete($artikel->thumbnail);
            }
            // Upload baru
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('admin.kelola-halaman.artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * 6. Hapus Artikel (Destroy)
     */
    public function artikelDestroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Hapus file fisik
        if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) {
            Storage::disk('public')->delete($artikel->thumbnail);
        }

        $artikel->delete();

        return redirect()->route('admin.kelola-halaman.artikel')->with('success', 'Artikel berhasil dihapus!');
    }

    // Mengelola Pengumuman
    public function pengumuman()
    {
        // Urutkan dari tanggal terbaru
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->get();
        return view('admin.halaman.pengumuman.index', compact('pengumuman'));
    }

    /**
     * 2. Form Tambah Pengumuman (Create)
     */
    public function pengumumanCreate()
    {
        return view('admin.halaman.pengumuman.create');
    }

    /**
     * 3. Proses Simpan Pengumuman (Store)
     */
    public function pengumumanStore(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
            'status'  => 'required|in:tampil,arsip', // Validasi pilihan status
        ]);

        Pengumuman::create([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'status'  => $request->status,
        ]);

        return redirect()->route('admin.kelola-halaman.pengumuman')->with('success', 'Pengumuman berhasil dibuat!');
    }

    /**
     * 4. Form Edit Pengumuman (Edit)
     */
    public function pengumumanEdit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.halaman.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * 5. Proses Update Pengumuman (Update)
     */
    public function pengumumanUpdate(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
            'status'  => 'required|in:tampil,arsip',
        ]);

        $pengumuman->update([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'status'  => $request->status,
        ]);

        return redirect()->route('admin.kelola-halaman.pengumuman')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * 6. Hapus Pengumuman (Destroy)
     */
    public function pengumumanDestroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('admin.kelola-halaman.pengumuman')->with('success', 'Pengumuman berhasil dihapus!');
    }

    // Mengelola Kontak & Alamat
    public function kontak()
    {
        // Ambil data kontak pertama (karena tunggal)
        $kontak = Kontak::first();
        return view('admin.halaman.kontak.edit', compact('kontak'));
    }

    /**
     * 2. Proses Update Kontak
     */
    public function kontakUpdate(Request $request)
    {
        $request->validate([
            'alamat'    => 'required|string',
            'telepon'   => 'required|string',
            'email'     => 'required|email',
            'instagram' => 'nullable|string', // Boleh kosong
            'youtube'   => 'nullable|string',
            'website'   => 'nullable|string',
        ]);

        // Cek apakah data sudah ada
        $kontak = Kontak::first();
        if (!$kontak) {
            $kontak = new Kontak();
        }

        // Update data
        $kontak->alamat    = $request->alamat;
        $kontak->telepon   = $request->telepon;
        $kontak->email     = $request->email;
        $kontak->instagram = $request->instagram;
        $kontak->youtube   = $request->youtube;
        $kontak->website   = $request->website;

        $kontak->save();

        return redirect()->route('admin.kelola-halaman.kontak')->with('success', 'Informasi kontak berhasil diperbarui!');
    }

    // Melihat Feedback dari pengunjung
    public function feedback()
    {
        // Urutkan dari yang paling baru
        $feedback = Feedback::orderBy('created_at', 'desc')->get();
        return view('admin.halaman.feedback.index', compact('feedback'));
    }

    /**
     * 2. Hapus Feedback (Destroy)
     * Hanya admin yang bisa menghapus jika ada komentar spam/tidak pantas
     */
    public function feedbackDestroy($id)
    {
        $item = Feedback::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.feedback')->with('success', 'Pesan feedback berhasil dihapus.');
    }
}