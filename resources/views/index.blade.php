<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Home</title>
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
            <div class="home-container">
                <div class="events-row">
                    <div class="event-card">
                        <div class="event-title">Title...</div>
                        <div class="event-image-placeholder">
                            <img src="{{ Vite::asset('resources/svg/file.svg') }}" alt="placeholder">
                        </div>
                        <div class="event-footer">
                            <img src="{{ Vite::asset('resources/svg/clock.svg') }}" alt="time">
                            <span>Deadline: 4th January 2025</span>
                        </div>
                    </div>

                    <div class="event-card">
                        <div class="event-title">Title...</div>
                        <div class="event-image-placeholder">
                            <img src="{{ Vite::asset('resources/svg/file.svg') }}" alt="placeholder">
                        </div>
                        <div class="event-footer">
                            <img src="{{ Vite::asset('resources/svg/clock.svg') }}" alt="time">
                            <span>Deadline: 4th January 2025</span>
                        </div>
                    </div>

                    <div class="event-card">
                        <div class="event-title">Title...</div>
                        <div class="event-image-placeholder">
                            <img src="{{ Vite::asset('resources/svg/file.svg') }}" alt="placeholder">
                        </div>
                        <div class="event-footer">
                            <img src="{{ Vite::asset('resources/svg/clock.svg') }}" alt="time">
                            <span>Deadline: 4th January 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
