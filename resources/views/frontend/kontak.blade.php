@extends('layouts.frontend')

@section('title', 'Hubungi Kami')

@section('content')

{{-- ================= PAGE HEADER ================= --}}
<section class="bg-slate-50 py-20 border-b border-slate-200">
    <div class="container mx-auto px-4 text-center">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block animate-fade-in-up">Layanan Informasi</span>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 animate-fade-in-up delay-100">
            Hubungi Kami
        </h1>
        <p class="text-slate-500 text-lg max-w-2xl mx-auto animate-fade-in-up delay-200">
            Punya pertanyaan seputar pendaftaran atau kegiatan sekolah? Kami siap membantu Anda.
        </p>
    </div>
</section>

{{-- ================= KONTEN UTAMA ================= --}}
<section class="py-20 bg-white relative overflow-hidden">
    
    {{-- Decorative Background --}}
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-96 h-96 bg-yellow-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">

            {{-- KOLOM KIRI: INFO & MAPS --}}
            <div class="space-y-8">
                
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                        <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                        Kantor Sekolah
                    </h2>

                    {{-- Card: Alamat --}}
                    <div class="flex items-start gap-4 p-6 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 flex-shrink-0 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-lg mb-1">Alamat</h4>
                            <p class="text-slate-500 leading-relaxed">
                                {{ $kontak->alamat ?? 'Alamat sekolah belum diisi.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Card: Telepon --}}
                    <div class="flex items-start gap-4 p-6 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 flex-shrink-0 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-lg mb-1">Telepon / WhatsApp</h4>
                            <p class="text-slate-500">
                                {{ $kontak->telepon ?? 'Nomor belum tersedia' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- MAPS --}}
                <div class="rounded-3xl overflow-hidden shadow-lg border-4 border-white h-80 relative bg-slate-200 group">
                    <iframe
                        src="{{ $kontak->maps_embed ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2265.017434645732!2d112.7637264905573!3d-7.318417376743778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fae262887a61%3A0x1ba22f023d4d8ac3!2sSDN%20Kendangsari%20III!5e0!3m2!1sid!2sid!4v1767531830984!5m2!1sid!2sid' }}"
                        class="w-full h-full border-0 filter grayscale group-hover:grayscale-0 transition duration-700"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                    {{-- Overlay Label --}}
                    <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg text-xs font-bold shadow-sm pointer-events-none text-slate-700">
                        <i class="fa-solid fa-map-pin text-red-500 mr-1"></i> Lokasi Kami
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: FORMULIR --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-10 relative">
                
                {{-- Form Header --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Kirim Pesan</h2>
                    <p class="text-slate-500 text-sm">Masukan, saran, atau pertanyaan dapat dikirimkan melalui formulir di bawah ini.</p>
                </div>

                {{-- FLASH MESSAGE --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 animate-pulse">
                        <i class="fa-regular fa-circle-check text-xl"></i>
                        <div>
                            <p class="font-bold text-sm">Pesan Terkirim!</p>
                            <p class="text-xs">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('feedback.kirim') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-slate-400">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input type="text" name="nama" required
                                placeholder="Masukkan nama Anda"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-slate-700 placeholder:text-slate-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Pesan Anda</label>
                        <div class="relative">
                            <textarea name="pesan" rows="5" required
                                placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."
                                class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-slate-700 placeholder:text-slate-400 resize-none"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                        <span>Kirim Sekarang</span>
                        <i class="fa-solid fa-paper-plane text-sm group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>

            </div>

        </div>
    </div>
</section>
@endsection