<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

// MAIN ROUTES`
// views
Route::get('/', function() {
    return view('index');
})->middleware('auth');

// AUTHENTICATION ROUTES
// views
Route::get('/register', function () {
    return view('auth/register');
})->name('register');

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::get('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');

// SETTINGS ROUTES
// views
Route::get('/settings', function () {
    return view('settings');
})->middleware('auth');

// GROUPS ROUTES
// get
Route::get('/groups', [GroupController::class, 'index'])
    ->middleware('auth')
    ->name('group.index');

Route::get('/group/create', [GroupController::class, 'create'])
    ->middleware('auth')
    ->name('group.create');

// EVENT ROUTES
// get
Route::get('/events', function () {
    return view('showEvent');
})->middleware('auth');

Route::get('/event/{event}', [EventController::class, 'show'])
    ->middleware('auth')
    ->name('event.show');

Route::get('/event/create', [EventController::class, 'create'])
    ->middleware('auth')
    ->name('event.create');

// NOTIFICATION ROUTES
// views
Route::get('/notifications', function () {
    return view('notifications');
})->middleware('auth');
