<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&family=Trispace:wght@100..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body>
<x-basic-header/>
<main>
    <div class="content vertical-align">
        <div class="centerer card">
            <div id="login-box">
                <h2>Login</h2>
                <form class="flex-column gap-md" id="register" method="POST" action="/login">
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="tomik.bobik@centrum.cz" value="{{ old('email') }}" class="input">

                    {{-- No matching account message will appear where $message is when no account in DB matches input --}}
                    @error('email')
                    <p class="error-text">{{ $message }}</p>
                    @enderror

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="hesl0" class="input">
                    <button class="save-btn">Submit</button>
                </form>
                <p id="errorlogger"></p>
                <a href="/register" class="no-style centerer"><h4>Don't have one? </h4></a>
            </div>
        </div>
    </div>
</main>
</body>
</html>
