@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Tambah Foto Galeri
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">

    <form action="{{ route('admin.kelola-halaman.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul Foto --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Judul / Caption Foto</label>
            <input type="text" name="judul" class="input w-full" placeholder="Contoh: Upacara Bendera Hari Senin" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kategori</label>
            <select name="kategori" class="input w-full" required>
                <option value="" disabled selected>-- Pilih Kategori --</option>
                <option value="Kegiatan">kegiatan</option>
                <option value="Prestasi">prestasi</option>
                <option value="Lainnya">umum</option>
            </select>
        </div>

        {{-- Upload Foto --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">File Foto</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition">
                <input type="file" name="foto" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100" accept="image/*" required>
                <p class="text-xs text-gray-500 mt-2">Maksimal ukuran 2MB. Format: JPG, PNG.</p>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Simpan Foto
            </button>
            <a href="{{ route('admin.kelola-halaman.galeri') }}" class="btn-light">
                Batal
            </a>
        </div>
    </form>

</div>

@endsection