@extends('layouts.frontend')

@section('title', 'Profil Sekolah')

@section('content')

{{-- SECTION HEADER: JUDUL PAGE (Sesuai Gambar) --}}
<section class="pt-16 pb-10 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Profile Sekolah</h1>
        {{-- Garis kecil di bawah judul --}}
        <div class="h-1 w-20 bg-black mx-auto rounded-full"></div>
    </div>
</section>

{{-- SECTION KONTEN UTAMA --}}
<section class="pb-20 bg-white">
    <div class="container mx-auto px-4">
        
        {{-- 1. BAGIAN PROFIL SEKOLAH (Card Abu-abu) --}}
        <div class="bg-gray-100 rounded-[30px] p-8 md:p-12 mb-20">
            <div class="flex flex-col md:flex-row items-center gap-10">
                
                {{-- Kiri: Teks Deskripsi --}}
                <div class="w-full md:w-2/3">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">SDN Kendangsari III</h2>
                    <div class="text-gray-600 leading-relaxed text-justify">
                        @if($profil)
                            {{-- Menampilkan deskripsi dari database --}}
                            {!! $profil->deskripsi !!}
                        @else
                            <p class="italic text-gray-500">Deskripsi profil sekolah belum diisi.</p>
                        @endif
                    </div>
                </div>

                {{-- Kanan: Foto Lingkaran Besar --}}
                <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                    <div class="w-64 h-64 md:w-72 md:h-72 bg-gray-300 rounded-full overflow-hidden shadow-lg border-4 border-white relative">
                        @if($profil && $profil->foto_gedung)
                            <img src="{{ asset('storage/' . $profil->foto_gedung) }}" class="w-full h-full object-cover">
                        @elseif($profil && $profil->logo)
                             <img src="{{ asset('storage/' . $profil->logo) }}" class="w-full h-full object-cover">
                        @else
                            {{-- Placeholder jika tidak ada foto --}}
                            <div class="flex items-center justify-center h-full bg-gray-200 text-gray-400">
                                <span class="text-sm">No Image</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        {{-- 2. BAGIAN VISI & MISI --}}
        <div class="mb-20">
            {{-- Judul Section --}}
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Visi & Misi</h2>
                <div class="h-1 w-16 bg-black mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Kolom Kiri: VISI (Kotak-kotak) --}}
                <div class="flex flex-col gap-4">
                    @forelse($visi as $v)
                        <div class="bg-gray-200 p-6 rounded-xl flex items-center justify-center text-center h-full min-h-[100px]">
                            {{-- Menggunakan nama kolom sesuai model: isi_visi --}}
                            <p class="font-semibold text-gray-800 text-lg">"{{ $v->isi_visi }}"</p>
                        </div>
                    @empty
                        <div class="bg-gray-200 p-6 rounded-xl text-center text-gray-500">
                            Belum ada data Visi.
                        </div>
                    @endforelse
                    
                    {{-- Placeholder visual agar terlihat penuh jika data sedikit (Opsional, sesuai gambar ada 2 kotak) --}}
                    @if($visi->count() < 2)
                         <div class="bg-gray-200 p-6 rounded-xl h-40 hidden md:block"></div>
                    @endif
                </div>

                {{-- Kolom Kanan: MISI (Satu Kotak Besar) --}}
                <div class="bg-gray-200 p-8 rounded-xl h-full">
                    <ul class="space-y-4">
                        @forelse($misi as $m)
                            <li class="flex items-start gap-3">
                                {{-- Bullet point custom --}}
                                <div class="mt-2 w-2 h-2 bg-gray-800 rounded-full shrink-0"></div>
                                {{-- Menggunakan nama kolom sesuai model: isi_misi --}}
                                <span class="text-gray-800 leading-relaxed">{{ $m->isi_misi }}</span>
                            </li>
                        @empty
                            <li class="text-gray-500 italic">Belum ada data Misi.</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>

        {{-- 3. BAGIAN GALERI --}}
        <div>
            {{-- Judul Section --}}
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Galeri</h2>
                <div class="h-1 w-16 bg-black mx-auto rounded-full"></div>
            </div>

            {{-- Grid 4 Kolom --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @forelse($galeri as $item)
                    {{-- Kotak Gambar --}}
                    <div class="aspect-square bg-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        {{-- Pastikan kolom di database Galeri namanya 'file_foto' atau 'foto' atau 'gambar' --}}
                        {{-- Sesuaikan properti di bawah ini dengan nama kolom tabel Galeri Anda --}}
                        <img src="{{ asset('storage/' . ($item->file_foto ?? $item->gambar ?? $item->foto)) }}" 
                             class="w-full h-full object-cover hover:scale-105 transition duration-500" 
                             alt="Galeri Sekolah">
                    </div>
                @empty
                    {{-- Tampilan Placeholder Kosong Sesuai Gambar (4 kotak abu-abu) --}}
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                @endforelse
            </div>
        </div>

    </div>
</section>
@endsection