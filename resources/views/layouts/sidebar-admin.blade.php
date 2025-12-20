<aside id="sidebar" class="sidebar flex flex-col z-40">

  <!-- PROFILE -->
  <div class="flex flex-col items-center py-6 border-b border-white/10 shrink-0">
    <div class="sidebar-text text-sm font-semibold">SDN Kendangsari III</div>
    <img src="/img/profile.png" class="w-12 h-12 rounded-full mb-2">
    <div class="sidebar-text text-sm font-semibold">
      {{ auth()->user()->name ?? 'Admin' }}
    </div>
    <div class="sidebar-text text-xs text-white/60">Administrator</div>
  </div>

  <!-- MENU -->
  <nav class="flex-1 py-4 px-2 overflow-y-auto flex flex-col gap-3">

    <!-- DASHBOARD -->
    <a href="{{ route('admin.dashboard') }}"
       class="menu-item {{ request()->routeIs('admin.dashboard') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-house"></i></span>
      <span class="sidebar-text">Dashboard</span>
    </a>

    <!-- DATA MASTER -->
    <div class="menu-section sidebar-text">Data Master</div>

    <a href="{{ route('admin.siswa') }}"
       class="menu-item {{ request()->routeIs('admin.siswa.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-user-graduate"></i></span>
      <span class="sidebar-text">Data Siswa</span>
    </a>

    <a href="{{ route('admin.guru') }}"
       class="menu-item {{ request()->routeIs('admin.guru.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-chalkboard-user"></i></span>
      <span class="sidebar-text">Data Guru</span>
    </a>

    <a href="{{ route('admin.kelas') }}"
       class="menu-item {{ request()->routeIs('admin.kelas.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-door-open"></i></span>
      <span class="sidebar-text">Data Kelas</span>
    </a>

    <a href="{{ route('admin.mapel') }}"
       class="menu-item {{ request()->routeIs('admin.mapel.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-book-open"></i></span>
      <span class="sidebar-text">Data Mata Pelajaran</span>
    </a>

    <!-- AKADEMIK -->
    <div class="menu-section sidebar-text">Akademik</div>

    <a href="{{ route('admin.pembagian-kelas') }}"
       class="menu-item {{ request()->routeIs('admin.pembagian-kelas.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-users-rectangle"></i></span>
      <span class="sidebar-text">Pembagian Kelas</span>
    </a>

    <a href="{{ route('admin.jadwal') }}"
       class="menu-item {{ request()->routeIs('admin.jadwal.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-calendar-days"></i></span>
      <span class="sidebar-text">Jadwal Pelajaran</span>
    </a>

    <!-- KELOLA HALAMAN -->
    <div class="menu-section sidebar-text">Kelola Halaman</div>

    <a href="{{ route('admin.kelola-halaman') }}"
       class="menu-item {{ request()->routeIs('admin.kelola-halaman.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-globe"></i></span>
      <span class="sidebar-text">Kelola Halaman</span>
    </a>

    <a href="{{ route('home') }}"
       class="menu-item {{ request()->routeIs('admin.landing.*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-laptop"></i></span>
      <span class="sidebar-text">Landing Page</span>
    </a>

    <!-- LOGOUT -->
    <div class="mt-8 pt-4 border-t border-white/10">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="menu-item menu-logout">
          <span class="menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
          <span class="sidebar-text">Logout</span>
        </button>
      </form>
    </div>

  </nav>
</aside>
