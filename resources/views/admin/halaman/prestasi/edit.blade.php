@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Edit Data Prestasi
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <form action="{{ route('admin.kelola-halaman.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Judul Prestasi --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Nama Kejuaraan / Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $prestasi->judul) }}" class="input w-full" required>
            </div>

            {{-- Nama Siswa --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Nama Siswa / Tim</label>
                <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $prestasi->nama_siswa) }}" class="input w-full" required>
            </div>

            {{-- Tingkat --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tingkat</label>
                <select name="tingkat" class="input w-full" required>
                    <option value="Kecamatan" {{ $prestasi->tingkat == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                    <option value="Kecamatan" {{ $prestasi->tingkat == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                    <option value="Kota" {{ $prestasi->tingkat == 'Kota' ? 'selected' : '' }}>Kota</option>
                    <option value="Provinsi" {{ $prestasi->tingkat == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="Nasional" {{ $prestasi->tingkat == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                </select>
            </div>

            {{-- Tahun --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tahun Perolehan</label>
                <input type="number" name="tahun" value="{{ old('tahun', $prestasi->tahun) }}" class="input w-full" required>
            </div>

            {{-- Foto --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Foto Dokumentasi</label>
                
                @if($prestasi->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $prestasi->foto) }}" class="h-24 rounded border border-gray-200">
                    </div>
                @endif

                <input type="file" name="foto" class="input w-full p-2 border" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>

            {{-- Deskripsi --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="4" class="input w-full p-3 border rounded" required>{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
            </div>

        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('admin.kelola-halaman.prestasi') }}" class="btn-light">Batal</a>
        </div>
    </form>

</div>

@endsection