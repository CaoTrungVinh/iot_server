<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DHT11Controller;


//Route::get('/', function () {
//    return view('pages.home');
//})->name('home');
//Route::get('/dht11', function () {
//    return view('pages.dht11');
//})->name('dht11');

Route::get('/fcm', [App\Http\Controllers\Controller::class, 'index'])->name('fcm');
Route::get('/send-notification', [App\Http\Controllers\Controller::class, 'sendNotification'])->name('send-notification');

//Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post( 'register', [\App\Http\Controllers\Auth\RegisterController::class, 'doRegister'])->name( 'register' );
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegister'])->name('register');
Route::get( 'confirmemail/{email}/{key}', [\App\Http\Controllers\Auth\RegisterController::class, 'confirmEmail'] )->name( 'confirmemail' );

//  route admin
Route::get('login', [\App\Http\Controllers\Admin\AdminLoginController::class, 'showLogin'])->name('login');
Route::post('postAdminLogin', [\App\Http\Controllers\Admin\AdminLoginController::class, 'postLogin'])->name('postAdLogin');
Route::get('getAdminLogout', [\App\Http\Controllers\Admin\AdminLoginController::class, 'getLogout'])->name('getAdLogout');

//Route::get('/DHT11', 'DHT11Controller@index');
Route::get('/DHT11', [\App\Http\Controllers\Admin\DHT11Controller::class, 'index']);
Route::get('/DHT11/{id}', 'DHT11Controller@view');



Route::get('/forgot_password', function () {
    return view('auth.forgot-password');
})->name('forgot_password');
