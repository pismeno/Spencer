<header>
    <div id="logo">
        <h1>Spencer</h1>
    </div>

    <div class="mobile-header-std">
        <h1>Spencer</h1>
        <div class="mobile-header-icons">
            <img src="{{ Vite::asset('resources/svg/search.svg') }}" alt="Search">
            <div class="notif-wrapper">
                <img src="{{ Vite::asset('resources/svg/bell.svg') }}" alt="Notifications">
                <div class="red-dot"></div>
            </div>
            <img src="{{ Vite::asset('resources/svg/log-out.svg') }}" alt="Logout">
        </div>
    </div>
    <div id="search">
        <input type="search">
        <img src="{{ Vite::asset('resources/svg/search.svg') }}" alt="Search">
    </div>
    <div id="notifications">
        <a href="/notifications"><img src="{{ Vite::asset('resources/svg/bell.svg') }}" alt="Notifications"></a>
    </div>
</header>
