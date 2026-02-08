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
    @vite(['resources/css/custom.css', 'resources/js/createGroup.ts'])
</head>
<body class="bg-light">
<x-header />
<main class="d-flex">
    <x-sidebar/>
    <div id="content" class="flex-grow-1 p-3 p-md-5 overflow-auto">
        <div class="container-fluid">
            <div class="d-flex justify-content-center justify-content-md-start mb-5">
                <button class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg d-flex align-items-center gap-2 border-0"
                        data-bs-toggle="modal"
                        data-bs-target="#groupModal"
                        id="createNewGroupBtn">
                    <span class="fs-4 lh-1 text-white">+</span>
                    <span>Create New Group</span>
                </button>
            </div>

            <div class="row g-4">
                @forelse($groups as $group)
                    @php
                        $existingMembers = $group->users->where('id', '!=', auth()->id())->map(function($u) {
                            return ['id' => $u->id, 'email' => $u->email];
                        })->values();
                    @endphp
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100 bg-white group-card" role="button" data-bs-toggle="modal" data-bs-target="#groupModal" data-id="{{ $group->id }}" data-name="{{ $group->name }}" data-description="{{ $group->description }}" data-is-creator="true" data-members="{{ json_encode($existingMembers) }}">
                            <span class="fw-bold text-secondary fs-6">{{ $group->name }}</span>
                            <div class="mt-2">
                                <span class="badge bg-light text-primary rounded-pill">Member</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">No groups yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg p-4">
            <div class="mb-3">
                <h5 class="fw-bold text-secondary mb-3" id="modalTitle">Create New Group</h5>
                <input type="text" id="titleInput" class="form-control rounded-pill border-secondary-subtle px-4 py-2" placeholder="Group name">
                <textarea id="descriptionInput" class="form-control rounded-4 border-secondary-subtle px-4 py-2 mt-2" placeholder="Description" rows="2"></textarea>
            </div>

            <div id="searchSection">
                <div class="position-relative mb-1">
                    <input type="text" id="searchInput" class="form-control rounded-pill border-secondary-subtle px-4 py-2" placeholder="Search for a person">
                    <span class="position-absolute end-0 top-50 translate-middle-y me-3">
                        <img src="{{ Vite::asset('resources/svg/search.svg') }}" alt="" class="opacity-50" width="20" height="20">
                    </span>
                </div>
                <div id="userBulletList" class="d-flex flex-column gap-1 mb-2"></div>
            </div>

            <div class="mt-3">
                <label class="small fw-bold text-muted mb-2 ms-2">Members</label>
                <div class="d-flex flex-column gap-2">
                    <div class="card border border-light-subtle rounded-pill px-3 py-2 shadow-sm bg-light">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle overflow-hidden border border-secondary-subtle me-2" style="width: 32px; height: 32px;">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->email }}&background=198754&color=fff" class="w-100 h-100" alt="">
                            </div>
                            <div class="small flex-grow-1">
                                <span class="fw-bold text-primary">Creator</span>
                                <span class="text-muted d-none d-sm-inline"> - {{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div id="addedMembers"></div>
                </div>
            </div>

            <div class="border-0 pt-4 d-flex flex-column gap-2">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary rounded-pill px-4 flex-grow-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveGroup" class="btn btn-primary rounded-pill px-4 fw-bold flex-grow-1">Save Group</button>
                </div>
                <div id="errorHandler" class="text-danger small text-center"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
