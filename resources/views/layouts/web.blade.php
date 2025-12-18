<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - SDN Kendangsari III</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

<!-- NAVBAR -->
<nav class="bg-blue-700 text-white">
    <div class="container mx-auto flex justify-between p-4">
        <span class="font-bold">SDN Kendangsari III</span>
        <div class="space-x-4">
            <a href="/" class="hover:underline">Beranda</a>
            <a href="/profil">Profil</a>
            <a href="/kegiatan">Kegiatan</a>
            <a href="/prestasi">Prestasi</a>
            <a href="/kontak">Kontak</a>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="container mx-auto py-6">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-gray-800 text-white text-center py-4">
    © {{ date('Y') }} SDN Kendangsari III
</footer>

</body>
</html>
