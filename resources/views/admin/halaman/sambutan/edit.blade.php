@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">Edit Sambutan Kepala Sekolah</h2>

<div class="bg-white rounded-lg shadow p-6">
    {{-- Pastikan route update sesuai --}}
    <form action="{{ route('admin.halaman.sambutan.update', $sambutan->id ?? '') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Nama Kepsek --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kepala Sekolah</label>
                <input type="text" name="nama_kepsek" value="{{ old('nama_kepsek', $sambutan->nama_kepsek ?? '') }}" class="input w-full border rounded p-2">
            </div>

            {{-- Foto --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kepala Sekolah</label>
                @if(isset($sambutan->foto))
                    <img src="{{ asset('storage/' . $sambutan->foto) }}" class="w-20 h-20 object-cover rounded mb-2 border">
                @endif
                <input type="file" name="foto" class="input w-full border rounded p-2">
            </div>
        </div>

        {{-- Isi Sambutan --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Isi Sambutan</label>
            <textarea name="isi_sambutan" rows="6" class="input w-full border rounded p-2">{{ old('isi_sambutan', $sambutan->isi_sambutan ?? '') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection