<div id="sidebar-open">
    <div id="buttons-top">
        {{-- Home Link --}}
        <a href="/" class="side-menu">
            <div class="">
                <img src="{{ Vite::asset('resources/svg/home.svg') }}" alt="Home">
                <span>Home</span>
            </div>
        </a>

        {{-- Create Event Link --}}
        <a href="/event" class="side-menu">
            <div class="">
                <img src="{{ Vite::asset('resources/svg/plus-circle.svg') }}" alt="Create">
                <span>Create Event</span>
            </div>
        </a>

        {{-- Groups Link --}}
        <a href="/group" class="side-menu">
            <div class="">
                <img src="{{ Vite::asset('resources/svg/users.svg') }}" alt="Groups">
                <span>Groups</span>
            </div>
        </a>

        {{-- Settings Link --}}
        <a href="/settings" class="side-menu">
            <div class="">
                <img src="{{ Vite::asset('resources/svg/settings.svg') }}" alt="Settings">
                <span>Preferences</span>
            </div>
        </a>
    </div>

    <div id="buttons-bottom">
        <div style="cursor: pointer;" onclick="toggleSidebar()">
            <img src="{{ Vite::asset('resources/svg/arrow-left.svg') }}" alt="Collapse">
            <span>Collapse menu</span>
        </div>

        <div>
            <img src="{{ Vite::asset('resources/svg/log-out.svg') }}" alt="">
            <span>Logout</span>
        </div>
    </div>
</div>
