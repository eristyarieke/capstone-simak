@extends('layouts.frontend')

@section('title', 'Prestasi Sekolah')

@section('content')

{{-- ================= PAGE HEADER ================= --}}
<section class="bg-slate-50 py-20 border-b border-slate-200">
    <div class="container mx-auto px-4 text-center">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block animate-fade-in-up">Hall of Fame</span>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 animate-fade-in-up delay-100">
            Prestasi Siswa & Sekolah
        </h1>
        <p class="text-slate-500 text-lg max-w-2xl mx-auto animate-fade-in-up delay-200">
            Bukti nyata dedikasi, kerja keras, dan kualitas pendidikan dalam mencetak generasi juara.
        </p>
    </div>
</section>

{{-- ================= LIST PRESTASI ================= --}}
<section class="py-20 bg-white relative overflow-hidden">
    {{-- Decorative elements --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-10 left-10 w-32 h-32 bg-yellow-100 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($prestasi as $p)
                <div class="relative bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group flex flex-col">
                    
                    {{-- Decorative Top Border --}}
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-yellow-400 to-yellow-200 rounded-t-2xl"></div>

                    {{-- TAHUN (Floating Badge) --}}
                    @if($p->tahun)
                        <div class="absolute top-5 right-5">
                            <span class="bg-slate-100 text-slate-600 text-xs font-bold px-3 py-1 rounded-full border border-slate-200">
                                {{ $p->tahun }}
                            </span>
                        </div>
                    @endif

                    {{-- ICON PIALA --}}
                    <div class="flex justify-center mb-6 mt-2 relative">
                        <div class="absolute inset-0 bg-yellow-400 blur-xl opacity-0 group-hover:opacity-20 transition-opacity duration-500 rounded-full"></div>
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-50 to-white border border-yellow-100 flex items-center justify-center shadow-inner relative z-10">
                            <i class="fas fa-trophy text-4xl text-yellow-500 drop-shadow-sm transform group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                    </div>

                    {{-- JUARA & TINGKAT --}}
                    <div class="text-center mb-4">
                        @if($p->juara_ke || $p->tingkat)
                            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide border border-blue-100">
                                <i class="fa-solid fa-medal"></i>
                                {{ $p->juara_ke ?? 'Juara' }} {{ $p->tingkat ? '• ' . $p->tingkat : '' }}
                            </span>
                        @endif
                    </div>

                    {{-- JUDUL LOMBA --}}
                    <h3 class="text-xl font-bold text-slate-800 text-center mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                        {{ $p->judul ?? $p->nama_lomba ?? 'Prestasi Sekolah' }}
                    </h3>

                    {{-- KETERANGAN --}}
                    <p class="text-slate-500 text-sm leading-relaxed text-center mb-6 line-clamp-3">
                        {{ $p->keterangan ?? 'Prestasi membanggakan yang diraih melalui kompetisi dan kerja keras.' }}
                    </p>

                    {{-- SISWA (Footer) --}}
                    @if(!empty($p->nama_siswa))
                        <div class="mt-auto pt-5 border-t border-slate-100 flex items-center justify-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-user text-xs"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Diraih Oleh</p>
                                <p class="text-sm font-semibold text-slate-700 truncate max-w-[150px]">
                                    {{ $p->nama_siswa }}
                                </p>
                            </div>
                        </div>
                    @else
                         {{-- Spacer jika tidak ada nama siswa agar kartu tetap rapi --}}
                         <div class="mt-auto"></div>
                    @endif

                </div>
            @empty
                {{-- EMPTY STATE --}}
                <div class="col-span-full py-24 text-center">
                    <div class="inline-block p-6 rounded-full bg-slate-50 mb-4 border border-slate-100">
                        <i class="fas fa-award text-5xl text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-600">Belum Ada Data Prestasi</h3>
                    <p class="text-slate-400 text-sm mt-1">Data prestasi akan segera diupdate.</p>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($prestasi->hasPages())
            <div class="mt-16 flex justify-center">
                <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100">
                    {{ $prestasi->links('pagination::tailwind') }}
                </div>
            </div>
        @endif

    </div>
</section>

@endsection