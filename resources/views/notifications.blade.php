<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">
    @vite(['resources/css/custom.css'])
</head>
<body class="bg-light">
<x-header />

<main class="d-flex">
    <aside class="col-md-3 col-lg-2 bg-white sticky-top p-0">
        <x-sidebar/>
    </aside>

    <div id="content" class="flex-grow-1 p-3 p-md-5 overflow-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    <h2 class="h4 fw-bold mb-4 px-2 text-secondary">Notifications</h2>
                    <div class="d-flex flex-column gap-3">
                        @foreach(range(1, 10) as $index)
                            <div class="card border-0 shadow-sm rounded-pill p-2 px-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="ratio ratio-1x1 bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img src="{{ Vite::asset('resources/svg/bell.svg') }}" alt="notif" class="h-50 w-auto opacity-75">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="mb-0 text-dark fw-medium text-truncate">You have a new invitation to <strong>Group {{ $index }}</strong></p>
                                        <small class="text-muted opacity-75">2 hours ago</small>
                                    </div>
                                    <div class="ms-2 d-none d-sm-block">
                                        <button class="btn btn-sm btn-light rounded-pill border px-3 shadow-none">View</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
