<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Groups</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lib/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div id="logo">
            <h1>Spencer</h1>
        </div>
        
        <div class="mobile-header-std">
            <h1>Spencer</h1>
            <div class="mobile-header-icons">
                <img src="assets/search.svg" alt="Search">
                <div class="notif-wrapper">
                    <img src="assets/bell.svg" alt="Notifications">
                    <div class="red-dot"></div>
                </div>
                <img src="assets/log-out.svg" alt="Logout">
            </div>
        </div>

        <div id="search">
            <input type="search">
            <a href="notifications.php"><img src="assets/search.svg" alt="Search"></a>
        </div>
        <div id="notifications">
            <img src="assets/bell.svg" alt="Notifications">
        </div>
    </header>
    <main>
        <div id="sidebar-open">
            <div id="buttons-top">
                <a href="index.php" class="side-menu">
                    <div>
                        <img src="assets/home.svg" alt="">
                        <span>Home</span>
                    </div>
                </a>
                <a href="event.php" class="side-menu">
                    <div>
                        <img src="assets/plus-circle.svg" alt="">
                        <span>Create Event</span>
                    </div>
                </a>
                <a href="group.php" class="side-menu">
                    <div class="active">
                        <img src="assets/users.svg" alt="">
                        <span>Groups</span>
                    </div>
                </a>
                <a href="settings.php" class="side-menu">
                    <div>
                        <img src="assets/settings.svg" alt="">
                        <span>Preferences</span>
                    </div>
                </a>
            </div>
            <div id="buttons-bottom">
                <div>
                    <img src="assets/arrow-left.svg" alt="">
                    <span>Collapse menu</span>
                </div>
                <div>
                    <img src="assets/log-out.svg" alt="">
                    <span>Logout</span>
                </div>
            </div>
        </div>
        
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
                <img src="assets/edit.svg" alt="Edit" class="edit-icon"> 
            </div>
            
            <div class="modal-search">
                <input type="text" placeholder="Search for a person">
                <span class="search-icon"><img src="assets/search.svg" alt=""></span>
            </div>

            <div class="members-list">
                <div class="member-row">
                    <div class="avatar"><img src="assets/user.svg" alt=""></div>
                    <div class="member-info">
                        <span class="role creator">Creator</span>
                        <span class="name">John Doe</span>
                        <span class="email">- john.doe@gmail.com</span>
                    </div>
                </div>
                <div class="member-row">
                    <div class="avatar"><img src="assets/user.svg" alt=""></div>
                    <div class="member-info">
                        <span class="role member">Member</span>
                        <span class="name">John Doe</span>
                        <span class="email">- john.doe@gmail.com</span>
                    </div>
                    <div class="remove-x">✕</div>
                </div>
                <div class="member-row">
                    <div class="avatar"><img src="assets/user.svg" alt=""></div>
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

    <script>
        $(document).ready(function() {
            $('#create-group-btn').click(function() {
                $('#modal-overlay').fadeIn(200).css('display', 'flex');
            });

            $('#modal-overlay').click(function(e) {
                if(e.target.id === 'modal-overlay') {
                    $(this).fadeOut(200);
                }
            });
        });
    </script>
</body>
</html>