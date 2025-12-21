<aside id="sidebar" class="sidebar flex flex-col z-40">

  <div class="flex flex-col items-center py-6 border-b border-white/10 shrink-0">
    <div class="sidebar-text text-sm font-semibold mb-3">SDN Kendangsari III</div>
    
    <img src="{{ auth()->user()->profile_photo_url ?? '/img/profile.png' }}" class="w-12 h-12 rounded-full mb-3 object-cover">
    
    <div class="sidebar-text text-sm font-semibold">
      {{ auth()->user()->name ?? 'guru' }}
    </div>
    <div class="sidebar-text text-xs text-white/60">Guru Pengajar</div>
  </div>

  <nav class="flex-1 py-3 overflow-y-auto flex flex-col gap-1">

    <button type="button" onclick="window.location.href='{{ route('guru.dashboard') }}'"
            class="menu-item text-left {{ request()->routeIs('guru.dashboard') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-house"></i></span>
      <span class="sidebar-text">Dashboard</span>
    </button>

    <div class="menu-section sidebar-text">Akademik</div>

    <button type="button" onclick="window.location.href='{{ route('guru.jadwal') }}'"
            class="menu-item text-left {{ request()->routeIs('guru.jadwal*') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-calendar-days"></i></span>
      <span class="sidebar-text">Jadwal Pelajaran</span>
    </button>

    <div class="menu-section sidebar-text">Website</div>

    <button type="button" onclick="window.location.href='{{ route('home') }}'"
            class="menu-item text-left {{ request()->routeIs('home') ? 'menu-active' : '' }}">
      <span class="menu-icon"><i class="fa-solid fa-globe"></i></span>
      <span class="sidebar-text">Kembali ke Landing Page</span>
    </button>

    <div class="mt-4 pt-4 border-t border-white/10">
      <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="menu-item menu-logout text-left w-full">
          <span class="menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
          <span class="sidebar-text">Logout</span>
        </button>
      </form>
    </div>

  </nav>
</aside>