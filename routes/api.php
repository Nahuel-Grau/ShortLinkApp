<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shortLinkController;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::post('/register',[UserController::class, 'register'])
    ->name('register');
    
    Route::middleware('auth')->get('/usuario-id',[UserController::class, 'me']);
Route::post('/login',[UserController::class, 'login'])
    ->name('login');

Route::post('/shortlinks',[shortLinkController::class, 'store'])
    ->name('shortlinks.store');

Route::get('/shortlinks', [shortLinkController::class, 'getLinkCount'])
    ->name('shortlinks.get');

Route::post('/shortlinks/delete/{id}', [shortLinkController::class, 'destroy'])->middleware('auth:api')
    ->name('shortlinks.destroy');

route::post('/logout', [shortLinkController::class, 'logout'])->middleware('auth:api');

    
