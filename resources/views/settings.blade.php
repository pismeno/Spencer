<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Preferences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">

    @vite(['resources/css/custom.css'])
</head>
<body class="bg-light">
<x-header />
<main class="d-flex">
    <x-sidebar/>
    <div id="content" class="flex-grow-1 p-3 p-md-5 overflow-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="row align-items-center mb-5 g-4">
                        <div class="col-12 col-md-4 d-flex justify-content-center">
                            <div class="ratio ratio-1x1 w-75 bg-white rounded-circle shadow-sm border border-4 border-white d-flex justify-content-center align-items-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{ Vite::asset('resources/svg/user.svg') }}" class="w-50 opacity-25" alt="User Avatar">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-8">
                            <div class="card border-0 shadow-sm rounded-4 p-4">
                                <div class="mb-3">
                                    <label class="form-label small text-muted ms-1">First Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control rounded-3 pe-5" value="John">
                                        <img src="{{ Vite::asset('resources/svg/edit.svg') }}" class="position-absolute end-0 top-50 translate-middle-y me-3 opacity-50 h-25 w-auto">
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small text-muted ms-1">Surname</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control rounded-3 pe-5" value="Doe">
                                        <img src="{{ Vite::asset('resources/svg/edit.svg') }}" class="position-absolute end-0 top-50 translate-middle-y me-3 opacity-50 h-25 w-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="card border-0 shadow-sm rounded-4 p-4">
                                <div class="text-center mb-4">
                                    <span class="h5 fw-bold text-secondary">Settings</span>
                                    <hr class="mt-2 mb-0 opacity-25">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <span class="fw-medium text-dark">Email Notifications</span>
                                    <div class="form-check form-switch fs-4">
                                        <input class="form-check-input" type="checkbox" role="switch" checked>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-medium text-dark">Theme Level</span>
                                    <div class="btn-group btn-group-sm rounded-pill overflow-hidden border" role="group">
                                        <input type="radio" class="btn-check" name="level" id="l1" checked>
                                        <label class="btn btn-primary border-0 px-3" for="l1">1</label>

                                        <input type="radio" class="btn-check" name="level" id="l2">
                                        <label class="btn btn-primary border-0 px-3" for="l2">2</label>

                                        <input type="radio" class="btn-check" name="level" id="l3">
                                        <label class="btn btn-primary border-0 px-3" for="l3">3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
