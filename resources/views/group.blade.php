<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Groups</title>
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
        <div class="container-fluid">
            <div class="d-flex justify-content-center justify-content-md-start mb-5">
                <button class="btn btn-custom btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg d-flex align-items-center gap-2 border-0" data-bs-toggle="modal" data-bs-target="#groupModal">
                    <span class="fs-4 lh-1 text-white">+</span>
                    <span>Create New Group</span>
                </button>
            </div>

            <div class="row g-4">
                @foreach(range(1, 12) as $index)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100 bg-white" data-bs-toggle="modal" data-bs-target="#groupModal" role="button">
                            <span class="fw-bold text-secondary fs-6">Group {{ $index }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg p-3">
            <div class="modal-header border-0 pb-0">
                <h2 class="h4 fw-bold mb-0 text-dark opacity-75" id="groupModalLabel">Group 1</h2>
                <button type="button" class="btn p-0 ms-auto shadow-none">
                    <img src="{{ Vite::asset('resources/svg/edit.svg') }}" alt="Edit" class="opacity-50" width="20" height="20">
                </button>
            </div>

            <div class="modal-body">
                <div class="position-relative mb-4">
                    <input type="text" class="form-control rounded-pill border-secondary-subtle px-4 py-2" placeholder="Search for a person">
                    <span class="position-absolute end-0 top-50 translate-middle-y me-3">
                        <img src="{{ Vite::asset('resources/svg/search.svg') }}" alt="" class="opacity-50" width="20" height="20">
                    </span>
                </div>

                <div class="d-flex flex-column gap-2 mb-4">
                    @foreach(range(1, 3) as $i)
                        <div class="card border border-light-subtle rounded-pill px-3 py-2 shadow-sm">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle overflow-hidden border border-secondary-subtle me-2" style="width: 30px; height: 30px;">
                                    <img src="{{ Vite::asset('resources/svg/user.svg') }}" class="w-100" alt="">
                                </div>
                                <div class="small flex-grow-1">
                                    <span class="fw-bold {{ $i == 1 ? 'text-primary' : 'text-success' }} me-1">
                                        {{ $i == 1 ? 'Creator' : 'Member' }}
                                    </span>
                                    <span class="text-dark fw-medium">John Doe</span>
                                    <span class="text-muted d-none d-sm-inline">- john.doe@gmail.com</span>
                                </div>
                                @if($i > 1)
                                    <div class="text-danger small fw-bold px-1" role="button">✕</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-custom rounded-pill px-4 fw-bold">Save Group</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
