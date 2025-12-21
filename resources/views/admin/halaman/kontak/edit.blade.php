@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Kelola Kontak Sekolah
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-4xl">

    {{-- Alert Info --}}
    <div class="bg-blue-50 text-blue-800 p-4 rounded mb-6 text-sm">
        <i class="fa fa-info-circle mr-2"></i>
        Informasi ini akan ditampilkan di bagian footer website dan halaman "Hubungi Kami".
    </div>

    <form action="{{ route('admin.kelola-halaman.kontak.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- KOLOM KIRI: INFO UTAMA --}}
            <div class="space-y-5">
                <h3 class="font-bold text-gray-700 border-b pb-2 mb-4">Informasi Dasar</h3>

                {{-- Alamat --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="4" class="input w-full p-3 border rounded" placeholder="Nama Jalan, Kelurahan, Kecamatan, Kota..." required>{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
                </div>

                {{-- Telepon --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nomor Telepon / WhatsApp</label>
                    <div class="flex items-center border rounded overflow-hidden">
                        <span class="bg-gray-100 px-3 py-2 text-gray-600 border-r"><i class="fa fa-phone"></i></span>
                        <input type="text" name="telepon" value="{{ old('telepon', $kontak->telepon ?? '') }}" class="input w-full p-2 border-none focus:ring-0" placeholder="0812xxxx" required>
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Alamat Email</label>
                    <div class="flex items-center border rounded overflow-hidden">
                        <span class="bg-gray-100 px-3 py-2 text-gray-600 border-r"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email', $kontak->email ?? '') }}" class="input w-full p-2 border-none focus:ring-0" placeholder="sekolah@example.com" required>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: SOSMED & LINK --}}
            <div class="space-y-5">
                <h3 class="font-bold text-gray-700 border-b pb-2 mb-4">Media Sosial & Web</h3>

                {{-- Instagram --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Instagram (Link/Username)</label>
                    <div class="flex items-center border rounded overflow-hidden">
                        <span class="bg-pink-100 px-3 py-2 text-pink-600 border-r"><i class="fab fa-instagram"></i></span>
                        <input type="text" name="instagram" value="{{ old('instagram', $kontak->instagram ?? '') }}" class="input w-full p-2 border-none focus:ring-0" placeholder="https://instagram.com/sdnkendangsari3">
                    </div>
                </div>

                {{-- YouTube --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">YouTube Channel</label>
                    <div class="flex items-center border rounded overflow-hidden">
                        <span class="bg-red-100 px-3 py-2 text-red-600 border-r"><i class="fab fa-youtube"></i></span>
                        <input type="text" name="youtube" value="{{ old('youtube', $kontak->youtube ?? '') }}" class="input w-full p-2 border-none focus:ring-0" placeholder="Link channel youtube...">
                    </div>
                </div>

                {{-- Website --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Website Utama</label>
                    <div class="flex items-center border rounded overflow-hidden">
                        <span class="bg-blue-100 px-3 py-2 text-blue-600 border-r"><i class="fa fa-globe"></i></span>
                        <input type="text" name="website" value="{{ old('website', $kontak->website ?? '') }}" class="input w-full p-2 border-none focus:ring-0" placeholder="https://...">
                    </div>
                </div>
            </div>

        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="flex justify-end mt-8 border-t pt-4">
            <button type="submit" class="btn-primary px-8 py-2 text-lg shadow">
                <i class="fa fa-save mr-2"></i> Simpan Kontak
            </button>
        </div>

    </form>
</div>

@endsection