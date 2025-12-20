@extends('layouts.frontend')

@section('title', 'Hubungi Kami')

@section('content')

{{-- PAGE HEADER --}}
<section class="bg-blue-800 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold">Hubungi Kami</h1>
        <p class="text-blue-200 mt-2">Kami siap melayani informasi yang Anda butuhkan</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        
        {{-- FLASH MESSAGE SUKSES --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded shadow-sm" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            
            {{-- INFO KONTAK --}}
            <div>
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Informasi Sekolah</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Alamat</h4>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $kontak->alamat ?? 'Jl. Kendangsari No. XX, Tenggilis Mejoyo, Surabaya, Jawa Timur 60292' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Telepon / WhatsApp</h4>
                            <p class="text-gray-600">{{ $kontak->telepon ?? '+62 812 3456 7890' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Email</h4>
                            <p class="text-gray-600">{{ $kontak->email ?? 'info@sdnkendangsari3.sch.id' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Embed Map (Contoh Google Maps) --}}
                <div class="mt-8 rounded-xl overflow-hidden shadow-lg h-64 border border-gray-200">
                    {{-- Ganti src iframe dengan link embed Google Maps lokasi sekolah Anda --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.382878297754!2d112.748392!3d-7.310839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd094396183%3A0x6e9a657c6032d849!2sSurabaya%2C%20Surabaya%20City%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1625633456789!5m2!1sen!2sid" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            {{-- FORM FEEDBACK --}}
            <div class="bg-gray-50 p-8 rounded-2xl border border-gray-200 shadow-sm">
                <h2 class="text-2xl font-bold text-blue-900 mb-2">Kirim Pesan</h2>
                <p class="text-gray-500 mb-6">Punya pertanyaan atau masukan? Silakan isi formulir di bawah ini.</p>

                <form action="{{ route('feedback.kirim') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition p-3 border" placeholder="Nama Anda">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" name="email" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition p-3 border" placeholder="email@contoh.com">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan Anda</label>
                            <textarea name="pesan" rows="4" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition p-3 border" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-800 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-900 transition duration-300 shadow-md transform hover:-translate-y-1">
                            Kirim Pesan <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection