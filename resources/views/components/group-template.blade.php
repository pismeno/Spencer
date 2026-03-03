<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg p-4">
            <div class="mb-3 d-flex justify-content-between align-items-start">
                <h5 class="fw-bold text-secondary mb-3" id="modalTitle">Create New Group</h5>
                <img id="deleteBtn" class="cursor-pointer" src="{{ Vite::asset('resources/svg/trash.svg') }}" alt="delete" width="20" height="20">
            </div>
            <div class="mb-3">
                <div id="img-preview-div" class="ratio ratio-21x9 bg-light rounded-4 border border-secondary border-opacity-25 mb-2 position-relative">
                    <img id="img-preview" class="w-100 h-100 d-none top-0 start-0 rounded-4 z-1" style="object-fit: cover; pointer-events: none" alt="img-preview">
                    <label for="event-image-upload" class="d-flex flex-column justify-content-center align-items-center w-100 h-100" style="cursor: pointer;">
                        <img id="input-img" src="{{ Vite::asset('resources/svg/file.svg') }}" alt="Upload" class="opacity-50 mb-2" style="width: 80px; height: auto;">
                        <span class="small text-muted fw-bold">Click to upload group image</span>
                        <input type="file" id="event-image-upload" class="d-none" accept="image/png, image/jpg, image/webp, image/jpeg">
                    </label>
                </div>
            </div>
            <div class="mb-3">
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
                            <div class="ratio ratio-1x1 rounded-circle overflow-hidden border border-secondary-subtle me-2" style="width: 32px;">
                                @php
                                    $user = auth()->user();
                                    $short = explode('@', $user->email)[0];
                                    $fallback = "https://ui-avatars.com/api/?name=" . urlencode($short) . "&background=198754&color=fff";
                                    $hasLocalAvatar = $user->avatar_url && !str_starts_with($user->avatar_url, 'http');
                                    $profilePic = $hasLocalAvatar ? asset('storage/' . $user->avatar_url) : $fallback;
                                @endphp
                                <img src="{{ $profilePic }}" class="w-100 h-100 rounded-circle object-fit-cover" onerror="this.onerror=null;this.src='{{ $fallback }}';" alt="">
                            </div>
                            <div class="small flex-grow-1">
                                <span class="fw-bold text-primary">Creator</span>
                                <span class="text-muted d-none d-sm-inline"> - {{ $user->email }}</span>
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
