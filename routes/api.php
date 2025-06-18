<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shortLinkController;

Route::post('/shortlinks',[shortLinkController::class, 'store'])
    ->name('shortlinks.store');

Route::get('/{url}',[shortLinkController::class, 'redirect'])
    ->name('shortlinks.redirect');