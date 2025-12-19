<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ $title ?? 'SIMAK' }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen">

    @auth
        @php $role = auth()->user()->role; @endphp

        @if ($role === 'admin')
            @include('layouts.sidebar-admin')
        @elseif ($role === 'guru')
            @include('layouts.sidebar-guru')
        @elseif ($role === 'kepala_sekolah')
            @include('layouts.sidebar-kepsek')
        @endif
    @endauth

    <!-- APP WRAPPER -->
    <div id="app-wrapper" class="app-wrapper min-h-screen flex flex-col">

        <!-- HEADER -->
        <header class="bg-white border-b px-6 py-4 flex items-center gap-4">
            <button id="toggleSidebar"
                    class="text-gray-600 hover:text-gray-900">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1 class="text-sm font-semibold text-gray-700">
                Sistem Informasi Manajemen Sekolah dan Akademik (SIMAK)
            </h1>
        </header>

        <main class="flex-1 px-8 py-6">
            @yield('content')
        </main>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>