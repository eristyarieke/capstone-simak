<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SDN Kendangsari III</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="font-poppins antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-800 font-bold">
                    {{-- Ganti src dengan logo sekolah dari database jika ada --}}
                    <img src="{{ asset('logo-placeholder.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                </div>
                <div class="leading-tight">
                    <h2 class="font-bold text-lg tracking-wide text-white">SDN KENDANGSARI III</h1>
                    <p class="text-xs text-blue-200">Surabaya - Jawa Timur</p>
                </div>
            </a>

            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-yellow-400 transition {{ request()->routeIs('home') ? 'text-yellow-400 font-bold' : '' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="hover:text-yellow-400 transition {{ request()->routeIs('profil') ? 'text-yellow-400 font-bold' : '' }}">Profil Sekolah</a>
                <a href="{{ route('kegiatan') }}" class="hover:text-yellow-400 transition {{ request()->routeIs('kegiatan') ? 'text-yellow-400 font-bold' : '' }}">Kegiatan</a>
                <a href="{{ route('prestasi') }}" class="hover:text-yellow-400 transition {{ request()->routeIs('prestasi') ? 'text-yellow-400 font-bold' : '' }}">Prestasi</a>
                <a href="{{ route('artikel') }}" class="hover:text-yellow-400 transition {{ request()->routeIs('artikel') ? 'text-yellow-400 font-bold' : '' }}">Artikel</a>
                <a href="{{ route('kontak') }}" class="hover:text-yellow-400 transition {{ request()->routeIs('kontak') ? 'text-yellow-400 font-bold' : '' }}">Kontak</a>
            </div>

            <button class="md:hidden text-2xl focus:outline-none">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </nav>

    {{-- ================= SLIDER SECTION ================= --}}
<section class="relative bg-gray-200 h-[500px] flex items-center overflow-hidden">
    @if(isset($sliders) && $sliders->count() > 0)
        <div class="absolute inset-0">
             <img src="{{ asset('storage/' . $sliders->first()->gambar) }}" class="w-full h-full object-cover">
             <div class="absolute inset-0 bg-black/40"></div>
        </div>
        <div class="relative container mx-auto px-4 text-center text-white z-10">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">{{ $sliders->first()->judul }}</h2>
            <p class="text-lg md:text-xl opacity-90">{{ $sliders->first()->subjudul }}</p>
        </div>
    @else
        {{-- Placeholder Default --}}
        <div class="absolute inset-0 bg-sidebar"></div>
        <div class="relative container mx-auto px-4 text-center text-white z-10">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di SDN Kendangsari III</h2>
            <p class="text-lg">Mewujudkan Generasi Cerdas, Berkarakter, dan Berprestasi</p>
        </div>
    @endif
    
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <span class="w-3 h-3 bg-white rounded-full"></span>
        <span class="w-3 h-3 bg-white/50 rounded-full"></span>
        <span class="w-3 h-3 bg-white/50 rounded-full"></span>
    </div>
</section>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-black text-white pt-12 pb-6">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            
            <div class="flex flex-col gap-4">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                    <img src="{{ asset('logo-placeholder.png') }}" class="w-12">
                </div>
                <h3 class="text-xl font-bold text-white">SDN Kendangsari III</h3>
                <p class="text-gray-400 text-sm">Surabaya - Jawa Timur</p>
                <div class="mt-2">
                    <h4 class="font-bold mb-1 text-white">Alamat Lengkap :</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Jl. Kendangsari No. XX, Kec. Tenggilis Mejoyo,<br>
                        Kota Surabaya, Jawa Timur 60292
                    </p>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4 text-white">Menu Lainnya :</h3>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition">Beranda</a></li>
                    <li><a href="{{ route('profil') }}" class="hover:text-blue-400 transition">Profil Sekolah</a></li>
                    <li><a href="{{ route('kegiatan') }}" class="hover:text-blue-400 transition">Kegiatan</a></li>
                    <li><a href="{{ route('prestasi') }}" class="hover:text-blue-400 transition">Prestasi</a></li>
                    <li><a href="{{ route('artikel') }}" class="hover:text-blue-400 transition">Artikel</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4 text-white">Hubungi Kami :</h3>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li class="flex items-center gap-3">
                        <i class="fa-brands fa-instagram text-xl"></i> 
                        <span>@Kendangsari_SDN</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-brands fa-youtube text-xl"></i> 
                        <span>SDN Kendangsari Official</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-globe text-xl"></i> 
                        <span>www.sdnkendangsari.sch.id</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-xl"></i> 
                        <span>+62 812 3456 7890</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-6 text-center">
            <p class="text-gray-500 text-xs">
                Copyright &copy; Capstone Project - SDN Kendangsari III {{ date('Y') }}
            </p>
        </div>
    </footer>

</body>
</html>