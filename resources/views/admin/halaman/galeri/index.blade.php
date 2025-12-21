@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-gray-800">
        Galeri Foto Sekolah
    </h2>
    <a href="{{ route('admin.kelola-halaman.galeri.create') }}" class="btn-success">
        <i class="fa fa-plus mr-1"></i> Tambah Foto
    </a>
</div>

{{-- GRID GALERI --}}
<div class="bg-white rounded-lg shadow p-6">
    
    @if($galeri->isEmpty())
        <div class="text-center py-10 text-gray-400">
            <i class="fa fa-images text-4xl mb-3"></i>
            <p>Belum ada foto di galeri.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galeri as $item)
                <div class="group relative bg-gray-50 border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    
                    {{-- Gambar --}}
                    <div class="aspect-square bg-gray-200 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $item->foto) }}" 
                             alt="{{ $item->judul }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        
                        {{-- Overlay Kategori (Badge) --}}
                        <div class="absolute top-2 left-2">
                            <span class="bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                                {{ $item->kategori }}
                            </span>
                        </div>
                    </div>

                    {{-- Konten Text & Tombol Hapus --}}
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 text-sm mb-1 truncate" title="{{ $item->judul }}">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-3">
                            {{ $item->created_at->format('d M Y') }}
                        </p>

                        {{-- Tombol Hapus Full Width --}}
                        <form action="{{ route('admin.kelola-halaman.galeri.destroy', $item->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white text-xs font-bold py-2 rounded transition">
                                <i class="fa fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

@endsection