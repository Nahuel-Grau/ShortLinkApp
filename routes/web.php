<?php

use App\Http\Controllers\shortLinkController;
use App\Http\Middleware\CountClicks;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{url}',[shortLinkController::class, 'redirect'])
    ->name('shortlinks.redirect')->middleware(CountClicks::class);