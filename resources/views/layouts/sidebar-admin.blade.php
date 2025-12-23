<aside id="sidebar" class="sidebar flex flex-col z-40">

  <div class="flex flex-col items-center py-6 border-b border-white/10 shrink-0">
    <div class="sidebar-text text-sm font-semibold mb-3">SDN Kendangsari III</div>
    <img src="{{ asset('images/logosekolah.png') }}" class="w-12 h-12 rounded-full mb-3">
    <div class="sidebar-text text-sm font-semibold">
      {{ auth()->user()->name ?? 'Admin' }}
    </div>
    <div class="sidebar-text text-xs text-white/60">Administrator</div>
  </div>

  <nav class="flex-1 py-3 overflow-y-auto flex flex-col gap-1">

    <button type="button" onclick="window.location.href='{{ route('admin.dashboard') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.dashboard') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-house"></i></span>
      <span class="sidebar-text">Dashboard</span>
    </button>

    <div class="menu-section sidebar-text">Data Master</div>

    <button type="button" onclick="window.location.href='{{ route('admin.siswa') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.siswa*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-user-graduate"></i></span>
      <span class="sidebar-text">Data Siswa</span>
    </button>

    <button type="button" onclick="window.location.href='{{ route('admin.guru') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.guru*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-chalkboard-user"></i></span>
      <span class="sidebar-text">Data Guru</span>
    </button>

    <button type="button" onclick="window.location.href='{{ route('admin.kelas') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.kelas*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-door-open"></i></span>
      <span class="sidebar-text">Data Kelas</span>
    </button>

    <button type="button" onclick="window.location.href='{{ route('admin.mapel') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.mapel*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-book-open"></i></span>
      <span class="sidebar-text">Data Mata Pelajaran</span>
    </button>

    <div class="menu-section sidebar-text">Akademik</div>

    <button type="button" onclick="window.location.href='{{ route('admin.pembagian-kelas') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.pembagian-kelas*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-users-rectangle"></i></span>
      <span class="sidebar-text">Pembagian Kelas</span>
    </button>

    <button type="button" onclick="window.location.href='{{ route('admin.jadwal') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.jadwal*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-calendar-days"></i></span>
      <span class="sidebar-text">Jadwal Pelajaran</span>
    </button>

    <div class="menu-section sidebar-text">Kelola Halaman</div>

    <button type="button" onclick="window.location.href='{{ route('admin.kelola-halaman') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.kelola-halaman*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-globe"></i></span>
      <span class="sidebar-text">Kelola Halaman</span>
    </button>

    <button type="button" onclick="window.location.href='{{ route('home') }}'"
            class="menu-item text-left {{ request()->routeIs('admin.landing*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-laptop"></i></span>
      <span class="sidebar-text">Landing Page</span>
    </button>

    <div class="mt-4 pt-4 border-t border-white/10">
  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    
    <button type="button" class="menu-item menu-logout text-left w-full">
      <span class="menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
      <span class="sidebar-text">Logout</span>
    </button>
  </form>
</div>
  </nav>
</aside>