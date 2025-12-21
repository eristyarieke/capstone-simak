@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Edit Banner
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">

    <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Judul Banner</label>
            <input type="text" name="judul" value="{{ old('judul', $banner->judul) }}" class="input w-full" required>
        </div>

        {{-- Subjudul --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Subjudul</label>
            <input type="text" name="subjudul" value="{{ old('subjudul', $banner->subjudul) }}" class="input w-full">
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Gambar Banner</label>
            
            {{-- Preview Gambar Lama --}}
            @if($banner->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $banner->gambar) }}" alt="Current Image" class="h-32 rounded shadow-sm">
                </div>
            @endif

            <input type="file" name="gambar" class="input w-full p-2 border" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
        </div>

        {{-- Status --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" class="input w-full">
                <option value="aktif" {{ $banner->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $banner->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Update
            </button>
            <a href="{{ route('admin.banner') }}" class="btn-light">
                Batal
            </a>
        </div>
    </form>

</div>

@endsection