@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Edit Pengumuman
</h2>

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <form action="{{ route('admin.kelola-halaman.pengumuman.update', $pengumuman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Judul --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Judul Pengumuman</label>
                <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" class="input w-full p-3 text-lg border-gray-300 rounded" required>
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal) }}" class="input w-full p-2 border rounded" required>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" class="input w-full p-2 border rounded" required>
                    <option value="Aktif" {{ $pengumuman->status == 'tampil' ? 'selected' : '' }}>Tampil (Tampilkan)</option>
                    <option value="Nonaktif" {{ $pengumuman->status == 'arsip' ? 'selected' : '' }}>Arsip (Sembunyikan)</option>
                </select>
            </div>

            {{-- Isi Pengumuman --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Isi Pengumuman</label>
                <textarea name="isi" rows="6" class="input w-full p-3 border rounded" required>{{ old('isi', $pengumuman->isi) }}</textarea>
            </div>

        </div>

        <div class="flex gap-3 mt-8 border-t pt-4">
            <button type="submit" class="btn-primary px-6 py-2">
                <i class="fa fa-sync mr-1"></i> Perbarui
            </button>
            <a href="{{ route('admin.kelola-halaman.pengumuman') }}" class="btn-light px-6 py-2 text-gray-600 border hover:bg-gray-50 rounded">
                Batal
            </a>
        </div>
    </form>

</div>

@endsection