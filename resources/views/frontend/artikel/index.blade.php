@extends('layouts.frontend')

@section('title', 'Berita & Artikel')

@section('content')

<section class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-blue-900">Berita & Artikel Terkini</h1>
            <div class="h-1 w-20 bg-yellow-400 mx-auto mt-2"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($artikel as $a)
            <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300 flex flex-col h-full">
                {{-- Gambar --}}
                <a href="{{ route('artikel.detail', $a->slug ?? $a->id) }}" class="h-52 overflow-hidden block">
                    <img src="{{ asset('storage/' . $a->thumbnail) }}" alt="{{ $a->judul }}" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </a>
                
                {{-- Konten --}}
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                        <span class="flex items-center gap-1">
                            <i class="far fa-calendar-alt"></i> 
                            {{ \Carbon\Carbon::parse($a->tanggal_publish)->format('d M Y') }}
                        </span>
                        <span class="flex items-center gap-1 text-blue-600 font-semibold">
                            <i class="far fa-folder"></i> {{ $a->kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 mb-3 leading-snug hover:text-blue-700 transition">
                        <a href="{{ route('artikel.detail', $a->slug ?? $a->id) }}">
                            {{ Str::limit($a->judul, 60) }}
                        </a>
                    </h2>

                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($a->isi), 120) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('artikel.detail', $a->slug ?? $a->id) }}" class="text-blue-600 font-semibold text-sm hover:underline flex items-center gap-1">
                            Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">Belum ada artikel yang dipublish.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $artikel->links('pagination::tailwind') }}
        </div>

    </div>
</section>
@endsection