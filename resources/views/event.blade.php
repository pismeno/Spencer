<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">
    @vite(['resources/css/custom.css', 'resources/js/showImg.ts', 'resources/js/createEvent.ts'])
</head>
<body class="bg-light">
<x-header />
<main class="d-flex">
    <x-sidebar/>
    <div id="content" class="flex-grow-1 p-3 p-md-5 overflow-auto">
        <div class="container-xl">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                        <h2 class="h3 fw-bold mb-4 text-secondary">Event</h2>
                        <div id="title-div" class="mb-3">
                            <label class="form-label small text-muted">Title</label>
                            <input id="input-title" type="text" class="form-control rounded-3" placeholder="Enter event title">
                        </div>

                        <div id="description-div" class="mb-3">
                            <label class="form-label small text-muted">Description</label>
                            <textarea class="form-control rounded-3" rows="3" placeholder="Describe your event" id="input-description"></textarea>
                        </div>
                        <div class="row g-3 mb-4">
                            <div id="deadline-div" class="col-md-4">
                                <label class="form-label small text-muted">Deadline</label>
                                <input type="date" class="form-control rounded-3" id="input-deadline">
                            </div>
                            <div id="from-div" class="col-md-4">
                                <label class="form-label small text-muted">From</label>
                                <input type="date" class="form-control rounded-3 border">
                            </div>
                            <div id="to-div" class="col-md-4">
                                <label class="form-label small text-muted">To</label>
                                <input type="date" class="form-control rounded-3">
                            </div>
                        </div>
                        <div id="img-preview-div" class="ratio ratio-21x9 bg-light rounded-4 border border-secondary border-opacity-25 mb-2 position-relative">
                            <img id="img-preview" class="w-100 h-100 d-none top-0 start-0, rounded-4 z-1" style="object-fit: cover; pointer-events: none" alt="img-preview">
                            <label for="event-image-upload" class="d-flex flex-column justify-content-center align-items-center w-100 h-100" style="cursor: pointer;">
                                <img id="input-img" src="{{ Vite::asset('resources/svg/file.svg') }}" alt="Upload" class="opacity-50 mb-2" style="width: 80px; height: auto;">
                                <span class="small text-muted fw-bold">Click to upload event image</span>
                                <input type="file" id="event-image-upload" class="d-none" accept="image/png image/jpg image/webp image/jpeg">
                            </label>
                        </div>
                        <button id="save-changes" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">Save Changes</button>
                    </div>

                    <div class="position-relative mb-4">
                        <input type="text" class="form-control rounded-pill py-3 px-4 shadow-sm border-0" placeholder="Search for a person or a group">
                        <span class="position-absolute end-0 top-50 translate-middle-y me-4">
                            <img src="{{ Vite::asset('resources/svg/search.svg') }}" alt="search" class="h-auto w-auto opacity-50">
                        </span>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        @foreach(range(1, 4) as $index)
                            <div class="card border-0 shadow-sm rounded-pill px-3 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle overflow-hidden border border-secondary-subtle me-3 flex-shrink-0" style="width: 35px; height: 35px;">
                                        <img src="{{ Vite::asset('resources/svg/user.svg') }}" class="w-100" alt="user">
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center flex-grow-1 gap-2 small">
                                        <span class="fw-bold {{ $index == 1 ? 'text-primary' : 'text-success' }}">
                                            {{ $index == 1 ? 'Creator' : 'Member' }}
                                        </span>
                                        <span class="fw-bold text-dark">John Doe</span>
                                        <span class="text-muted">- john.doe@gmail.com</span>
                                    </div>
                                    <div class="text-danger px-2" role="button">✕</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button class="btn btn-primary flex-grow-1 rounded-pill py-2 fw-bold shadow-sm">I'm Interested</button>
                        <button class="btn btn-danger flex-grow-1 rounded-pill py-2 fw-bold shadow-sm">Not Interested</button>
                    </div>
                </div>

                <!-- <div class="col-lg-4" id="attendance-panel">
                    <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                        <h2 class="h4 text-center fw-bold mb-4 text-secondary">Attendance</h2>

                        <div class="mb-4">
                            <span class="d-block small text-muted mb-3">Interested</span>
                            @foreach(range(1, 3) as $i)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle overflow-hidden border border-secondary-subtle me-2 flex-shrink-0" style="width: 24px; height: 24px;">
                                        <img src="{{ Vite::asset('resources/svg/user.svg') }}" class="w-100" alt="user">
                                    </div>
                                    <span class="small fw-medium flex-grow-1">John Doe</span>
                                    <div class="d-flex gap-2">
                                        <img src="{{ Vite::asset('resources/svg/check.svg') }}" class="opacity-100" alt="yes" role="button">
                                        <img src="{{ Vite::asset('resources/svg/x.svg') }}" class="opacity-25" alt="no" role="button">
                                        <img src="{{ Vite::asset('resources/svg/clock.svg') }}" class="opacity-25" alt="clock" role="button">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <span class="d-block small text-muted mb-3">Not Interested</span>
                            @foreach(range(1, 3) as $i)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle overflow-hidden border border-secondary-subtle me-2 flex-shrink-0" style="width: 24px; height: 24px;">
                                        <img src="{{ Vite::asset('resources/svg/user.svg') }}" class="w-100" alt="user">
                                    </div>
                                    <span class="small fw-medium">John Doe</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div> -->
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
