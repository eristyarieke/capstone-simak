@extends('layouts.frontend')

@section('title', $berita->judul)

@section('content')

<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">

        {{-- ================= BREADCRUMB ================= --}}
        <nav class="flex mb-8 text-sm font-medium text-slate-500">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">
                        <i class="fa-solid fa-house mr-2"></i>Beranda
                    </a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-xs text-slate-300"></i></li>
                <li>
                    <a href="{{ route('artikel') }}" class="hover:text-blue-600 transition-colors">Artikel</a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-xs text-slate-300"></i></li>
                <li aria-current="page">
                    <span class="text-slate-800 line-clamp-1">{{ $berita->judul }}</span>
                </li>
            </ol>
        </nav>

        {{-- ================= HEADER ARTIKEL ================= --}}
        <header class="mb-10 text-center md:text-left">
            <div class="mb-4">
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $berita->kategori ?? 'Berita Sekolah' }}
                </span>
            </div>

            <h1 class="text-3xl md:text-5xl font-bold text-slate-900 mb-6 leading-tight">
                {{ $berita->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 text-sm text-slate-500 border-b border-slate-100 pb-8">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center">
                        <i class="fa-solid fa-user text-slate-500 text-xs"></i>
                    </div>
                    <span class="font-medium text-slate-700">{{ $berita->penulis ?? 'Admin Sekolah' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar text-blue-500"></i>
                    <span>{{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </header>

        {{-- ================= FEATURED IMAGE ================= --}}
        @if($berita->thumbnail)
            <div class="mb-12 rounded-2xl overflow-hidden shadow-xl shadow-slate-200">
                <img src="{{ asset('storage/' . $berita->thumbnail) }}"
                     alt="{{ $berita->judul }}"
                     class="w-full object-cover max-h-[500px]">
            </div>
        @endif

        {{-- ================= ISI KONTEN ================= --}}
        {{-- Menggunakan class 'prose' dari Tailwind Typography untuk formatting otomatis --}}
        <article class="prose prose-lg prose-slate max-w-none prose-img:rounded-xl prose-a:text-blue-600 hover:prose-a:text-blue-800 text-slate-600 leading-loose">
            {!! $berita->isi !!}
        </article>

        {{-- ================= FOOTER / NAVIGASI ================= --}}
        <div class="mt-16 pt-8 border-t border-slate-200">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <a href="{{ route('artikel') }}"
                   class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 font-semibold transition-colors group">
                    <i class="fa-solid fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Daftar Artikel
                </a>

                {{-- Social Share (Optional Placeholder) --}}
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-400 font-medium">Bagikan:</span>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-green-500 hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection