<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>{{ $title ?? 'Sistem Informasi Manajemen Sekolah dan Akademik (SIMAK)' }}</title> 
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
        <script src="{{ asset('js/app.js') }}"></script> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    </head>
<body>
<div class="wrapper">
    
    {{-- Sidebar --}}
    @include($sidebar)

    <div class="main-area">
        
        <!-- Global Header di samping sidebar -->
        <div class="global-header">
            <h6 class="gh-title">Sistem Informasi Manajemen Sekolah dan Akademik (SIMAK)</h4>
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>
</div>
</body>
