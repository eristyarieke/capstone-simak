@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Carbon;

    // Menghitung max untuk progress bar distribusi
    $maxKelas = collect($kelasDistribusi ?? [])->max('jumlah') ?: 1;

    // Array warna untuk chart/bar
    $barStyles = [
        'bg-blue-600', 'bg-green-600', 'bg-yellow-500', 'bg-purple-700',
        'bg-red-700', 'bg-indigo-900', 'bg-teal-600', 'bg-pink-600'
    ];

    $textStyles = [
        'text-blue-600', 'text-green-600', 'text-yellow-600', 'text-purple-700',
        'text-red-700', 'text-indigo-900', 'text-teal-600', 'text-pink-600'
    ];
@endphp

<div class="w-full">
    <div class="px-6 py-6">

        {{-- === HEADER === --}}
        <div class="flex items-start justify-between gap-4 mb-6">
            <div class="min-w-0">
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 truncate">
                    Dashboard Kepala Sekolah
                </h1>
                <p class="text-slate-500 mt-1">
                    Ringkasan statistik akademik dan prestasi sekolah
                </p>
            </div>

            <div class="text-right shrink-0">
                <div class="font-semibold text-slate-800">
                    {{ auth()->user()->name ?? 'Kepala Sekolah' }}
                </div>
                <div class="text-slate-500 text-sm">
                    {{ Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        {{-- === CARDS (STATISTIK UTAMA) === --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
            
            {{-- 1. Total Siswa --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Total Siswa</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalSiswa ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    {{-- Icon Users --}}
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10 5v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2m12-10a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>

            {{-- 2. Total Guru --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Total Guru</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalGuru ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                    {{-- Icon User --}}
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 14a4 4 0 10-8 0m8 0v6H8v-6"/>
                    </svg>
                </div>
            </div>

            {{-- 3. Total Kelas --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Total Kelas</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalKelas ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center">
                    {{-- Icon School/Building --}}
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"/>
                    </svg>
                </div>
            </div>

            {{-- 4. Total Prestasi (Khusus Kepsek, ini lebih penting daripada Mapel) --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Total Prestasi</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalPrestasi ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center">
                    {{-- Icon Trophy --}}
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- === BAGIAN BAWAH (2 KOLOM) === --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            
            {{-- KOLOM KIRI: DISTRIBUSI SISWA --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-xl font-extrabold text-slate-800">Distribusi Siswa</h2>
                    <span class="text-xs font-semibold bg-slate-100 text-slate-600 py-1 px-3 rounded-full">Per Kelas</span>
                </div>

                @if(empty($kelasDistribusi) || $kelasDistribusi->count() === 0)
                    <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                        <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Belum ada data kelas</span>
                    </div>
                @else
                    <div class="space-y-5">
                        @foreach($kelasDistribusi as $i => $item)
                            @php
                                $label  = $item->nama_kelas ?? 'Kelas';
                                $jumlah = $item->siswa_count ?? 0; // Menggunakan withCount('siswa')
                                $pct    = $maxKelas > 0 ? (int) round(($jumlah / $maxKelas) * 100) : 0;
                                
                                // Rotasi warna
                                $bar = $barStyles[$i % count($barStyles)];
                                $txt = $textStyles[$i % count($textStyles)];
                            @endphp

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="font-semibold text-slate-700 text-sm">{{ $label }}</div>
                                    <div class="font-bold {{ $txt }} text-sm">{{ $jumlah }} Siswa</div>
                                </div>
                                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-3 {{ $bar }} rounded-full transition-all duration-500 ease-out" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN: PRESTASI TERBARU (KHUSUS KEPSEK) --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-xl font-extrabold text-slate-800">Prestasi Terbaru</h2>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700 hover:underline">Lihat Semua</a>
                </div>

                @if(empty($prestasiTerbaru) || $prestasiTerbaru->count() === 0)
                    <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                        <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>Belum ada data prestasi</span>
                    </div>
                @else
                    <div class="space-y-0">
                        @foreach($prestasiTerbaru as $p)
                            <div class="flex gap-4 py-4 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors rounded-lg px-2 -mx-2">
                                {{-- Icon Piala --}}
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-lg">🏆</span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    {{-- Judul Prestasi --}}
                                    <div class="font-bold text-slate-800 truncate text-base">
                                        {{ $p->judul ?? $p->nama_lomba ?? 'Juara Lomba' }}
                                    </div>
                                    
                                    {{-- Deskripsi/Keterangan --}}
                                    <p class="text-slate-500 text-sm mt-0.5 line-clamp-1">
                                        {{ $p->deskripsi ?? $p->keterangan ?? 'Prestasi membanggakan sekolah' }}
                                    </p>
                                    
                                    {{-- Tanggal --}}
                                    <div class="flex items-center gap-2 mt-2 text-xs text-slate-400 font-medium">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $p->created_at ? $p->created_at->translatedFormat('d F Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection