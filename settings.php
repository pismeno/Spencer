<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Preferences</title>
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
                    <div>
                        <img src="assets/users.svg" alt="">
                        <span>Groups</span>
                    </div>
                </a>
                <a href="settings.php" class="side-menu">
                    <div class="active">
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
            <div class="preferences-wrapper">

                <div class="pref-top-section">
                    <div class="profile-circle"></div>

                    <div class="name-card">
                        <div class="input-group">
                            <label>First Name</label>
                            <div class="input-wrapper">
                                <input type="text" value="">
                                <img src="assets/edit.svg" alt="edit" class="edit-icon-small">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Surname</label>
                            <div class="input-wrapper">
                                <input type="text" value="">
                                <img src="assets/edit.svg" alt="edit" class="edit-icon-small">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="settings-card">
                    <div class="card-header">
                        <span>Settings</span>
                        <hr>
                    </div>
                    
                    <div class="setting-row">
                        <span>Setting 1</span>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="setting-row">
                        <span>Setting 2</span>
                        <div class="multi-toggle">
                            <div class="line-bg"></div>
                            <div class="line-active"></div>
                            <div class="dot active" data-val="1"></div>
                            <div class="dot active" data-val="2"></div>
                            <div class="dot" data-val="3"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
    <script>
        $(document).ready(function() {
            $('.dot').click(function() {
                var index = $(this).index() - 2; 
                $('.dot').removeClass('active');
                
                $('.dot').each(function(i) {
                    if (i <= index) $(this).addClass('active');
                });

                var width = (index * 50) + '%';
                $('.line-active').css('width', width);
            });
        });
    </script>
</body>
</html>