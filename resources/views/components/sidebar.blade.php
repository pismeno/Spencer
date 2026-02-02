<aside id="main-sidebar" class="bg-white d-none d-md-flex flex-column p-3 z-2">
    @vite(['resources/js/sidebar.ts'])

    <div class="d-flex flex-column gap-2">
        <a href="/" class="text-decoration-none d-flex align-items-center p-2 rounded hover-bg">
            <img src="{{ Vite::asset('resources/svg/home.svg') }}" alt="Home" width="24" height="24">
            <span class="ms-3 text-secondary fw-medium sidebar-text">Home</span>
        </a>

        <a href="/event" class="text-decoration-none d-flex align-items-center p-2 rounded hover-bg">
            <img src="{{ Vite::asset('resources/svg/plus-circle.svg') }}" alt="Create" width="24" height="24">
            <span class="ms-3 text-secondary fw-medium sidebar-text">Event</span>
        </a>

        <a href="/group" class="text-decoration-none d-flex align-items-center p-2 rounded hover-bg">
            <img src="{{ Vite::asset('resources/svg/users.svg') }}" alt="Groups" width="24" height="24">
            <span class="ms-3 text-secondary fw-medium sidebar-text">Groups</span>
        </a>

        <a href="/settings" class="text-decoration-none d-flex align-items-center p-2 rounded hover-bg">
            <img src="{{ Vite::asset('resources/svg/settings.svg') }}" alt="Settings" width="24" height="24">
            <span class="ms-3 text-secondary fw-medium sidebar-text">Preferences</span>
        </a>
    </div>

    <div class="mt-auto d-flex flex-column gap-2 border-top pt-3">
        <form action="/logout" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn border-0 d-flex align-items-center p-2 w-100 shadow-none hover-bg text-start">
                <img src="{{ Vite::asset('resources/svg/log-out.svg') }}" alt="Logout" width="24" height="24">
                <span class="ms-3 text-secondary fw-medium sidebar-text">Logout</span>
            </button>
        </form>

        <div class="d-flex align-items-center p-2 rounded hover-bg" onclick="toggleSidebar()">
            <img src="{{ Vite::asset('resources/svg/arrow-left.svg') }}" id="collapse-icon" alt="Collapse" width="24" height="24">
            <span class="ms-3 text-secondary fw-medium sidebar-text">Collapse</span>
        </div>
    </div>
</aside>

<nav class="navbar fixed-bottom bg-white border-top d-md-none p-2 shadow-lg">
    <div class="container-fluid px-0 h-100">
        <div class="d-flex w-100 h-100 justify-content-around align-items-center">
            <a href="/" class="text-center text-decoration-none flex-grow-1">
                <img src="{{ Vite::asset('resources/svg/home.svg') }}" alt="Home" height="20">
                <div class="small text-muted">Home</div>
            </a>
            <a href="/event" class="text-center text-decoration-none flex-grow-1">
                <img src="{{ Vite::asset('resources/svg/plus-circle.svg') }}" alt="Create" height="20">
                <div class="small text-muted">Create</div>
            </a>
            <a href="/group" class="text-center text-decoration-none flex-grow-1">
                <img src="{{ Vite::asset('resources/svg/users.svg') }}" alt="Groups" height="20">
                <div class="small text-muted">Groups</div>
            </a>
            <a href="/settings" class="text-center text-decoration-none flex-grow-1">
                <img src="{{ Vite::asset('resources/svg/settings.svg') }}" alt="Settings" height="20">
                <div class="small text-muted">Settings</div>
            </a>
        </div>
    </div>
</nav>
