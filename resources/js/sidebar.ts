const toggleSidebar = () => {
    const sidebar = document.getElementById('main-sidebar');
    if (sidebar) {
        sidebar.classList.toggle('collapsed');
    }
};

(window as any).toggleSidebar = toggleSidebar;
