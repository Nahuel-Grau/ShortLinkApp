<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shortLinkController;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::post('/register',[UserController::class, 'register'])
    ->name('register');

Route::post('/login',[UserController::class, 'login'])
    ->name('login');


Route::post('/shortlinks',[shortLinkController::class, 'store'])
    ->name('shortlinks.store');

Route::get('/shortlinks', [shortLinkController::class, 'index'])
    ->name('shortlinks.get');

Route::post('/shortlinks/delete/{id}', [shortLinkController::class, 'destroy'])
    ->name('shortlinks.destroy');

