<?php

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
