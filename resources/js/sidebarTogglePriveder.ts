const sidebarToggle = localStorage.getItem("sidebarCollapse");
if (sidebarToggle === "true") {
    document.getElementById("main-sidebar")?.classList.toggle("collapsed");
}