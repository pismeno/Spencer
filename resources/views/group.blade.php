<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Groups</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body>
    <x-header />
    <main>
        <x-sidebar />

        <div id="content">
            <div id="groups-container">
                <div class="groups-top-bar">
                    <div id="create-group-btn" class="pill-button action">Create Group</div>
                </div>

                <div class="groups-grid">
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                    <div class="group-pill">Group</div>
                </div>
            </div>
        </div>
    </main>

    <div id="modal-overlay">
        <div id="group-modal">
            <div class="modal-header">
                <h2>Group 1</h2>
                <img src="{{ Vite::asset('resources/svg/edit.svg') }}" alt="Edit" class="edit-icon">
            </div>

            <div class="modal-search">
                <input type="text" placeholder="Search for a person">
                <span class="search-icon"><img src="{{ Vite::asset('resources/svg/search.svg') }}" alt=""></span>
            </div>

            <div class="members-list">
                <div class="member-row">
                    <div class="avatar"><img src="{{ Vite::asset('resources/svg/user.svg') }}" alt=""></div>
                    <div class="member-info">
                        <span class="role creator">Creator</span>
                        <span class="name">John Doe</span>
                        <span class="email">- john.doe@gmail.com</span>
                    </div>
                </div>
                <div class="member-row">
                    <div class="avatar"><img src="{{ Vite::asset('resources/svg/user.svg') }}" alt=""></div>
                    <div class="member-info">
                        <span class="role member">Member</span>
                        <span class="name">John Doe</span>
                        <span class="email">- john.doe@gmail.com</span>
                    </div>
                    <div class="remove-x">✕</div>
                </div>
                <div class="member-row">
                    <div class="avatar"><img src="{{ Vite::asset('resources/svg/user.svg') }}" alt=""></div>
                    <div class="member-info">
                        <span class="role member">Member</span>
                        <span class="name">John Doe</span>
                        <span class="email">- john.doe@gmail.com</span>
                    </div>
                    <div class="remove-x">✕</div>
                </div>
            </div>

            <div class="empty-rows">
                <div class="empty-row"></div>
                <div class="empty-row"></div>
                <div class="empty-row"></div>
            </div>
        </div>
    </div>
</body>
</html>
