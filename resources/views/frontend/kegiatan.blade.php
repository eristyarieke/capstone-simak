@extends('layouts.frontend')

@section('title', 'Galeri Kegiatan')

@section('content')

{{-- ================= PAGE HEADER ================= --}}
<section class="bg-slate-50 py-20 border-b border-slate-200">
    <div class="container mx-auto px-4 text-center">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block animate-fade-in-up">Dokumentasi</span>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 animate-fade-in-up delay-100">
            Galeri Kegiatan
        </h1>
        <p class="text-slate-500 text-lg max-w-2xl mx-auto animate-fade-in-up delay-200">
            Rekaman jejak aktivitas pembelajaran, kreativitas, dan kebersamaan di lingkungan sekolah.
        </p>
    </div>
</section>

{{-- ================= LIST KEGIATAN ================= --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($kegiatan as $item)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full">
                    
                    {{-- FOTO KEGIATAN --}}
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto) }}"
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        {{-- Overlay Gradient (Subtle) --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>

                        {{-- Date Badge (Floating Glassmorphism) --}}
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-lg shadow-sm border border-white/50">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-700">
                                <i class="fa-regular fa-calendar text-blue-600"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 leading-snug group-hover:text-blue-600 transition-colors">
                            {{ $item->judul }}
                        </h3>

                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-4 flex-grow">
                            {{ Str::limit($item->deskripsi, 120) }}
                        </p>
                    </div>
                </article>
            @empty
                {{-- EMPTY STATE --}}
                <div class="col-span-full py-20 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-300">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-sm mb-6">
                        <i class="fa-regular fa-images text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-700">Belum ada dokumentasi</h3>
                    <p class="text-slate-500 mt-1">Kegiatan sekolah belum diunggah.</p>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($kegiatan->hasPages())
            <div class="mt-16 flex justify-center">
                {{-- Styling pagination default Laravel biasanya sudah cukup, 
                     tapi dibungkus div agar centered --}}
                <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100">
                    {{ $kegiatan->links('pagination::tailwind') }}
                </div>
            </div>
        @endif

    </div>
</section>
@endsection