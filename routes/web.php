<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\URLShortenerController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/shorten', [URLShortenerController::class, 'create']);
Route::get('/{shortCode}', [URLShortenerController::class, 'redirect']);
