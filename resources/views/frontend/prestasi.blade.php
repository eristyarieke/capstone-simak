@extends('layouts.frontend')

@section('title', 'Prestasi Sekolah')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="py-24 bg-blue-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold">
            Prestasi Siswa & Sekolah
        </h1>
        <p class="text-blue-200 mt-3">
            Kebanggaan kami, bukti kualitas pendidikan
        </p>
    </div>
</section>

{{-- ================= LIST PRESTASI ================= --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($prestasi as $p)
                <div class="relative bg-white border border-gray-200 rounded-2xl p-6 text-center hover:shadow-xl hover:border-yellow-400 transition">

                    {{-- TAHUN --}}
                    @if($p->tahun)
                        <div class="absolute top-0 right-0 bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-bl-xl">
                            {{ $p->tahun }}
                        </div>
                    @endif

                    {{-- ICON --}}
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-yellow-50 border border-yellow-100 flex items-center justify-center text-yellow-500 text-4xl">
                        <i class="fas fa-trophy"></i>
                    </div>

                    {{-- JUDUL --}}
                    <h3 class="text-lg font-bold text-gray-800 mb-2">
                        {{ $p->judul ?? $p->nama_lomba ?? 'Prestasi Sekolah' }}
                    </h3>

                    {{-- JUARA --}}
                    @if($p->juara_ke || $p->tingkat)
                        <span class="inline-block bg-blue-600 text-white text-xs px-4 py-1 rounded-full mb-3">
                            {{ $p->juara_ke ?? 'Juara' }}
                            {{ $p->tingkat ? ' - ' . $p->tingkat : '' }}
                        </span>
                    @endif

                    {{-- KETERANGAN --}}
                    <p class="text-gray-500 text-sm leading-relaxed">
                        {{ $p->keterangan ?? 'Prestasi yang diraih oleh siswa dan sekolah dalam berbagai kompetisi.' }}
                    </p>

                    {{-- SISWA --}}
                    @if(!empty($p->nama_siswa))
                        <div class="mt-5 pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400 uppercase tracking-wide">
                                Pemenang
                            </p>
                            <p class="font-semibold text-gray-700">
                                {{ $p->nama_siswa }}
                            </p>
                        </div>
                    @endif

                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500 text-lg">
                        Belum ada data prestasi.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="mt-16 flex justify-center">
            {{ $prestasi->links('pagination::tailwind') }}
        </div>

    </div>
</section>

@endsection
