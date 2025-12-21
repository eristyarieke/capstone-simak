@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Tambah Banner Baru
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">

    <form action="{{ route('admin.kelola-halaman.banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Judul Banner</label>
            <input type="text" name="judul" class="input w-full" placeholder="Contoh: Selamat Datang" required>
        </div>

        {{-- Subjudul --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Subjudul (Opsional)</label>
            <input type="text" name="subjudul" class="input w-full" placeholder="Contoh: Di Website Sekolah Kami">
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Gambar Banner</label>
            <input type="file" name="gambar" class="input w-full p-2 border" accept="image/*" required>
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
        </div>

        {{-- Status --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" class="input w-full">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Simpan
            </button>
            <a href="{{ route('admin.kelola-halaman.banner') }}" class="btn-light">
                Batal
            </a>
        </div>
    </form>

</div>

@endsection