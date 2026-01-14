<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&family=Trispace:wght@100..800&display=swap" rel="stylesheet">
    @vite(['resources/js/register.ts'])
    @vite(['resources/css/custom.css'])
</head>
<body class="bg-light">
<x-basic-header/>
<main class="container">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm p-4">
            <div id="register-box">
                <h2 class="text-center mb-4">Register</h2>
                <form id="register" method="POST" action="/register" class="d-flex flex-column gap-3">
                    @csrf
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="tomik.bobik@centrum.cz" class="form-control">
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="hesl0" class="form-control">
                    </div>
                    <div>
                        <label for="password_repeat" class="form-label">Repeat password</label>
                        <input type="password" name="password_confirmation" id="password_repeat" placeholder="hesl0" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mt-2">Submit</button>
                </form>

                <p id="errorlogger" class="text-danger small mt-2"></p>

                <div class="text-center mt-3">
                    <a href="/login" class="text-decoration-none">
                        <h4 class="h6 text-muted">Don't have an account? Login</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
