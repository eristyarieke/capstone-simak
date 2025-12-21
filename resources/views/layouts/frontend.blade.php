<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - SDN Kendangsari III</title>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tailwind --}}
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

{{-- ================= NAVBAR ================= --}}
<nav class="bg-blue-800 text-white sticky top-0 z-50 shadow">
    <div class="container mx-auto px-4 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('logo-placeholder.png') }}" class="w-10 h-10">
            <div class="leading-tight">
                <h1 class="font-semibold text-base">SDN Kendangsari III</h1>
                <p class="text-xs text-blue-200">Surabaya - Jawa Timur</p>
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

        <div class="hidden md:flex items-center gap-6 text-sm font-medium">
            @foreach($menu as $route => $label)
                <a href="{{ route($route) }}"
                   class="transition hover:text-yellow-400
                   {{ request()->routeIs($route) ? 'text-yellow-400 font-semibold' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

{{-- ================= MAIN ================= --}}
<main class="flex-grow">

    {{-- HERO --}}
    @yield('hero')

    {{-- CONTENT --}}
    <section class="container mx-auto px-4 space-y-24">
        @yield('content')
    </section>

</main>

{{-- ================= FOOTER ================= --}}
<footer class="bg-black text-white">

    <div class="container mx-auto px-4 py-20 grid gap-12 md:grid-cols-3">

        {{-- PROFIL --}}
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-gray-700"></div>
                <div>
                    <h3 class="font-semibold text-lg">SDN Kendangsari III</h3>
                    <p class="text-xs text-gray-400">Surabaya - Jawa Timur</p>
                </div>
            </div>

            <p class="text-sm text-gray-400 leading-relaxed">
                Jl. Kendangsari No. XX<br>
                Kota Surabaya, Jawa Timur
            </p>
        </div>

        {{-- MENU --}}
        <div>
            <h3 class="font-semibold text-lg mb-4">Menu</h3>
            <ul class="space-y-2 text-sm text-gray-400">
                @foreach($menu as $route => $label)
                    <li>
                        <a href="{{ route($route) }}" class="hover:text-blue-400 transition">
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- KONTAK --}}
        <div>
            <h3 class="font-semibold text-lg mb-4">Hubungi Kami</h3>
            <ul class="space-y-3 text-sm text-gray-400">
                <li class="flex gap-3 items-center">
                    <i class="fa-brands fa-instagram"></i>
                    <span>@Kendangsari_SDN</span>
                </li>
                <li class="flex gap-3 items-center">
                    <i class="fa-brands fa-youtube"></i>
                    <span>@Kendangsari_SDN</span>
                </li>
                <li class="flex gap-3 items-center">
                    <i class="fa-solid fa-globe"></i>
                    <span>www.sdnkendangsari.sch.id</span>
                </li>
                <li class="flex gap-3 items-center">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>+62 xxx xxxx</span>
                </li>
            </ul>
        </div>

    </div>

    <div class="border-t border-gray-800 py-4 text-center text-xs text-gray-500">
        © {{ date('Y') }} SDN Kendangsari III — Capstone Project
    </div>
</footer>

{{-- ================= SCRIPT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper', {
        loop: true,
        autoplay: { delay: 4000 },
        effect: 'fade',
    });
</script>

</body>
</html>
