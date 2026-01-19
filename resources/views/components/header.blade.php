<header class="navbar navbar-light bg-white shadow position-sticky top-0 z-1">
    <div class="container-fluid">
        <div class="d-none d-md-flex" id="logo">
            <h1 class="mb-0 fw-bold text-primary">Spencer</h1>
        </div>
        <div class="d-flex d-md-none w-100 justify-content-between align-items-center h-100">
            <h1 class="mb-0 fw-bold text-primary">Spencer</h1>
            <div class="d-flex align-items-center gap-3" id="mobile-header-icons">
                <img src="{{ Vite::asset('resources/svg/search.svg') }}" alt="Search" class="icon-custom">

                <div class="position-relative">
                    <a href="/notifications">
                        <img src="{{ Vite::asset('resources/svg/bell.svg') }}" alt="Notifications" class="icon-custom">
                    </a>
                    <span class="position-absolute bottom-0 start-0 translate-middle p-1 bg-danger border border-white rounded-circle"></span>
                </div>

                <form method="POST" action="/logout" class="m-0 d-inline">
                    @csrf
                    <button type="submit" class="btn p-0 border-0">
                        <img src="{{ Vite::asset('resources/svg/log-out.svg') }}" alt="Logout" class="icon-custom">
                    </button>
                </form>
            </div>
        </div>

        <div class="d-none d-md-flex position-absolute start-50 translate-middle-x align-items-center" id="search">
            <div class="position-relative w-100">
                <input type="search" class="form-control rounded-pill border-secondary-subtle py-2 fs-5 px-4">
                <img src="{{ Vite::asset('resources/svg/search-input.svg') }}" class="position-absolute end-0 top-50 translate-middle-y me-3">
            </div>
        </div>

        <div class="d-none d-md-flex align-items-center ms-auto" id="notifications">
            <a href="/notifications" class="text-decoration-none">
                <img src="{{ Vite::asset('resources/svg/bell.svg') }}" alt="Notifications">
            </a>
        </div>
    </div>
</header>
