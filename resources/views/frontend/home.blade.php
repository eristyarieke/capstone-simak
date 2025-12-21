@extends('layouts.frontend')

@section('title', 'Beranda')

{{-- ================= HERO / SLIDER ================= --}}
@section('hero')
@if($sliders->count())
<section class="relative h-[520px] overflow-hidden">
    <div class="swiper h-full">
        <div class="swiper-wrapper">

            @foreach($sliders as $slider)
            <div class="swiper-slide relative">
                <img src="{{ asset('storage/' . $slider->gambar) }}"
                     class="absolute inset-0 w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/50"></div>

                <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
                    <div class="max-w-3xl">
                        <h2 class="text-4xl md:text-5xl font-bold mb-4">
                            {{ $slider->judul }}
                        </h2>
                        <p class="text-lg md:text-xl text-gray-200">
                            {{ $slider->subjudul }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
@endsection


{{-- ================= CONTENT ================= --}}
@section('content')

{{-- SAMBUTAN KEPALA SEKOLAH --}}
<section>
    <div class="text-center mb-10">
        <h2 class="section-title">Sambutan Kepala Sekolah</h2>
        <div class="section-divider"></div>
    </div>

    <div class="bg-gray-50 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 shadow-sm border">

        {{-- FOTO --}}
        <div class="w-48 h-48 flex-shrink-0">
            @if($sambutan && $sambutan->foto)
                <img src="{{ asset('storage/' . $sambutan->foto) }}"
                     class="w-full h-full object-cover rounded-full border-4 border-white shadow-lg">
            @else
                <div class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-user text-4xl text-gray-500"></i>
                </div>
            @endif
        </div>

        {{-- TEKS --}}
        <div class="flex-1 text-center md:text-left">
            <h3 class="text-xl font-bold mb-2">
                {{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}
            </h3>

            <p class="text-gray-600 leading-relaxed mb-4 text-justify">
                {{ Str::limit($sambutan->isi_sambutan ?? '', 450) }}
            </p>

            <a href="{{ route('profil') }}" class="text-primary font-semibold hover:underline">
                Baca Selengkapnya →
            </a>
        </div>
    </div>
</section>

{{-- PENGUMUMAN --}}
<section class="bg-blue-50 rounded-2xl p-10">
    <h2 class="section-title uppercase tracking-wide mb-8">Pengumuman Terbaru</h2>

    <div class="grid md:grid-cols-2 gap-6">
        @forelse($pengumuman as $info)
            <div class="bg-white p-6 rounded-xl border-l-4 border-primary card-hover">
                <span class="text-xs text-gray-500 font-bold uppercase">
                    {{ \Carbon\Carbon::parse($info->tanggal)->format('d M Y') }}
                </span>
                <h3 class="text-lg font-bold mt-1 mb-2">{{ $info->judul }}</h3>
                <p class="text-sm text-gray-600">{{ Str::limit($info->isi, 120) }}</p>
            </div>
        @empty
            <div class="md:col-span-2 text-center text-gray-500">
                Belum ada pengumuman.
            </div>
        @endforelse
    </div>
</section>

{{-- STATISTIK --}}
<section>
    <h2 class="section-title">
        Tahun Ajaran <span class="text-secondary">{{ $tahun_ajaran ?? date('Y').'/'.(date('Y')+1) }}</span>
    </h2>
    <div class="section-divider"></div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach([
            ['icon'=>'user-graduate','label'=>'Siswa','value'=>$total_siswa ?? 0],
            ['icon'=>'chalkboard-teacher','label'=>'Guru & Staf','value'=>$total_guru ?? 0],
            ['icon'=>'school','label'=>'Kelas','value'=>$total_kelas ?? 0],
            ['icon'=>'trophy','label'=>'Mapel','value'=>$total_mapel ?? 0],
        ] as $item)
        <div class="bg-white rounded-xl p-6 text-center card-hover border">
            <i class="fas fa-{{ $item['icon'] }} text-4xl text-secondary mb-3"></i>
            <h3 class="text-3xl font-bold">{{ $item['value'] }}</h3>
            <p class="text-sm text-gray-500 uppercase mt-1">{{ $item['label'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ARTIKEL --}}
<section>
    <div class="flex justify-between items-end mb-10">
        <h2 class="section-title text-left">Kabar Sekolah Terbaru</h2>
        <a href="{{ route('artikel') }}" class="hidden md:block text-primary font-semibold hover:underline">
            Lihat Semua →
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach($artikelTerbaru as $artikel)
            <div class="bg-white rounded-xl overflow-hidden border card-hover flex flex-col">
                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" class="h-48 w-full object-cover">
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-bold mb-2">
                        <a href="{{ route('artikel.detail', $artikel->slug ?? $artikel->id) }}">
                            {{ Str::limit($artikel->judul, 60) }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ Str::limit(strip_tags($artikel->isi), 100) }}
                    </p>
                    <a href="{{ route('artikel.detail', $artikel->slug ?? $artikel->id) }}"
                       class="mt-auto text-primary font-semibold text-sm">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection
