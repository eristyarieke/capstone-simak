@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Tambah Kegiatan Baru
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <form action="{{ route('admin.kelola-halaman.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Judul --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Judul Kegiatan</label>
                <input type="text" name="judul" class="input w-full" placeholder="Contoh: Peringatan Hari Kartini" required>
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal_kegiatan" class="input w-full" required>
            </div>

            {{-- Tahun --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tahun</label>
                <input type="number" name="tahun" class="input w-full" placeholder="Contoh: 2024" value="{{ date('Y') }}" required>
            </div>

            {{-- Foto --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Foto Dokumentasi</label>
                <input type="file" name="foto" class="input w-full p-2 border" accept="image/*" required>
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
            </div>

            {{-- Deskripsi --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Kegiatan</label>
                <textarea name="deskripsi" rows="5" class="input w-full p-3 border rounded" placeholder="Jelaskan detail kegiatan..." required></textarea>
            </div>

        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.kelola-halaman.kegiatan') }}" class="btn-light">Batal</a>
        </div>
    </form>

</div>

@endsection