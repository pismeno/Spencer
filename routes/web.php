<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// GROUPS ROUTES
Route::get('/group/create', [GroupController::class, 'create'])
    ->middleware('auth')->name('group.create');

Route::post('/group/create', [GroupController::class, 'store'])
    ->middleware('auth')->name('group.store');
Route::post('/group/edit', [GroupController::class, 'update'])
    ->middleware('auth');

// EVENT ROUTES
Route::get('/event/create', [EventController::class, 'create'])
    ->middleware('auth')->name('event.create');

Route::post('/event/create', [EventController::class, 'store'])
    ->middleware('auth')->name('event.store');
Route::post('/event/edit', [EventController::class, 'update'])
    ->middleware('auth')->name('event.update');
// List events
Route::get('/listevents', [EventController::class, 'list'])->name('event.list');
// List users
Route::post('/listusers', [UserController::class, 'list'])->name('user.list');
