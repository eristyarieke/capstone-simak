@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-6">Kelola Halaman</h2>

<div class="bg-white rounded shadow p-8">

    <h3 class="text-lg font-semibold mb-6">Pilih Topik :</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @php
            $menu = [
                ['url'=>'galeri',   'icon'=>'image',         'label'=>'Galeri'],
                ['url'=>'kegiatan', 'icon'=>'calendar',      'label'=>'Kegiatan'],
                ['url'=>'prestasi', 'icon'=>'star',          'label'=>'Prestasi'],
                ['url'=>'artikel',  'icon'=>'file-lines',    'label'=>'Artikel'],
                ['url'=>'kontak',   'icon'=>'address-card',  'label'=>'Kontak'],
                ['url'=>'banner',   'icon'=>'window-maximize','label'=>'Banner Utama'],
                ['url'=>'sambutan', 'icon'=>'comment-dots',  'label'=>'Sambutan'],
                ['url'=>'profil',   'icon'=>'building',      'label'=>'Profil Sekolah'],
                ['url'=>'visi',     'icon'=>'bookmark',      'label'=>'Visi'],
                ['url'=>'misi',     'icon'=>'check-square',  'label'=>'Misi'],
            ];
        @endphp

        @foreach ($menu as $m)
            <a href="{{ url('admin/kelola-halaman/'.$m['url']) }}"
               class="w-full h-44
                      border-4 border-primary rounded-xl
                      flex flex-col items-center justify-center
                      hover:bg-primary group transition">

                <i class="fa-solid fa-{{ $m['icon'] }}
                          text-5xl mb-4
                          text-primary group-hover:text-white"></i>

                <span class="font-semibold text-gray-700 group-hover:text-white">
                    {{ $m['label'] }}
                </span>
            </a>
        @endforeach

    </div>
</div>

@endsection
