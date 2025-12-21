@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold text-gray-800 mb-6">
    Edit Artikel
</h2>

<div class="bg-white rounded-lg shadow p-6">

    <form action="{{ route('admin.kelola-halaman.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- KOLOM KIRI --}}
            <div class="md:col-span-2 space-y-4">
                {{-- Judul --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Judul Artikel</label>
                    <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" class="input w-full text-lg p-3" required>
                </div>

                {{-- Isi Artikel --}}
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Isi Konten</label>
                    <textarea name="isi" rows="15" class="input w-full p-4 border rounded leading-relaxed" required>{{ old('isi', $artikel->isi) }}</textarea>
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div class="space-y-6">
                
                {{-- Penulis --}}
                <div class="bg-gray-50 p-4 rounded border border-gray-200">
                    <label class="block text-gray-700 font-bold mb-2">Penulis</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $artikel->penulis) }}" class="input w-full bg-white" required>
                </div>

                {{-- Status & Tanggal --}}
                <div class="bg-gray-50 p-4 rounded border border-gray-200">
                    <label class="block text-gray-700 font-bold mb-2">Status Publikasi</label>
                    <select name="status" class="input w-full bg-white mb-3">
                        <option value="publish" {{ $artikel->status == 'publish' ? 'selected' : '' }}>Publish (Tayang)</option>
                        <option value="draft" {{ $artikel->status == 'draft' ? 'selected' : '' }}>Draft (Simpan Dulu)</option>
                    </select>

                    <label class="block text-gray-700 font-bold mb-2">Tanggal Publish</label>
                    <input type="date" name="tanggal_publish" class="input w-full bg-white" value="{{ old('tanggal_publish', $artikel->tanggal_publish) }}" required>
                </div>

                {{-- Thumbnail --}}
                <div class="bg-gray-50 p-4 rounded border border-gray-200">
                    <label class="block text-gray-700 font-bold mb-2">Thumbnail (Gambar)</label>
                    
                    @if($artikel->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" class="w-full h-auto rounded border">
                        </div>
                    @endif

                    <input type="file" name="thumbnail" class="input w-full text-sm border bg-white" accept="image/*">
                    <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                </div>

                {{-- Tombol Aksi --}}
                <div class="pt-4">
                    <button type="submit" class="btn-primary w-full py-3 text-lg shadow-md">
                        <i class="fa fa-sync mr-2"></i> Perbarui Artikel
                    </button>
                    <a href="{{ route('admin.kelola-halaman.artikel') }}" class="btn-light w-full mt-2 block text-center">Batal</a>
                </div>

            </div>

        </div>
    </form>

</div>

@endsection