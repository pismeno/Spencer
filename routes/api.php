<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// AUTHENTICATION ROUTES
// post
Route::post('/user/register', [AuthController::class, 'register'])
    ->name('user.register');
Route::post('/user/login', [AuthController::class, 'login'])
    ->name('user.login');

// USER ROUTES
// get
Route::get('/users', [UserController::class, 'search'])
    ->name('user.search'); // List users

//delete
Route::delete('/user/delete', [UserController::class, 'deleteAccount'])
    ->middleware('auth')
    ->name('user.delete');

// EVENT ROUTES
// get
Route::get('/events', [EventController::class, 'search'])
    ->name('event.search'); // List events

// post
Route::post('/event/create', [EventController::class, 'store'])
    ->middleware('auth')
    ->name('event.store');
Route::post('/event/{event}/edit', [EventController::class, 'update'])
    ->middleware('auth')
    ->name('event.update');
Route::post('/event/{event}/set-attends', [EventController::class, 'setAttendance'])
    ->middleware('auth')
    ->name('event.setAttendance');

// GROUP ROUTES
// post
Route::post('/group/create', [GroupController::class, 'store'])
    ->middleware('auth')
    ->name('group.store');
Route::post('/group/{group}/edit', [GroupController::class, 'update'])
    ->middleware('auth')
    ->name('group.update');

// delete
Route::delete('/group/{group}/delete', [GroupController::class, 'destroy'])
    ->middleware('auth')
    ->name('group.delete');
Route::get('/groups', [GroupController::class, 'search'])
    ->middleware('auth')
    ->name('group.search'); // List groups

// NOTIFICATION ROUTES
// post
Route::post('/notifications/{id}/read', [NotificationController::class, 'read']) // Mark one notification as read
    ->middleware('auth')
    ->name('notifications.read');
Route::post('/notifications/read-all', [NotificationController::class, 'readAll']) // Mark all notifications as read
    ->middleware('auth')
    ->name('notifications.readAll');

// SETTINGS ROUTES
// get
Route::get('/settings', [SettingController::class, 'search'])
    ->name('settings.search')
    ->middleware('auth');

// post
// TODO change deceiving method names
Route::post('/settings/options', [SettingController::class, 'update'])
    ->name('settings.update')
    ->middleware('auth');

Route::post('/settings/profile', [AuthController::class, 'updateProfile'])
    ->name('profile.update')
    ->middleware('auth');
