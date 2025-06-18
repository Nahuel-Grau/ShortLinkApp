<?php

use App\Http\Controllers\shortLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{url}',[shortLinkController::class, 'redirect'])
    ->name('shortlinks.redirect');