<aside id="sidebar" class="sidebar flex flex-col z-40">

  <div class="flex flex-col items-center py-6 border-b border-white/10 shrink-0">
    <div class="sidebar-text text-sm font-semibold mb-3">SDN Kendangsari III</div>
    
    <img src="<?php echo e(asset('images/logosekolah.png')); ?>" class="w-16 h-16 mb-3">
    
    <div class="sidebar-text text-sm font-semibold">
      <?php echo e(auth()->user()->name ?? 'kepsek'); ?>

    </div>
    <div class="sidebar-text text-xs text-white/60">Kepala Sekolah</div>
  </div>

  <nav class="flex-1 py-3 overflow-y-auto flex flex-col gap-1">

    <button type="button" onclick="window.location.href='<?php echo e(route('kepsek.dashboard')); ?>'"
            class="menu-item text-left <?php echo e(request()->routeIs('kepsek.dashboard') ? 'menu-active' : ''); ?>">
      <span class="menu-icon"><i class="fa-solid fa-chart-simple"></i></span>
      <span class="sidebar-text">Dashboard</span>
    </button>

    <div class="menu-section sidebar-text">Manajemen Pengguna</div>

    <button type="button" onclick="window.location.href='<?php echo e(route('kepsek.users')); ?>'" 
            class="menu-item text-left <?php echo e(request()->routeIs('kepsek.users*') ? 'menu-active' : ''); ?>">
      <span class="menu-icon"><i class="fa-solid fa-user"></i></span>
      <span class="sidebar-text">Data Pengguna</span>
    </button>

    <div class="menu-section sidebar-text">Laporan</div>

    <button type="button" onclick="window.location.href='<?php echo e(route('kepsek.laporan.siswa')); ?>'"
            class="menu-item text-left <?php echo e(request()->routeIs('kepsek.laporan.siswa*') ? 'menu-active' : ''); ?>">
      <span class="menu-icon"><i class="fa-solid fa-user-graduate"></i></span>
      <span class="sidebar-text">Data Siswa</span>
    </button>

    <button type="button" onclick="window.location.href='<?php echo e(route('kepsek.laporan.guru')); ?>'"
            class="menu-item text-left <?php echo e(request()->routeIs('kepsek.laporan.guru*') ? 'menu-active' : ''); ?>">
      <span class="menu-icon"><i class="fa-solid fa-chalkboard-user"></i></span>
      <span class="sidebar-text">Data Guru</span>
    </button>

    <button type="button" onclick="window.location.href='<?php echo e(route('kepsek.laporan.jadwal')); ?>'"
            class="menu-item text-left <?php echo e(request()->routeIs('kepsek.laporan.jadwal*') ? 'menu-active' : ''); ?>">
      <span class="menu-icon"><i class="fa-solid fa-calendar-days"></i></span>
      <span class="sidebar-text">Jadwal Pelajaran</span>
    </button>

    <div class="menu-section sidebar-text">Website</div>

    <button type="button" onclick="window.location.href='<?php echo e(route('home')); ?>'"
            class="menu-item text-left <?php echo e(request()->routeIs('home') ? 'menu-active' : ''); ?>">
      <span class="menu-icon"><i class="fa-solid fa-globe"></i></span>
      <span class="sidebar-text">Kembali ke Landing Page</span>
    </button>

    <div class="mt-4 pt-4 border-t border-white/10">
      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <button type="submit" class="menu-item menu-logout text-left w-full">
          <span class="menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
          <span class="sidebar-text">Logout</span>
        </button>
      </form>
    </div>

  </nav>
</aside><?php /**PATH D:\Capstone\capstone-simak\resources\views/layouts/sidebar-kepsek.blade.php ENDPATH**/ ?>