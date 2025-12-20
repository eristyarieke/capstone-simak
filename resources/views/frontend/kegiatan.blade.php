@extends('layouts.frontend')

@section('title', 'Galeri Kegiatan')

@section('content')

{{-- PAGE HEADER --}}
<section class="bg-blue-800 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold">Galeri Kegiatan</h1>
        <p class="text-blue-200 mt-2">Dokumentasi aktivitas siswa dan guru</p>
    </div>
</section>

{{-- LIST KEGIATAN --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($kegiatan as $item)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group">
                <div class="h-56 overflow-hidden relative">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_kegiatan }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/70 to-transparent w-full p-4">
                        <span class="text-white text-xs font-bold bg-yellow-500 px-2 py-1 rounded">
                            {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight group-hover:text-blue-600 transition">
                        {{ $item->nama_kegiatan }}
                    </h3>
                    <p class="text-gray-600 text-sm line-clamp-3">
                        {{ $item->deskripsi }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <div class="text-gray-400 text-6xl mb-4"><i class="far fa-images"></i></div>
                <p class="text-gray-500">Belum ada dokumentasi kegiatan.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            {{ $kegiatan->links('pagination::tailwind') }}
        </div>

    </div>
</section>
@endsection