document.addEventListener('DOMContentLoaded', function() {

    // ==========================================================
    // 1. FLASH MESSAGE (Sukses/Gagal dari Session)
    // ==========================================================
    if (window.flashSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: window.flashSuccess,
            timer: 3000,
            showConfirmButton: false
        });
    }

    if (window.flashError) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: window.flashError,
        });
    }

    // ==========================================================
    // 2. KONFIRMASI HAPUS (Tombol dengan class .btn-delete)
    // ==========================================================
    document.addEventListener('click', function(e) {
        if (e.target && e.target.closest('.btn-delete')) {
            e.preventDefault();
            let form = e.target.closest('form');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });

    // ==========================================================
    // 3. KONFIRMASI LOGOUT (Tombol dengan class .btn-logout)
    // ==========================================================
    // Cari tombol logout berdasarkan class
    const logoutBtn = document.querySelector('.btn-logout');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Cegah link jalan langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sesi ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Cari form logout berdasarkan ID dan submit
                    document.getElementById('logout-form').submit();
                }
            });
        });
    }

});