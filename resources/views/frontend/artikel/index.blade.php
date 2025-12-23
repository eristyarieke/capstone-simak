@extends('layouts.frontend')

@section('title', 'Berita & Artikel')

@section('content')

{{-- ================= PAGE HEADER ================= --}}
<section class="bg-slate-50 py-20 border-b border-slate-200">
    <div class="container mx-auto px-4 text-center">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block animate-fade-in-up">Jurnal Sekolah</span>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 animate-fade-in-up delay-100">
            Berita & Artikel Terkini
        </h1>
        <p class="text-slate-500 text-lg max-w-2xl mx-auto animate-fade-in-up delay-200">
            Informasi terbaru seputar kegiatan akademik, prestasi, dan wawasan pendidikan.
        </p>
    </div>
</section>

{{-- ================= LIST ARTIKEL ================= --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($artikel as $a)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group">
                    
                    {{-- THUMBNAIL --}}
                    <a href="{{ route('artikel.detail', $a->slug ?? $a->id) }}" class="relative h-56 overflow-hidden block">
                        <img src="{{ asset('storage/' . $a->thumbnail) }}" 
                             alt="{{ $a->judul }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        {{-- Overlay on Hover --}}
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        {{-- Category Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">
                                {{ $a->kategori ?? 'Umum' }}
                            </span>
                        </div>
                    </a>
                    
                    {{-- KONTEN --}}
                    <div class="p-6 flex flex-col flex-grow">
                        {{-- Meta Date --}}
                        <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-3">
                            <i class="fa-regular fa-calendar text-blue-500"></i>
                            <span>{{ \Carbon\Carbon::parse($a->tanggal_publish)->format('d M Y') }}</span>
                        </div>

                        {{-- Judul --}}
                        <h2 class="text-xl font-bold text-slate-800 mb-3 leading-snug group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('artikel.detail', $a->slug ?? $a->id) }}">
                                {{ Str::limit($a->judul, 60) }}
                            </a>
                        </h2>

                        {{-- Excerpt --}}
                        <p class="text-slate-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($a->isi), 120) }}
                        </p>

                        {{-- Footer Card --}}
                        <div class="mt-auto pt-4 border-t border-slate-100 flex justify-between items-center">
                            <a href="{{ route('artikel.detail', $a->slug ?? $a->id) }}" class="text-blue-600 font-semibold text-sm hover:text-blue-800 transition-colors flex items-center gap-1 group/link">
                                Baca Selengkapnya 
                                <i class="fa-solid fa-arrow-right text-xs transform group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full py-20 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-sm mb-4">
                        <i class="fa-regular fa-newspaper text-2xl text-slate-400"></i>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada artikel yang dipublish.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($artikel->hasPages())
            <div class="mt-16 flex justify-center">
                <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100">
                    {{ $artikel->links('pagination::tailwind') }}
                </div>
            </div>
        @endif

    </div>
</section>
@endsection