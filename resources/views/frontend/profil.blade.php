@extends('layouts.frontend')

@section('title', 'Profil Sekolah')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
            Profil Sekolah
        </h1>
        <div class="h-1 w-20 bg-black mx-auto rounded-full"></div>
    </div>
</section>

{{-- ================= KONTEN ================= --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">

        {{-- ========= PROFIL SEKOLAH ========= --}}
        <div class="bg-gray-100 rounded-[30px] p-8 md:p-12 mb-20">
            <div class="flex flex-col md:flex-row items-center gap-10">

                {{-- DESKRIPSI --}}
                <div class="w-full md:w-2/3">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        {{ $profil->nama_sekolah ?? 'Nama Sekolah' }}
                    </h2>

                    <div class="text-gray-600 leading-relaxed text-justify">
                        @if($profil && $profil->deskripsi)
                            {!! $profil->deskripsi !!}
                        @else
                            <p class="italic text-gray-500">
                                Deskripsi profil sekolah belum diisi.
                            </p>
                        @endif
                    </div>
                </div>

                {{-- FOTO --}}
                <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                    <div class="w-64 h-64 md:w-72 md:h-72 rounded-full overflow-hidden shadow-lg border-4 border-white bg-gray-300">
                        @if($profil && $profil->foto_gedung)
                            <img src="{{ asset('storage/' . $profil->foto_gedung) }}"
                                 class="w-full h-full object-cover">
                        @elseif($profil && $profil->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                No Image
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        {{-- ========= VISI & MISI ========= --}}
        <section class="py-24 bg-gray-50 border-t border-gray-200">
        <div class="mb-20">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Visi & Misi</h2>
                <div class="h-1 w-16 bg-black mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- VISI --}}
                <div class="flex flex-col gap-4">
                    @forelse($visi ?? [] as $v)
                        <div class="bg-gray-200 p-6 rounded-xl text-center min-h-[100px] flex items-center justify-center">
                            <p class="font-semibold text-gray-800 text-lg">
                                "{{ $v->isi_visi }}"
                            </p>
                        </div>
                    @empty
                        <div class="bg-gray-200 p-6 rounded-xl text-center text-gray-500">
                            Belum ada data visi.
                        </div>
                    @endforelse
                </div>

                {{-- MISI --}}
                <div class="bg-gray-200 p-8 rounded-xl">
                    <ul class="space-y-4">
                        @forelse($misi ?? [] as $m)
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-2 h-2 bg-gray-800 rounded-full shrink-0"></span>
                                <span class="text-gray-800 leading-relaxed">
                                    {{ $m->isi_misi }}
                                </span>
                            </li>
                        @empty
                            <li class="italic text-gray-500">
                                Belum ada data misi.
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
</section>

        {{-- ========= GALERI ========= --}}
    <section class="py-24 bg-white">
        <div>
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Galeri</h2>
                <div class="h-1 w-16 bg-black mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @forelse($galeri ?? [] as $item)
                    <div class="aspect-square bg-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('storage/' . $item->foto) }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-500">
                    </div>
                @empty
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                    <div class="aspect-square bg-gray-100 rounded-xl"></div>
                @endforelse
            </div>
        </div>
    </section>

    </div>
</section>
@endsection
