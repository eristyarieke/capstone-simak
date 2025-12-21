@extends('layouts.frontend')

@section('title', 'Hubungi Kami')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="py-24 bg-blue-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold">Hubungi Kami</h1>
        <p class="text-blue-200 mt-3">
            Kami siap melayani informasi yang Anda butuhkan
        </p>
    </div>
</section>

{{-- ================= KONTEN ================= --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="mb-12 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
                <p class="font-bold">Berhasil</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

            {{-- INFO KONTAK --}}
            <div>
                <h2 class="text-2xl font-bold text-blue-900 mb-8">
                    Informasi Sekolah
                </h2>

                <div class="space-y-6">

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Alamat</h4>
                            <p class="text-gray-600">
                                {{ $kontak->alamat ?? 'Alamat sekolah belum diisi.' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Telepon / WhatsApp</h4>
                            <p class="text-gray-600">
                                {{ $kontak->telepon ?? '-' }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- MAP --}}
                <div class="mt-10 h-64 rounded-2xl overflow-hidden border border-gray-200">
                    <iframe
                        src="{{ $kontak->maps_embed ?? 'https://www.google.com/maps?q=Surabaya&output=embed' }}"
                        class="w-full h-full border-0"
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            {{-- FORM PESAN --}}
            <div class="bg-gray-50 p-8 md:p-10 rounded-2xl border border-gray-200 shadow-sm">
                <h2 class="text-2xl font-bold text-blue-900 mb-2">
                    Kirim Pesan
                </h2>
                <p class="text-gray-500 mb-8">
                    Silakan tinggalkan pesan Anda.
                </p>

                <form action="{{ route('feedback.kirim') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="nama"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Pesan
                        </label>
                        <textarea
                            name="pesan"
                            rows="4"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3"></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-3 rounded-lg transition shadow-md hover:-translate-y-1">
                        Kirim Pesan
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
