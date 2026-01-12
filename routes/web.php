<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->middleware('auth');;

Route::get('/event', function () {
    return view('event');
})->middleware('auth');;

Route::get('/group', function () {
    return view('group');
})->middleware('auth');;

Route::get('/notifications', function () {
    return view('notifications');
})->middleware('auth');;

Route::get('/settings', function () {
    return view('settings');
})->middleware('auth');;


// AUTHENTICATION ROUTES
Route::get('/register', function () {
    return view('auth/register');
})->name('register');

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
