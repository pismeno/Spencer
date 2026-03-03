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
Route::post('/register', [AuthController::class, 'register'])
    ->name('api.register');
Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('api.logout');

// USER ROUTES
// patch
Route::patch('/user/profile', [AuthController::class, 'updateProfile'])
    ->name('api.user.profile.update')
    ->middleware('auth:sanctum');
Route::patch('/user/settings', [SettingController::class, 'update']) // TODO change deceiving method names
    ->name('api.user.settings.update')
    ->middleware('auth:sanctum');

// get
Route::get('/users', [UserController::class, 'search'])
    ->name('api.user.search'); // List users

//delete
Route::delete('/user', [UserController::class, 'deleteAccount'])
    ->middleware('auth:sanctum')
    ->name('api.user.delete');

// EVENT ROUTES
// get
Route::get('/events', [EventController::class, 'search'])
    ->name('api.event.search'); // List events

// post
Route::post('/event', [EventController::class, 'store'])
    ->middleware('auth:sanctum')
    ->name('api.event.store');

// patch
Route::patch('/event/{event}', [EventController::class, 'update'])
    ->middleware('auth:sanctum')
    ->name('api.event.update');
Route::patch('/event/{event}/attendance', [EventController::class, 'setAttendance'])
    ->middleware('auth:sanctum')
    ->name('api.event.setAttendance');

// GROUP ROUTES
// get
Route::get('/groups', [GroupController::class, 'search'])
    ->middleware('auth:sanctum')
    ->name('api.group.search'); // List groups

// post
Route::post('/group', [GroupController::class, 'store'])
    ->middleware('auth:sanctum')
    ->name('api.group.store');
Route::post('/group/{group}/members', [GroupController::class, 'addMembers'])
    ->middleware('auth:sanctum')
    ->name('api.group.members.add');

// patch
Route::patch('/group/{group}', [GroupController::class, 'update'])
    ->middleware('auth:sanctum')
    ->name('api.group.update');

// delete
Route::delete('/group/{group}', [GroupController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('api.group.delete');
Route::delete('/group/{group}/members', [GroupController::class, 'destroyMembers'])
    ->middleware('auth:sanctum')
    ->name('api.group.members.destroy');

// NOTIFICATION ROUTES
// patch
Route::patch('/notifications/{id}/read', [NotificationController::class, 'read']) // Mark one notification as read
    ->middleware('auth:sanctum')
    ->name('api.notifications.read');
Route::patch('/notifications/read-all', [NotificationController::class, 'readAll']) // Mark all notifications as read
    ->middleware('auth:sanctum')
    ->name('api.notifications.readAll');
