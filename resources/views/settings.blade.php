<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Preferences</title>
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
            <div class="preferences-wrapper">

                <div class="pref-top-section">
                    <div class="profile-circle"></div>

                    <div class="name-card">
                        <div class="input-group">
                            <label>First Name</label>
                            <div class="input-wrapper">
                                <input type="text" value="">
                                <img src="{{ Vite::asset('resources/svg/edit.svg') }}" alt="edit" class="edit-icon-small">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Surname</label>
                            <div class="input-wrapper">
                                <input type="text" value="">
                                <img src="{{ Vite::asset('resources/svg/edit.svg') }}" alt="edit" class="edit-icon-small">
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
</body>
</html>
