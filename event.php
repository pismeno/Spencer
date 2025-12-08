<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Event</title>
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

        <div class="mobile-header-event">
            <img src="assets/user.svg" alt="User">
            <h2 id="mobile-event-title-trigger">Event</h2>
            <button class="mobile-save-btn">Save Changes</button>
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
                    <div class="active">
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
            <div class="event-page-layout">
                <div class="event-left-column">
                    <div class="event-details-card">
                        <h2>Event</h2>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" placeholder="">
                        </div>
                        
                        <div class="form-group">
                            <label>Description</label>
                            <textarea placeholder=""></textarea>
                        </div>

                        <div class="form-row-split">
                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="date">
                            </div>

                            <div class="form-group">
                                <label>Upload thumbnail</label>
                                <input type="file">
                            </div>
                        </div>
                        
                        <div class="image-upload-area">
                            <img src="assets/file.svg" alt="placeholder">
                        </div>

                        <button class="save-btn">Save Changes</button>
                    </div>

                    <div class="search-pill full-width">
                        <input type="text" placeholder="Search for a person or a group">
                        <span class="search-icon-right"><img src="assets/search.svg" alt="search"></span>
                    </div>

                    <div class="members-list-container">
                        <div class="member-row">
                            <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                            <div class="member-info">
                                <span class="role creator">Creator</span>
                                <span class="name">John Doe</span>
                                <span class="email">- john.doe@gmail.com</span>
                            </div>
                            <div class="remove-x">✕</div>
                        </div>
                        
                        <div class="member-row">
                            <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                            <div class="member-info">
                                <span class="role member">Member</span>
                                <span class="name">John Doe</span>
                                <span class="email">- john.doe@gmail.com</span>
                            </div>
                            <div class="remove-x">✕</div>
                        </div>

                        <div class="member-row">
                            <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                            <div class="member-info">
                                <select class="role-dropdown">
                                    <option value="member">Member</option>
                                    <option value="cashier">Cashier</option>
                                </select>
                                <span class="name">John Doe</span>
                                <span class="email">- john.doe@gmail.com</span>
                            </div>
                            <div class="remove-x">✕</div>
                        </div>

                        <div class="member-row">
                            <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                            <div class="member-info">
                                <span class="role member">Member</span>
                                <span class="name">John Doe</span>
                                <span class="email">- john.doe@gmail.com</span>
                            </div>
                            <div class="remove-x">✕</div>
                        </div>

                        <div class="interest-buttons">
                            <button class="btn-interested">I'm Interested</button>
                            <button class="btn-not-interested">Not Interested</button>
                        </div>
                    </div>
                </div>

                <div class="event-right-column" id="attendance-panel">
                    <div class="attendance-card">
                        <h2>Attendance</h2>
                        
                        <div class="attendance-section">
                            <span class="section-label">Interested</span>
                            <div class="attendance-row">
                                <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                                <span>John Doe</span>
                                <div class="icon-group">
                                    <span class="icon-check active"><img src="assets/check.svg" alt="yes"></span>
                                    <span class="icon-cross"><img src="assets/x.svg" alt="no"></span>
                                    <span class="icon-clock"><img src="assets/clock.svg" alt="clock"></span>
                                </div>
                            </div>
                             <div class="attendance-row">
                                <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                                <span>John Doe</span>
                                <div class="icon-group">
                                    <span class="icon-check active"><img src="assets/check.svg" alt="yes"></span>
                                    <span class="icon-cross"><img src="assets/x.svg" alt="no"></span>
                                    <span class="icon-clock"><img src="assets/clock.svg" alt="clock"></span>
                                </div>
                            </div>
                             <div class="attendance-row">
                                <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                                <span>John Doe</span>
                                <div class="icon-group">
                                    <span class="icon-check active"><img src="assets/check.svg" alt="yes"></span>
                                    <span class="icon-cross"><img src="assets/x.svg" alt="no"></span>
                                    <span class="icon-clock"><img src="assets/clock.svg" alt="clock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="attendance-section">
                            <span class="section-label">Not Interested</span>
                             <div class="attendance-row">
                                <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                                <span>John Doe</span>
                            </div>
                             <div class="attendance-row">
                                <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                                <span>John Doe</span>
                            </div>
                             <div class="attendance-row">
                                <div class="avatar"><img src="assets/user.svg" alt="user"></div>
                                <span>John Doe</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#mobile-event-title-trigger').click(function() {
                $('#attendance-panel').toggleClass('show-mobile-modal');
            });
            $(document).click(function(event) { 
                if(!$(event.target).closest('#attendance-panel').length && 
                   !$(event.target).closest('#mobile-event-title-trigger').length &&
                   $('#attendance-panel').hasClass('show-mobile-modal')) {
                    $('#attendance-panel').removeClass('show-mobile-modal');
                }
            });
        });
    </script>
</body>
</html>