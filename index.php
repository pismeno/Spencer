<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Home</title>
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
            <img src="assets/search.svg" alt="Search">
        </div>
        <div id="notifications">
            <a href="notifications.php"><img src="assets/bell.svg" alt="Notifications"></a>
        </div>
    </header>
    <main>
        <div id="sidebar-open">
            <div id="buttons-top">
                <a href="index.php" class="side-menu">
                    <div class="active">
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
                    <div>
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
            <div class="home-container">
                <div class="events-row">
                    <div class="event-card">
                        <div class="event-title">Title...</div>
                        <div class="event-image-placeholder">
                            <img src="assets/file.svg" alt="placeholder"> 
                        </div>
                        <div class="event-footer">
                            <img src="assets/clock.svg" alt="time">
                            <span>Deadline: 4th January 2025</span>
                        </div>
                    </div>

                    <div class="event-card">
                        <div class="event-title">Title...</div>
                        <div class="event-image-placeholder">
                            <img src="assets/file.svg" alt="placeholder">
                        </div>
                        <div class="event-footer">
                            <img src="assets/clock.svg" alt="time">
                            <span>Deadline: 4th January 2025</span>
                        </div>
                    </div>

                    <div class="event-card">
                        <div class="event-title">Title...</div>
                        <div class="event-image-placeholder">
                            <img src="assets/file.svg" alt="placeholder">
                        </div>
                        <div class="event-footer">
                            <img src="assets/clock.svg" alt="time">
                            <span>Deadline: 4th January 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>