@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">Edit Profil Sekolah</h2>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.halaman.profil.update', $profil->id ?? '') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Deskripsi --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat Sekolah</label>
            <textarea name="deskripsi" rows="4" class="input w-full border rounded p-2">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Logo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo Sekolah</label>
                @if(isset($profil->logo))
                    <img src="{{ asset('storage/' . $profil->logo) }}" class="w-16 h-16 object-contain mb-2 border p-1">
                @endif
                <input type="file" name="logo" class="input w-full border rounded p-2">
            </div>

            {{-- Foto Gedung --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Gedung Utama</label>
                @if(isset($profil->foto_gedung))
                    <img src="{{ asset('storage/' . $profil->foto_gedung) }}" class="w-32 h-20 object-cover mb-2 border rounded">
                @endif
                <input type="file" name="foto_gedung" class="input w-full border rounded p-2">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Profil
            </button>
        </div>
    </form>
</div>
@endsection