<?php

use App\Http\Controllers\shortLinkController;
use App\Http\Middleware\CountClicks;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts/shortLink');
});

route::get('/login', function(){
    return view('layouts/login');
});

route::get('/register', function(){
    return view('layouts/register');
});

route::post('/logout', function(){
    return view('layouts.shortLink');
});
route::get('/myLinks', function(){
    return view('layouts.myLinks');
});

Route::get('/{url}',[shortLinkController::class, 'redirect'])
    ->name('shortlinks.redirect')->middleware(CountClicks::class);