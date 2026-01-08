<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/group', function () {
    return view('group');
});

Route::get('/notifications', function () {
    return view('notifications');
});

Route::get('/settings', function () {
    return view('settings');
});


// AUTHENTICATION ROUTES
Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
