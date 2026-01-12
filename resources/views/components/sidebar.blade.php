<div id="sidebar-open" class="bg-white d-flex flex-column p-3 h-100 shadow-lg">
    <div class="d-flex flex-column gap-2">
        <a href="/" class="text-decoration-none d-flex align-items-center p-2 rounded">
            <img src="{{ Vite::asset('resources/svg/home.svg') }}" alt="Home">
            <span class="ms-3 text-secondary fw-medium">Home</span>
        </a>

        <a href="/event" class="text-decoration-none d-flex align-items-center p-2 rounded">
            <img src="{{ Vite::asset('resources/svg/plus-circle.svg') }}" alt="Create">
            <span class="ms-3 text-secondary fw-medium">Create Event</span>
        </a>

        <a href="/group" class="text-decoration-none d-flex align-items-center p-2 rounded">
            <img src="{{ Vite::asset('resources/svg/users.svg') }}" alt="Groups">
            <span class="ms-3 text-secondary fw-medium">Groups</span>
        </a>

        <a href="/settings" class="text-decoration-none d-flex align-items-center p-2 rounded">
            <img src="{{ Vite::asset('resources/svg/settings.svg') }}" alt="Settings">
            <span class="ms-3 text-secondary fw-medium">Preferences</span>
        </a>
    </div>

    <div class="mt-auto d-flex flex-column gap-2 border-top pt-3">
        <div class="d-flex align-items-center p-2 rounded cursor-pointer" onclick="toggleSidebar()">
            <img src="{{ Vite::asset('resources/svg/arrow-left.svg') }}" alt="Collapse">
            <span class="ms-3 text-secondary fw-medium">Collapse menu</span>
        </div>

        <form action="/logout" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn border-0 d-flex align-items-center p-2 w-100 text-start shadow-none">
                <img src="{{ Vite::asset('resources/svg/log-out.svg') }}" alt="Logout">
                <span class="ms-3 text-secondary fw-medium">Logout</span>
            </button>
        </form>
    </div>
</div>

