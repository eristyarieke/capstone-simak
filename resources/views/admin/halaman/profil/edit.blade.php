@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Kelola Profil Sekolah
</h2>

<div class="bg-white rounded-lg shadow p-6">

    {{-- Alert Info --}}
    <div class="bg-blue-50 text-blue-800 p-4 rounded mb-6 text-sm flex items-start gap-3">
        <i class="fa fa-info-circle mt-1"></i>
        <div>
            <p class="font-bold">Informasi</p>
            <p>Data profil ini akan tampil di halaman utama dan halaman "Profil Sekolah". Pastikan logo menggunakan background transparan (PNG) agar terlihat rapi.</p>
        </div>
    </div>

    <form action="{{ route('admin.kelola-halaman.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- BAGIAN GAMBAR (GRID 2 KOLOM) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 border-b pb-8">
            
            {{-- 1. Upload Logo --}}
            <div class="bg-gray-50 p-6 rounded-lg text-center border border-gray-200">
                <label class="block text-gray-700 font-bold mb-3">Logo Sekolah</label>
                
                <div class="mb-4 flex justify-center">
                    @if($profil && $profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) }}" 
                             alt="Logo" 
                             class="h-32 w-auto object-contain">
                    @else
                        <div class="h-32 w-32 bg-gray-200 rounded-full flex items-center justify-center text-gray-400">
                            <span class="text-sm">No Logo</span>
                        </div>
                    @endif
                </div>

                <input type="file" name="logo" class="input w-full text-sm border p-2 bg-white" accept="image/*">
                <p class="text-xs text-gray-500 mt-2">Disarankan format PNG Transparan.</p>
            </div>

            {{-- 2. Upload Foto Gedung --}}
            <div class="bg-gray-50 p-6 rounded-lg text-center border border-gray-200">
                <label class="block text-gray-700 font-bold mb-3">Foto Gedung / Utama</label>
                
                <div class="mb-4 flex justify-center">
                    @if($profil && $profil->foto_gedung)
                        <img src="{{ asset('storage/' . $profil->foto_gedung) }}" 
                             alt="Gedung" 
                             class="h-32 w-full object-cover rounded shadow">
                    @else
                        <div class="h-32 w-full bg-gray-200 rounded flex items-center justify-center text-gray-400">
                            <span class="text-sm">No Image</span>
                        </div>
                    @endif
                </div>

                <input type="file" name="foto_gedung" class="input w-full text-sm border p-2 bg-white" accept="image/*">
                <p class="text-xs text-gray-500 mt-2">Foto landscape (lebar) lebih disarankan.</p>
            </div>
        </div>

        {{-- BAGIAN DESKRIPSI --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Deskripsi / Sejarah Singkat</label>
            <textarea name="deskripsi" 
                      rows="12" 
                      class="input w-full p-4 border rounded focus:ring focus:ring-blue-200 leading-relaxed"
                      placeholder="Jelaskan tentang profil sekolah, sejarah singkat, atau keunggulan sekolah..."
                      required>{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="flex justify-end gap-3">
            <button type="submit" class="btn-primary px-8 py-2">
                <i class="fa fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>

    </form>
</div>

@endsection