@extends('layouts.frontend')

@section('title', 'Beranda')

{{-- ================= HERO / SLIDER ================= --}}
@section('hero')
@if($sliders->count())
<section class="relative h-[600px] w-full overflow-hidden group">
    <div class="swiper h-full w-full">
        <div class="swiper-wrapper">

            @foreach($sliders as $slider)
            <div class="swiper-slide relative">
                {{-- Image with slight zoom effect on hover (optional via CSS, but keeps it simple here) --}}
                <img src="{{ asset('storage/' . $slider->gambar) }}"
                     class="absolute inset-0 w-full h-full object-cover">

                {{-- Modern Gradient Overlay (Bottom-heavy for text readability) --}}
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>

                <div class="relative z-10 h-full flex items-end pb-20 md:pb-24 justify-center text-center text-white px-4">
                    <div class="max-w-4xl space-y-4 animate-fade-in-up">
                        <h2 class="text-4xl md:text-6xl text-slate-200 font-bold tracking-tight drop-shadow-md leading-tight">
                            {{ $slider->judul }}
                        </h2>
                        <p class="text-lg md:text-xl text-slate-200 font-light max-w-2xl mx-auto">
                            {{ $slider->subjudul }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        {{-- Optional: Add Swiper Navigation Arrows here if needed --}}
    </div>
</section>
@endif
@endsection


{{-- ================= CONTENT ================= --}}
@section('content')

{{-- 1. SAMBUTAN KEPALA SEKOLAH --}}
<section class="mb-20">
    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl shadow-slate-200/50 flex flex-col md:flex-row items-center gap-10 md:gap-16 border border-slate-100">

        {{-- FOTO --}}
        <div class="relative group w-full md:w-auto flex justify-center">
            <div class="absolute inset-0 bg-blue-600 rounded-full blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
            <div class="w-56 h-56 md:w-64 md:h-64 relative flex-shrink-0">
                @if($sambutan && $sambutan->foto)
                    <img src="{{ asset('storage/' . $sambutan->foto) }}"
                         class="w-full h-full object-cover rounded-full border-[6px] border-white shadow-lg relative z-10">
                @else
                    <div class="w-full h-full rounded-full bg-slate-200 flex items-center justify-center border-[6px] border-white shadow-lg relative z-10">
                        <i class="fas fa-user text-6xl text-slate-400"></i>
                    </div>
                @endif
                {{-- Decorative badge --}}
                <div class="absolute bottom-2 right-2 z-20 bg-blue-600 text-white text-xs px-3 py-1 rounded-full shadow-md">
                    Kepala Sekolah
                </div>
            </div>
        </div>

        {{-- TEKS --}}
        <div class="flex-1 text-center md:text-left space-y-4">
            <div>
                <h4 class="text-blue-600 font-semibold uppercase tracking-wider text-sm mb-1">Sambutan</h4>
                <h3 class="text-3xl md:text-4xl font-bold text-slate-800">
                    {{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}
                </h3>
            </div>

            <p class="text-slate-600 leading-relaxed text-lg font-light">
                {{ Str::limit($sambutan->isi_sambutan ?? '') }}
            </p>

            <div class="pt-4">
                <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-800 transition-colors group">
                    Baca Selengkapnya
                    <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- 2. PENGUMUMAN --}}
<section class="mb-20">
    <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Pengumuman</h2>
            <p class="text-slate-500 mt-1">Informasi terbaru untuk siswa dan wali murid</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        @forelse($pengumuman as $info)
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                {{-- Decorative Accent --}}
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-blue-500 group-hover:bg-blue-600 transition-colors"></div>
                
                <div class="flex items-start justify-between mb-3">
                    <span class="bg-blue-50 text-blue-600 text-xs font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        {{ \Carbon\Carbon::parse($info->tanggal)->format('d M Y') }}
                    </span>
                    <i class="fa-regular fa-bell text-slate-300 group-hover:text-blue-500 transition-colors"></i>
                </div>

                <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-blue-700 transition-colors line-clamp-2">
                    {{ $info->judul }}
                </h3>
                <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">
                    {{ Str::limit($info->isi, 120) }}
                </p>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-slate-300">
                <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3"></i>
                <p class="text-slate-500">Belum ada pengumuman saat ini.</p>
            </div>
        @endforelse
    </div>
</section>

{{-- 3. STATISTIK (Full Width Style inside container) --}}
<section class="mb-20">
    <div class="bg-blue-600 rounded-3xl p-8 md:p-12 text-white relative overflow-hidden shadow-2xl shadow-blue-900/20">
        {{-- Background Pattern --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 bg-black/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold">Data Statistik Sekolah</h2>
            <p class="text-blue-100 mt-2">Tahun Ajaran {{ $tahun_ajaran ?? date('Y').'/'.(date('Y')+1) }}</p>
        </div>

        <div class="relative z-10 grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach([
                ['icon'=>'user-graduate','label'=>'Siswa','value'=>$total_siswa ?? 0],
                ['icon'=>'chalkboard-user','label'=>'Guru & Staf','value'=>$total_guru ?? 0], // Icon updated to modern FA
                ['icon'=>'school','label'=>'Kelas','value'=>$total_kelas ?? 0],
                ['icon'=>'book-open','label'=>'Mapel','value'=>$total_mapel ?? 0], // Icon updated
            ] as $item)
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-white/20 rounded-2xl flex items-center justify-center mb-4 backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-{{ $item['icon'] }} text-3xl text-white"></i>
                </div>
                <h3 class="text-4xl font-bold mb-1">{{ $item['value'] }}</h3>
                <p class="text-sm text-blue-100 font-medium uppercase tracking-wider">{{ $item['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 4. ARTIKEL --}}
<section class="mb-12">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Kabar Sekolah</h2>
            <p class="text-slate-500 mt-1">Berita dan artikel kegiatan terbaru</p>
        </div>
        <a href="{{ route('artikel') }}" class="hidden md:flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">
            Lihat Semua <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach($artikelTerbaru as $artikel)
            <article class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group h-full">
                
                {{-- Image --}}
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                    
                    {{-- Category/Date Badge if needed, currently showing date on bottom --}}
                </div>

                {{-- Content --}}
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ $artikel->created_at ? $artikel->created_at->format('d M Y') : '-' }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 mb-3 leading-snug group-hover:text-blue-600 transition-colors">
                        <a href="{{ route('artikel.detail', $artikel->slug ?? $artikel->id) }}">
                            {{ Str::limit($artikel->judul, 60) }}
                        </a>
                    </h3>
                    
                    <p class="text-sm text-slate-500 mb-4 line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($artikel->isi), 100) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <a href="{{ route('artikel.detail', $artikel->slug ?? $artikel->id) }}"
                           class="text-blue-600 font-semibold text-sm hover:underline">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    {{-- Mobile View All Button --}}
    <div class="mt-8 text-center md:hidden">
        <a href="{{ route('artikel') }}" class="inline-block px-6 py-3 bg-white border border-slate-300 rounded-full text-slate-700 font-medium text-sm hover:bg-slate-50">
            Lihat Semua Berita
        </a>
    </div>
</section>

@endsection