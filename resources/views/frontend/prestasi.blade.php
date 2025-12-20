@extends('layouts.frontend')

@section('title', 'Prestasi Sekolah')

@section('content')

{{-- PAGE HEADER --}}
<section class="bg-blue-800 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold">Prestasi Siswa & Sekolah</h1>
        <p class="text-blue-200 mt-2">Kebanggaan kami, bukti kualitas pendidikan</p>
    </div>
</section>

{{-- LIST PRESTASI --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($prestasi as $p)
            <div class="border border-gray-200 rounded-xl p-6 flex flex-col items-center text-center hover:border-yellow-400 hover:shadow-lg transition bg-white relative overflow-hidden">
                {{-- Badge Tahun --}}
                <div class="absolute top-0 right-0 bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-bl-xl">
                    {{ $p->tahun }}
                </div>

                {{-- Icon Piala --}}
                <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-500 text-4xl mb-4 border border-yellow-100">
                    <i class="fas fa-trophy"></i>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $p->judul ?? $p->nama_lomba }}</h3>
                
                {{-- Peringkat --}}
                <span class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded-full mb-3">
                    {{ $p->juara_ke ?? 'Juara' }} - {{ $p->tingkat ?? 'Nasional' }}
                </span>

                <p class="text-gray-500 text-sm">
                    {{ $p->keterangan ?? 'Diraih oleh siswa terbaik kami dalam ajang kompetisi bergengsi.' }}
                </p>
                
                @if(!empty($p->nama_siswa))
                <div class="mt-4 pt-4 border-t border-gray-100 w-full">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Pemenang</p>
                    <p class="font-semibold text-gray-700">{{ $p->nama_siswa }}</p>
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">Belum ada data prestasi.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            {{ $prestasi->links('pagination::tailwind') }}
        </div>

    </div>
</section>
@endsection