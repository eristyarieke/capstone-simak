@extends('layouts.frontend')

@section('title', $berita->judul)

@section('content')

{{-- ================= BREADCRUMB ================= --}}
<section class="bg-gray-100 py-6 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <p class="text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a> /
            <a href="{{ route('artikel') }}" class="hover:text-blue-600">Artikel</a> /
            <span class="text-gray-700 font-medium">
                {{ Str::limit($berita->judul, 40) }}
            </span>
        </p>
    </div>
</section>

{{-- ================= DETAIL ARTIKEL ================= --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">

        {{-- HEADER ARTIKEL --}}
        <div class="mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $berita->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 border-b pb-6">
                <span class="flex items-center gap-2">
                    <i class="far fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('l, d F Y') }}
                </span>
                <span class="flex items-center gap-2">
                    <i class="far fa-user"></i>
                    {{ $berita->penulis ?? 'Admin' }}
                </span>
            </div>
        </div>

        {{-- FEATURED IMAGE --}}
        @if($berita->thumbnail)
            <div class="mb-14 rounded-2xl overflow-hidden shadow-lg">
                <img
                    src="{{ asset('storage/' . $berita->thumbnail) }}"
                    alt="{{ $berita->judul }}"
                    class="w-full object-cover">
            </div>
        @endif

        {{-- ISI ARTIKEL --}}
        <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $berita->isi !!}
        </article>

        {{-- TOMBOL KEMBALI --}}
        <div class="mt-20 pt-10 border-t">
            <a href="{{ route('artikel') }}"
               class="inline-flex items-center gap-2 bg-blue-800 hover:bg-blue-900 text-white px-6 py-3 rounded-lg transition shadow-md">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Artikel
            </a>
        </div>

    </div>
</section>
@endsection
