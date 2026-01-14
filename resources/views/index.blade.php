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
    @vite(['resources/css/custom.css', 'resources/js/app.ts'])
</head>
<body class="bg-light">

<x-header/>

<main class="container-fluid p-0">
    <div class="row g-0">
        <aside class="col-md-3 col-lg-2 bg-white sticky-top p-0">
            <x-sidebar/>
        </aside>
        <div class="col-12 col-md-9 col-lg-10 p-3 overflow-auto">
            <div class="container-fluid py-4 py-md-0">
                <div class="row g-4 mb-5 mb-md-0">
                    @foreach(range(1, 6) as $index)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <div class="card-header bg-white border-0 py-3 px-4">
                                    <h5 class="mb-0 text-dark fw-bold text-truncate">Event Title {{ $index }}</h5>
                                </div>

                                <div class="card-body bg-light d-flex align-items-center justify-content-center ratio ratio-16x9">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ Vite::asset('resources/svg/file.svg') }}" alt="placeholder" class="h-25 w-auto opacity-25">
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-0 py-3 px-4 mt-auto">
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <img src="{{ Vite::asset('resources/svg/clock.svg') }}" alt="time" class="h-auto w-auto opacity-75">
                                        <span>Deadline: 4th January 2026</span>
                                    </div>
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
