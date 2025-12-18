document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const wrapper = document.getElementById('app-wrapper');
    const toggle = document.getElementById('toggleSidebar');

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-collapsed');
        wrapper.classList.toggle('app-collapsed');
    });
});

console.log('clicked');
