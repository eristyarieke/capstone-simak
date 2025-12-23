<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - SDN Kendangsari III</title>

    {{-- Font: Poppins is excellent, keeping it --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tailwind --}}
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    
    {{-- Custom Style untuk animasi underline menu --}}
    <style>
        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #2563EB; /* Blue-600 */
            transition: width .3s;
            margin-top: 2px;
        }
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }
    </style>
</head>

{{-- Menggunakan bg-slate-50 agar lebih sejuk dibanding gray-50 --}}
<body class="bg-slate-50 text-slate-700 flex flex-col min-h-screen font-poppins selection:bg-blue-200 selection:text-blue-900">

{{-- ================= NAVBAR (MODERN GLASSMORPHISM) ================= --}}
{{-- Ubahan: Background putih transparan dengan blur, border bawah halus, dan shadow tipis --}}
<nav class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-200/60 shadow-sm h-20">
    <div class="container mx-auto px-4 h-full flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            {{-- Efek hover halus pada logo --}}
            <img src="{{ asset('images/logosekolah.png') }}" class="w-12 h-12 transition-transform duration-300 group-hover:scale-105 drop-shadow-sm">
            <div class="leading-tight">
                {{-- Warna teks disesuaikan dengan background putih --}}
                <h1 class="font-bold text-lg text-slate-800 tracking-tight group-hover:text-blue-700 transition-colors">SDN Kendangsari III</h1>
                <p class="text-xs text-slate-500 font-medium">Surabaya - Jawa Timur</p>
            </div>
        </a>

        {{-- Menu --}}
        @php
            $menu = [
                'home'     => 'Beranda',
                'profil'   => 'Profil',
                'kegiatan' => 'Kegiatan',
                'prestasi' => 'Prestasi',
                'artikel'  => 'Artikel',
                'kontak'   => 'Kontak',
            ];
        @endphp

        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            @foreach($menu as $route => $label)
                <a href="{{ route($route) }}"
                   class="nav-link relative py-1 transition-colors duration-300
                   {{ request()->routeIs($route) ? 'text-blue-700 font-semibold active' : 'text-slate-600 hover:text-blue-600' }}">
                    {{ $label }}
                </a>
            @endforeach
            
            {{-- Opsional: Tombol CTA kecil untuk PPDB atau Login (Bisa dihapus jika tidak perlu) --}}
            {{-- <a href="#" class="px-5 py-2 bg-blue-600 text-white rounded-full text-xs font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">PPDB</a> --}}
        </div>
    </div>
</nav>

{{-- ================= MAIN ================= --}}
{{-- Ubahan: Padding top disesuaikan dengan tinggi navbar baru (h-20 = 5rem/80px) --}}
<main class="flex-grow pt-20">

    {{-- HERO --}}
    @yield('hero')

    {{-- CONTENT --}}
    <section class="container mx-auto px-4 w-full my-12">
        @yield('content')
    </section>

</main>

{{-- ================= FOOTER ================= --}}
{{-- Ubahan: Warna bg-slate-900 (lebih modern dari hitam pekat) & penataan spacing --}}
<footer class="bg-slate-900 text-slate-300 border-t-4 border-blue-600">

    <div class="container mx-auto px-4 py-16 grid gap-12 md:grid-cols-3">

        {{-- PROFIL --}}
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                {{-- Background logo di footer dibuat transparan/putih tipis --}}
                <div class="bg-white/10 p-2 rounded-full backdrop-blur-sm">
                    <img src="{{ asset('images/logosekolah.png') }}" class="w-12 h-12">
                </div>
                <div>
                    <h3 class="font-bold text-xl text-white">SDN Kendangsari III</h3>
                    <p class="text-xs text-slate-400">Mewujudkan Generasi Cerdas & Berkarakter</p>
                </div>
            </div>

            <p class="text-sm text-slate-400 leading-relaxed pr-4">
                Jl. Raya Tenggilis Mejoyo No. 3, Kali Rungkut, Kec. Rungkut, <br>
                Kota Surabaya, Jawa Timur 60293
            </p>
        </div>

        {{-- MENU --}}
        <div>
            <h3 class="font-bold text-lg text-white mb-6 relative inline-block">
                Menu Utama
                <span class="absolute -bottom-2 left-0 w-1/2 h-1 bg-blue-500 rounded-full"></span>
            </h3>
            <ul class="space-y-3 text-sm">
                @foreach($menu as $route => $label)
                    <li>
                        <a href="{{ route($route) }}" class="hover:text-blue-400 hover:pl-2 transition-all duration-300 flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-blue-600"></i> {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- KONTAK --}}
        <div>
            <h3 class="font-bold text-lg text-white mb-6 relative inline-block">
                Hubungi Kami
                <span class="absolute -bottom-2 left-0 w-1/2 h-1 bg-blue-500 rounded-full"></span>
            </h3>
            <ul class="space-y-4 text-sm text-slate-400">
                <li class="flex gap-4 items-center group">
                    <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    <span class="group-hover:text-white transition-colors">@Kendangsari_SDN</span>
                </li>
                <li class="flex gap-4 items-center group">
                    <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                    <span class="group-hover:text-white transition-colors">@Kendangsari_SDN</span>
                </li>
                <li class="flex gap-4 items-center group">
                    <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <span class="group-hover:text-white transition-colors">+62 8xx xxxx xxxx</span>
                </li>
                <li class="flex gap-4 items-center group">
                    <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <span class="group-hover:text-white transition-colors">www.sdnkendangsari.sch.id</span>
                </li>
            </ul>
        </div>

    </div>

    <div class="bg-slate-950 py-6">
        <div class="container mx-auto px-4 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} SDN Kendangsari III — <span class="text-slate-400">Capstone Project</span>
        </div>
    </div>
</footer>

{{-- ================= SCRIPT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper', {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        effect: 'fade',
        fadeEffect: { crossFade: true },
        speed: 1000,
    });

    // Opsional: Script untuk mengubah style navbar saat di-scroll
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('shadow-md', 'bg-white/95');
            nav.classList.remove('bg-white/80', 'shadow-sm');
        } else {
            nav.classList.remove('shadow-md', 'bg-white/95');
            nav.classList.add('bg-white/80', 'shadow-sm');
        }
    });
</script>

</body>
</html>