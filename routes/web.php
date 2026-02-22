<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('index');
})->middleware('auth');

Route::get('/event', function () {
    return view('event');
})->middleware('auth');

Route::get('/group', [GroupController::class, 'index'])->middleware('auth')->name('group.index');

Route::get('/notifications', function () {
    return view('notifications');
})->middleware('auth');

Route::get('/settings', function () {
    return view('settings');
})->middleware('auth');


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

Route::delete('/settings/delete-account', [AuthController::class, 'deleteAccount'])
    ->name('profile.delete')
    ->middleware('auth');

// GROUPS ROUTES
Route::get('/group/create', [GroupController::class, 'create'])
    ->middleware('auth')->name('group.create');

Route::post('/group/create', [GroupController::class, 'store'])
    ->middleware('auth')->name('group.store');
Route::post('/group/edit/{group}', [GroupController::class, 'update'])
    ->middleware('auth')->name('group.update');

// EVENT ROUTES
Route::get('/event/create', [EventController::class, 'create'])
    ->middleware('auth')->name('event.create');

Route::post('/event/create', [EventController::class, 'store'])
    ->middleware('auth')->name('event.store');
Route::post('/event/edit', [EventController::class, 'update'])
    ->middleware('auth')->name('event.update');
// List events
Route::post('/listevents', [EventController::class, 'list'])->name('event.list');
// List users
Route::post('/listusers', [UserController::class, 'list'])->name('user.list');
// List groups
Route::post('/listgroups', [GroupController::class, 'list'])->name('group.list');

// NOTIFICATION ROUTES
// Mark one notification as read
Route::post('/notifications/{id}/read', [NotificationController::class, 'read'])
    ->name('notifications.read')->middleware('auth');
// Mark all notifications as read
Route::post('/notifications/readall', [NotificationController::class, 'readAll'])
    ->name('notifications.readAll')->middleware('auth');

// Setting routes

Route::get('/settings', [SettingController::class, 'list'])->name('settings.list')
    ->middleware('auth');

Route::post('/settings/options', [SettingController::class, 'update'])->name('settings.update')
    ->middleware('auth');

Route::post('/settings/profile', [AuthController::class, 'updateProfile'])->name('profile.update')
    ->middleware('auth');