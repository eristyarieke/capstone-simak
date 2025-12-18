<div class="sidebar">
    <div class="profile-section">
        <img src="/img/profile.png">
        <div class="name">Admin X</div>
        <div class="role">Administrator</div>
    </div>

    <div class="menu-wrapper">
        <div class="menu">

            <a href="#" class="active">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <div class="menu-title">Data Master</div>
            <a href="#"><i class="fa-solid fa-user-graduate"></i>Data Siswa</a>
            <a href="#"><i class="fa-solid fa-chalkboard-user"></i>Data Guru</a>
            <a href="#"><i class="fa-solid fa-door-open"></i>Data Kelas</a>
            <a href="#"><i class="fa-solid fa-book-open"></i>Data Mata Pelajaran</a>

            <div class="menu-title">Akademik</div>
            <a href="#"><i class="fa-solid fa-users-rectangle"></i>Pembagian Kelas</a>
            <a href="#"><i class="fa-solid fa-calendar-days"></i>Jadwal Pelajaran</a>

            <div class="menu-title">Website</div>
            <a href="#"><i class="fa-solid fa-globe"></i>Kelola Halaman</a>
            <a href="#"><i class="fa-solid fa-laptop"></i>Landing Page</a>

            {{-- LOGOUT (INI YANG BENAR) --}}
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-menu"
                    style="background:none;border:none;width:100%;text-align:left;cursor:pointer;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </button>
            </form>

        </div>
    </div>
</div>
