<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">
    @vite(['resources/css/custom.css', 'resources/js/loadMainPage.ts'])
</head>
<body class="bg-light" data-bs-theme="{{ $activeTheme }}">
<x-header/>
<main class="d-flex">
    <x-sidebar/>
    <div id="content" class="flex-grow-1 p-3 p-md-5 mb-sm-5 mb-md-0 overflow-auto">
        <div class="container-fluid d-flex gap-4 flex-md-row flex-column">
            <div class="column g-4 col-md-6">
                <h2 id="newest-event-title" class="mb-4">Newest Events</h2>
                <div id="container-events" data-url="{{ Vite::asset('resources/svg/clock.svg') }}">

                </div>
                <!-- @foreach(range(1, 6) as $index)
                    <div class="col-12 col-md-12 mb-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-white border-0 py-3 px-3">
                                <h5 class="mb-0 text-dark fw-bold text-truncate">Event Title {{ $index }}</h5>
                            </div>

                            <div class="card-body d-none bg-light d-flex align-items-center justify-content-center ratio ratio-16x9">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{ Vite::asset('resources/svg/file.svg') }}" alt="placeholder" class="h-25 w-auto opacity-25">
                                </div>
                            </div>

                            <div class="card-footer bg-white border-0 py-3 px-3 mt-auto">
                                <div class="d-flex align-items-center gap-2 text-muted small">
                                    <img src="{{ Vite::asset('resources/svg/clock.svg') }}" alt="time" class="h-auto w-auto opacity-75">
                                    <span>Deadline: 14.12.2026</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach -->
            </div>
            <div class="col-md-6 column g-4">
                <h2 class="mb-4">Newest Groups</h2>
                <div class="row g-2">
                    @foreach(range(1, 6) as $index)
                    <div class="col-12 col-md-6 col-lg-4 max-w-100">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 justify-content-center h-100 bg-white group-card" role="button" data-bs-toggle="modal" data-bs-target="#groupModal">
                            <span class="fw-bold text-secondary fs-6">Name Group</span>
                            <div class="mt-2">
                                <span class="badge bg-light text-primary rounded-pill">Member</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
