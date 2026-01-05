<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('test');
});

Route::post('/submit', [TestController::class, 'test']);
