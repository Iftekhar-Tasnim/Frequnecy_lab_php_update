document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('admin-sidebar');
    const openBtn = document.getElementById('sidebar-open');
    const closeBtn = document.getElementById('sidebar-close');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleSidebar() {
        // Toggle the transform class to slide in/out
        sidebar.classList.toggle('-translate-x-full');
        // Toggle overlay visibility
        if (overlay) {
            overlay.classList.toggle('hidden');
        }
    }

    if (openBtn) {
        openBtn.addEventListener('click', toggleSidebar);
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', toggleSidebar);
    }

    if (overlay) {
        overlay.addEventListener('click', toggleSidebar);
    }
});
