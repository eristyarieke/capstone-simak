@extends('layouts.frontend')

@section('title', 'Profil Sekolah')

@section('content')

{{-- ================= HEADER PAGE ================= --}}
<section class="bg-slate-50 py-20 border-b border-slate-200">
    <div class="container mx-auto px-4 text-center">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block animate-fade-in-up">Tentang Kami</span>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 animate-fade-in-up delay-100">
            Profil Sekolah
        </h1>
        <p class="text-slate-500 max-w-2xl mx-auto text-lg animate-fade-in-up delay-200">
            Mengenal lebih dekat sejarah, visi, misi, dan lingkungan belajar di sekolah kami.
        </p>
    </div>
</section>

{{-- ================= KONTEN UTAMA ================= --}}
<section class="py-20 bg-white relative overflow-hidden">
    
    {{-- Decorative Background --}}
    <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50 z-0 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-96 h-96 bg-yellow-50 rounded-full blur-3xl opacity-50 z-0 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">

        {{-- 1. SAMBUTAN KEPALA SEKOLAH (FULL CONTENT) --}}
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl shadow-slate-200/50 flex flex-col lg:flex-row items-start gap-10 lg:gap-16 border border-slate-100 mb-24">

            {{-- FOTO (Sticky di Desktop agar tetap terlihat saat scroll teks panjang) --}}
            <div class="w-full lg:w-1/3 lg:sticky lg:top-24 flex flex-col items-center text-center">
                <div class="relative group">
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
                    </div>
                </div>
                
                <div class="mt-6">
                    <h3 class="text-xl font-bold text-slate-800">
                        {{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}
                    </h3>
                    <span class="inline-block mt-2 px-4 py-1 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full">
                        Kepala Sekolah
                    </span>
                </div>
            </div>

            {{-- TEKS SAMBUTAN FULL --}}
            <div class="w-full lg:w-2/3">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h4 class="text-blue-600 font-bold uppercase tracking-wider text-sm mb-2">Sambutan</h4>
                    <h2 class="text-3xl font-bold text-slate-800">Assalamu’alaikum Warahmatullahi Wabarakatuh</h2>
                </div>

                {{-- Render HTML Full --}}
                <div class="prose prose-lg prose-slate text-slate-600 leading-relaxed max-w-none">
                    @if($sambutan && $sambutan->isi_sambutan)
                        {!! $sambutan->isi_sambutan !!}
                    @else
                        <p>Isi sambutan belum tersedia.</p>
                    @endif
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <p class="text-slate-500 font-medium italic">
                        "Terima kasih atas kepercayaan Anda kepada sekolah kami."
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. IDENTITAS SEKOLAH --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100 mb-24">
            <div class="flex flex-col lg:flex-row">
                
                {{-- FOTO GEDUNG --}}
                <div class="w-full lg:w-5/12 relative min-h-[300px] lg:min-h-full group">
                    @if($profil && $profil->foto_gedung)
                        <img src="{{ asset('storage/' . $profil->foto_gedung) }}"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @elseif($profil && $profil->logo)
                        <div class="absolute inset-0 bg-slate-50 flex items-center justify-center p-10">
                             <img src="{{ asset('storage/' . $profil->logo) }}" class="w-1/2 opacity-20 grayscale">
                        </div>
                    @else
                        <div class="absolute inset-0 bg-slate-200 flex items-center justify-center text-slate-400">
                            <i class="fa-regular fa-image text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent lg:bg-gradient-to-r lg:from-transparent lg:to-black/5"></div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="w-full lg:w-7/12 p-8 md:p-12 lg:p-16 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-slate-800 mb-6 relative inline-block">
                        {{ $profil->nama_sekolah ?? 'Tentang Sekolah' }}
                        <span class="absolute -bottom-2 left-0 w-12 h-1 bg-blue-600 rounded-full"></span>
                    </h2>

                    <div class="text-slate-600 leading-loose text-justify space-y-4 font-light text-lg">
                        @if($profil && $profil->deskripsi)
                            {!! $profil->deskripsi !!}
                        @else
                            <div class="p-6 bg-slate-50 border border-dashed border-slate-300 rounded-xl text-center text-slate-400">
                                Deskripsi profil sekolah belum diisi.
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        {{-- 3. VISI & MISI --}}
        <div class="grid md:grid-cols-2 gap-8 lg:gap-12 mb-24">

            {{-- VISI (Card Biru) --}}
            <div class="bg-blue-600 rounded-3xl p-8 md:p-12 text-white shadow-lg shadow-blue-600/20 relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 opacity-10 transform group-hover:scale-110 transition-transform duration-500 rotate-12">
                    <i class="fa-solid fa-bullseye text-9xl"></i>
                </div>
                
                <h3 class="text-2xl font-bold mb-8 flex items-center gap-3 relative z-10">
                    <span class="bg-white/20 p-2 rounded-xl backdrop-blur-sm"><i class="fa-solid fa-eye"></i></span> 
                    Visi Sekolah
                </h3>

                <div class="space-y-6 relative z-10">
                    @forelse($visi ?? [] as $v)
                        <div class="text-center">
                            <i class="fa-solid fa-quote-left text-blue-300 text-2xl mb-2 block opacity-50"></i>
                            <p class="text-xl md:text-2xl font-medium leading-relaxed italic">
                                "{{ $v->isi_visi }}"
                            </p>
                            <i class="fa-solid fa-quote-right text-blue-300 text-2xl mt-2 block opacity-50"></i>
                        </div>
                    @empty
                        <p class="text-blue-200 text-center italic border border-blue-400/30 p-4 rounded-xl">Belum ada data visi.</p>
                    @endforelse
                </div>
            </div>

            {{-- MISI (Card Putih) --}}
            <div class="bg-white border border-slate-200 rounded-3xl p-8 md:p-12 shadow-xl shadow-slate-200/50 flex flex-col">
                <h3 class="text-2xl font-bold mb-8 text-slate-800 flex items-center gap-3">
                    <span class="bg-blue-50 text-blue-600 p-2 rounded-xl"><i class="fa-solid fa-list-check"></i></span>
                    Misi Sekolah
                </h3>

                <ul class="space-y-4 flex-1">
                    @forelse($misi ?? [] as $m)
                        <li class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:border-blue-200 hover:bg-blue-50/50 transition-colors group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs group-hover:bg-green-500 group-hover:text-white transition-colors">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </div>
                            <span class="text-slate-600 leading-relaxed font-medium group-hover:text-slate-800">
                                {{ $m->isi_misi }}
                            </span>
                        </li>
                    @empty
                        <li class="text-slate-400 italic text-center py-8 border border-dashed rounded-xl bg-slate-50">
                            Belum ada data misi.
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>

        {{-- 4. GALERI FASILITAS --}}
        <div>
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800">Galeri Fasilitas</h2>
                    <p class="text-slate-500 mt-2">Potret lingkungan dan fasilitas penunjang belajar.</p>
                </div>
                <div class="h-1 w-20 bg-blue-600 rounded-full md:hidden"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @forelse($galeri ?? [] as $item)
                    <div class="group relative aspect-square rounded-2xl overflow-hidden cursor-pointer shadow-md bg-slate-100 border border-slate-200">
                        <img src="{{ asset('storage/' . $item->foto) }}"
                             alt="{{ $item->judul ?? 'Fasilitas Sekolah' }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-blue-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center text-white p-4 text-center">
                            <i class="fa-solid fa-magnifying-glass-plus text-3xl mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"></i>
                            @if($item->judul)
                                <span class="text-sm font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">{{ $item->judul }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    @for($i=0; $i<4; $i++)
                        <div class="aspect-square bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-300 gap-2">
                            <i class="fa-regular fa-image text-3xl"></i>
                            <span class="text-xs">Foto Kosong</span>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>

    </div>
</section>
@endsection