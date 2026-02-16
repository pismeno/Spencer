const sidebarToggle = localStorage.getItem("sidebarCollapse");
    if (sidebarToggle === "true") {
        document.getElementById("main-sidebar")?.classList.toggle("collapsed");
        document.getElementById('event-submenu')?.classList.toggle("ps-4");
    }
const eventSubmenu = localStorage.getItem("EventSubmenuToggle");
if (eventSubmenu === "true" && document.getElementById("event-chevron")) {
    document.getElementById("event-submenu")?.classList.remove("d-none");
    document.getElementById("event-chevron")!.style.transform = "rotate(180deg)";
    document.getElementById("event-menu-btn")?.setAttribute("aria-expanded", "true");
}
function toggleEventSubmenu(): void {
    const submenu = document.getElementById('event-submenu');
    const chevron = document.getElementById('event-chevron');
    const btn = document.getElementById('event-menu-btn');

    if (submenu && chevron && btn) {
        const isHidden = submenu.classList.contains('d-none');
        const localStorageSubmenuStatus:string = localStorage.getItem("EventSubmenuToggle")?? "false";
        if (isHidden) {
            submenu.classList.remove('d-none');
            localStorage.setItem("EventSubmenuToggle", "true");
            chevron.style.transform = 'rotate(180deg)';
            btn.setAttribute('aria-expanded', 'true');
        } else {
            submenu.classList.add('d-none');
            localStorage.setItem("EventSubmenuToggle", "false");
            chevron.style.transform = 'rotate(0deg)';
            btn.setAttribute('aria-expanded', 'false');
        }
    }
}

// Toggle Event menu na mobilním bottom navbaru
function toggleMobileEventMenu(): void {
    const dropdown = document.getElementById('mobile-event-dropdown');

    if (dropdown) {
        dropdown.classList.toggle('d-none');
    }
}

// Zavření mobilního menu při kliknutí mimo
document.addEventListener('click', function(event: MouseEvent): void {
    const target = event.target as HTMLElement;
    const dropdown = document.getElementById('mobile-event-dropdown');
    const btn = document.getElementById('mobile-event-btn');

    if (dropdown && btn && !dropdown.contains(target) && !btn.contains(target)) {
        dropdown.classList.add('d-none');
    }
});

// Původní toggleSidebar funkce
function toggleSidebar(): void {
    const sidebar = document.getElementById('main-sidebar');
    const collapseIcon = document.getElementById('collapse-icon');
    const groupIcons = document.getElementById('event-submenu');

    if (sidebar && collapseIcon) {
        sidebar.classList.toggle('collapsed');
        const localStorageCollapseStatus:string = localStorage.getItem("sidebarCollapse") ?? "false";
        if (localStorageCollapseStatus === "true") {
            localStorage.setItem("sidebarCollapse", "false");
        } else if (localStorageCollapseStatus === "false"){
            localStorage.setItem("sidebarCollapse", "true");
        }
        if (sidebar.classList.contains('collapsed')) {
            collapseIcon.style.transform = 'rotate(180deg)';
            groupIcons?.classList.remove('ps-4');
        } else {
            collapseIcon.style.transform = 'rotate(0deg)';
            groupIcons?.classList.add('ps-4');
        }
    }
}


// Export funkcí pro globální použití
(window as any).toggleEventSubmenu = toggleEventSubmenu;
(window as any).toggleMobileEventMenu = toggleMobileEventMenu;
(window as any).toggleSidebar = toggleSidebar;
