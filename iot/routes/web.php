<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DHT11Controller;


Route::get('/', function () {
    return view('pages.home');
})->name('home');
//Route::get('/dht11', function () {
//    return view('pages.dht11');
//})->name('dht11');

//Route::get('/DHT11', 'DHT11Controller@index');
Route::get('/DHT11', [\App\Http\Controllers\Admin\DHT11Controller::class, 'index']);
Route::get('/DHT11/{id}', 'DHT11Controller@view');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/forgot_password', function () {
    return view('auth.forgot-password');
})->name('forgot_password');