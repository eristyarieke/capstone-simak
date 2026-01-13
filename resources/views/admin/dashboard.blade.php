@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Carbon;

    $maxKelas = collect($kelasDistribusi ?? [])->max('jumlah') ?: 1;

    $barStyles = [
        'bg-blue-600',
        'bg-green-600',
        'bg-yellow-500',
        'bg-purple-700',
        'bg-red-700',
        'bg-indigo-900',
    ];

    $textStyles = [
        'text-blue-600',
        'text-green-600',
        'text-yellow-600',
        'text-purple-700',
        'text-red-700',
        'text-indigo-900',
    ];
@endphp

{{-- IMPORTANT:
     Jangan pakai container bootstrap.
     Cukup wrapper yang aman supaya tidak nabrak sidebar --}}
<div class="w-full">
    <div class="px-6 py-6">

        {{-- Header --}}
        <div class="flex items-start justify-between gap-4 mb-6">
            <div class="min-w-0">
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 truncate">
                    Selamat Datang di Dashboard SIMAK
                </h1>
                <p class="text-slate-500 mt-1">
                    Sistem Informasi Manajemen Akademik
                </p>
            </div>

            <div class="text-right shrink-0">
                <div class="font-semibold text-slate-800">
                    {{ auth()->user()->name ?? 'Admin' }}
                </div>
                <div class="text-slate-500">
                    {{ Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        {{-- Cards (4 kolom, fix responsive) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
            {{-- Total Siswa --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm">Total Siswa</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalSiswa ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10 5v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2m12-10a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Total Guru --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm">Total Guru</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalGuru ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 14a4 4 0 10-8 0m8 0v6H8v-6"/>
                    </svg>
                </div>
            </div>

            {{-- Total Kelas --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm">Total Kelas</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalKelas ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 21h18M6 21V5a2 2 0 012-2h8a2 2 0 012 2v16"/>
                    </svg>
                </div>
            </div>

            {{-- Total Mapel --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm">Total Mata Pelajaran</div>
                    <div class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalMapel ?? 0 }}</div>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6l-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2h4l2-2m0-14l2-2h4a2 2 0 012 2v14a2 2 0 01-2 2h-4l-2-2m0-14v14"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Bagian bawah (2 kolom) --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            {{-- Distribusi --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-xl font-extrabold text-slate-800 mb-5">Distribusi Siswa per Kelas</h2>

                @if(empty($kelasDistribusi) || collect($kelasDistribusi)->count() === 0)
                    <div class="text-slate-500">Data distribusi kelas belum tersedia.</div>
                @else
                    <div class="space-y-5">
                        @foreach($kelasDistribusi as $i => $item)
                            @php
                                $label  = $item['label'] ?? 'Kelas';
                                $jumlah = (int) ($item['jumlah'] ?? 0);
                                $pct    = (int) round(($jumlah / $maxKelas) * 100);

                                $bar = $barStyles[$i % count($barStyles)];
                                $txt = $textStyles[$i % count($textStyles)];
                            @endphp

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="font-semibold text-slate-600">{{ $label }}</div>
                                    <div class="font-bold {{ $txt }}">{{ $jumlah }} Siswa</div>
                                </div>

                                <div class="w-full h-4 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-4 {{ $bar }} rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Aktivitas --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-xl font-extrabold text-slate-800 mb-5">Aktivitas Terbaru</h2>

                @if(empty($aktivitas) || collect($aktivitas)->count() === 0)
                    <div class="text-slate-500">Belum ada aktivitas terbaru.</div>
                @else
                    <div class="space-y-4">
                        @foreach($aktivitas as $a)
                            @php
                                $judul = $a['judul'] ?? 'Aktivitas';
                                $desc  = $a['desc'] ?? '-';
                                $time  = $a['time'] ?? null;
                                $human = $time ? Carbon::parse($time)->diffForHumans() : null;
                                $icon  = $a['icon'] ?? 'bell';
                            @endphp

                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    {{-- icon sederhana --}}
                                    @if($icon === 'user-plus')
                                        <span class="text-blue-600 font-extrabold">+</span>
                                    @elseif($icon === 'calendar')
                                        <span class="text-blue-600 font-extrabold">📅</span>
                                    @elseif($icon === 'book-check')
                                        <span class="text-blue-600 font-extrabold">📘</span>
                                    @else
                                        <span class="text-blue-600 font-extrabold">🔔</span>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="font-extrabold text-slate-800 truncate">{{ $judul }}</div>
                                    <div class="text-slate-500 text-sm mt-1">{{ $desc }}</div>
                                    @if($human)
                                        <div class="text-slate-400 text-sm mt-1">{{ $human }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
<script>

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Login!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000 
        });
    @endif
</script>
@endsection
