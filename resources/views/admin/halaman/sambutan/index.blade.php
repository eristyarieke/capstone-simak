@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Kelola Sambutan Kepala Sekolah
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-4xl">

    {{-- Alert Info --}}
    <div class="bg-blue-50 text-blue-800 p-4 rounded mb-6 text-sm">
        <i class="fa fa-info-circle mr-2"></i>
        Halaman ini menampilkan sambutan kepala sekolah yang aktif. Silakan ubah formulir di bawah ini untuk memperbarui data.
    </div>

    <form action="{{ route('admin.kelola-halaman.sambutan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI: Foto --}}
            <div class="md:col-span-1 text-center">
                <label class="block text-gray-700 font-bold mb-3">Foto Kepala Sekolah</label>
                
                {{-- Preview Foto --}}
                <div class="mb-4 flex justify-center">
                    @if($sambutan && $sambutan->foto)
                        <img src="{{ asset('storage/' . $sambutan->foto) }}" 
                             alt="Kepala Sekolah" 
                             class="w-48 h-48 object-cover rounded-full shadow border-4 border-gray-200">
                    @else
                        <div class="w-48 h-48 bg-gray-200 rounded-full flex items-center justify-center text-gray-400 border-4 border-white shadow">
                            <i class="fa fa-user text-6xl"></i>
                        </div>
                    @endif
                </div>

                <input type="file" name="foto" class="input text-sm w-full border p-2" accept="image/*">
                <p class="text-xs text-gray-500 mt-2">Format: JPG/PNG. Maks: 2MB.</p>
            </div>

            {{-- KOLOM KANAN: Form Data --}}
            <div class="md:col-span-2">
                
                {{-- Nama Kepsek --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-bold mb-2">Nama Kepala Sekolah</label>
                    <input type="text" 
                           name="nama_kepsek" 
                           value="{{ old('nama_kepsek', $sambutan->nama_kepsek ?? '') }}" 
                           class="input w-full p-2 border rounded focus:ring focus:ring-blue-200" 
                           placeholder="Contoh: Budi Santoso, S.Pd., M.Pd."
                           required>
                </div>

                {{-- Isi Sambutan --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-bold mb-2">Isi Sambutan</label>
                    <textarea name="isi_sambutan" 
                              rows="10" 
                              class="input w-full p-3 border rounded focus:ring focus:ring-blue-200"
                              placeholder="Tuliskan kata sambutan di sini..."
                              required>{{ old('isi_sambutan', $sambutan->isi_sambutan ?? '') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">*Anda bisa menulis beberapa paragraf di sini.</p>
                </div>

                {{-- Tombol Simpan --}}
                <div class="text-right">
                    <button type="submit" class="btn-primary px-6 py-2">
                        <i class="fa fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

@endsection