@extends('layouts.frontend')

@section('title', $berita->judul)

@section('content')

{{-- BREADCRUMB SIMPLE --}}
<div class="bg-gray-100 py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <p class="text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a> / 
            <a href="{{ route('artikel') }}" class="hover:text-blue-600">Artikel</a> / 
            <span class="text-gray-700 font-medium">{{ Str::limit($berita->judul, 30) }}</span>
        </p>
    </div>
</div>

<section class="py-12 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        
        {{-- HEADER ARTIKEL --}}
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                {{ $berita->judul }}
            </h1>
            <div class="flex items-center gap-4 text-sm text-gray-500 border-b pb-4">
                <span class="flex items-center gap-2">
                    <i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('l, d F Y') }}
                </span>
                <span class="flex items-center gap-2">
                    <i class="far fa-user"></i> {{ $berita->penulis ?? 'Admin' }}
                </span>
            </div>
        </div>

        {{-- FEATURED IMAGE --}}
        @if($berita->thumbnail)
        <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}" class="w-full object-cover">
        </div>
        @endif

        {{-- ISI ARTIKEL --}}
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {{-- Gunakan {!! !!} karena isi artikel biasanya HTML dari Text Editor --}}
            {!! $berita->isi !!}
        </div>

        {{-- TOMBOL KEMBALI --}}
        <div class="mt-12 pt-8 border-t">
            <a href="{{ route('artikel') }}" class="inline-flex items-center gap-2 text-white bg-blue-800 hover:bg-blue-900 px-6 py-3 rounded-lg transition shadow-md">
                <i class="fas fa-arrow-left"></i> Kembali ke Berita
            </a>
        </div>

    </div>
</section>
@endsection