@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Carbon;
@endphp

<div class="w-full">
    <div class="px-6 py-6">

        {{-- === HEADER === --}}
        <div class="flex items-start justify-between gap-4 mb-6">
            <div class="min-w-0">
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 truncate">
                    Dashboard Guru
                </h1>
                <p class="text-slate-500 mt-1">
                    Selamat datang, semangat mengajar hari ini!
                </p>
            </div>

            <div class="text-right shrink-0">
                <div class="font-semibold text-slate-800">
                    {{ auth()->user()->name ?? 'Guru' }}
                </div>
                <div class="text-slate-500 text-sm">
                    {{ Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        {{-- === STATS CARDS (Sama dengan Admin untuk info umum) === --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
            {{-- Total Siswa --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Total Siswa</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalSiswa ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10 5v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2m12-10a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Total Guru --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Rekan Guru</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalGuru ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Total Kelas --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Total Kelas</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalKelas ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"/>
                    </svg>
                </div>
            </div>

            {{-- Total Mapel --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium">Mata Pelajaran</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalMapel ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- === CONTENT BAWAH (2 KOLOM) === --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            
            {{-- KOLOM KIRI: JADWAL MENGAJAR HARI INI --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-xl font-extrabold text-slate-800">
                        Jadwal Hari {{ $hariIni ?? 'Ini' }}
                    </h2>
                    <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
                        {{ isset($jadwalHariIni) ? count($jadwalHariIni) : 0 }} Sesi
                    </span>
                </div>

                @if(empty($jadwalHariIni) || count($jadwalHariIni) === 0)
                    <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                        <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Tidak ada jadwal mengajar hari ini.</span>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($jadwalHariIni as $j)
                            <div class="group flex items-center gap-4 p-3 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50/50 transition-all duration-300">
                                {{-- Kotak Jam --}}
                                <div class="flex flex-col items-center justify-center w-16 h-16 bg-blue-50 text-blue-600 rounded-lg shrink-0 group-hover:bg-blue-100 group-hover:text-blue-700 transition-colors">
                                    <span class="text-xs font-bold">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }}</span>
                                    <div class="w-3 h-[1px] bg-blue-300 my-0.5"></div>
                                    <span class="text-xs font-bold">{{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</span>
                                </div>

                                {{-- Detail Mapel --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-slate-800 text-lg truncate">
                                        {{ $j->mapel->nama_mapel ?? 'Mapel' }}
                                    </h3>
                                    <div class="flex items-center gap-3 text-sm text-slate-500 mt-1">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"/></svg>
                                            <span class="font-medium text-slate-600">{{ $j->kelas->nama_kelas ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Indikator Status (Opsional) --}}
                                <div class="hidden sm:block">
                                     <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN: PENGUMUMAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-xl font-extrabold text-slate-800">Pengumuman Sekolah</h2>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">Lihat Semua</a>
                </div>

                @if(empty($pengumuman) || count($pengumuman) === 0)
                    <div class="text-slate-500 text-center py-10">Belum ada pengumuman terbaru.</div>
                @else
                    <div class="space-y-4">
                        @foreach($pengumuman as $p)
                            <div class="flex gap-4">
                                {{-- Icon Megaphone --}}
                                <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="font-extrabold text-slate-800 truncate">{{ $p->judul ?? 'Pengumuman' }}</div>
                                    <p class="text-slate-500 text-sm mt-1 line-clamp-2">
                                        {{ Str::limit($p->isi ?? $p->konten ?? '', 80) }}
                                    </p>
                                    <div class="text-slate-400 text-xs mt-2 font-medium">
                                        {{ $p->created_at ? $p->created_at->diffForHumans() : '' }}
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