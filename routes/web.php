<?php

use App\Http\Controllers\shortLinkController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CountClicks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::post('/login',[UserController::class, 'login'])
    ->name('login');
    
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

route::get('/myLinks', function(){
    return view('layouts.myLinks');
})->middleware('auth');;
route::get('/shortener', function(){
    return view('layouts.showShortLink');
});


Route::post('/sync-session', function (Request $request) {
    $user = \App\Models\User::find($request->user_id);
    
    if ($user) {
        Auth::login($user);
        $request->session()->regenerate(); 
        return response()->json(['message' => 'Sesión web creada']);
    }
    
    return response()->json(['error' => 'Usuario no encontrado'], 404);
});

Route::get('/{url}',[shortLinkController::class, 'redirect'])
    ->name('shortlinks.redirect')->middleware(CountClicks::class);