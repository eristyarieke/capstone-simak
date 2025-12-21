@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Tambah Prestasi Baru
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <form action="{{ route('admin.kelola-halaman.prestasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Judul Prestasi --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Nama Kejuaraan / Judul</label>
                <input type="text" name="judul" class="input w-full" placeholder="Contoh: Juara 1 Olimpiade Matematika" required>
            </div>

            {{-- Nama Siswa --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Nama Siswa / Tim</label>
                <input type="text" name="nama_siswa" class="input w-full" placeholder="Contoh: Ahmad Dhani" required>
            </div>

            {{-- Tingkat --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tingkat</label>
                <select name="tingkat" class="input w-full" required>
                    <option value="" disabled selected>-- Pilih Tingkat --</option>
                    <option value="Kecamatan">Kecamatan</option>
                    <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                    <option value="Provinsi">Provinsi</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>

            {{-- Tahun --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tahun Perolehan</label>
                <input type="number" name="tahun" class="input w-full" value="{{ date('Y') }}" required>
            </div>

            {{-- Foto --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Foto Dokumentasi</label>
                <input type="file" name="foto" class="input w-full p-2 border" accept="image/*" required>
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
            </div>

            {{-- Deskripsi --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="4" class="input w-full p-3 border rounded" placeholder="Jelaskan detail prestasi..." required></textarea>
            </div>

        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.kelola-halaman.prestasi') }}" class="btn-light">Batal</a>
        </div>
    </form>

</div>

@endsection