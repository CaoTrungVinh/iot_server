<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DHT11Controller;

Route::get('/fcm', [App\Http\Controllers\Controller::class, 'index'])->name('fcm');
Route::get('/send-notification', [App\Http\Controllers\Controller::class, 'sendNotification'])->name('send-notification');

Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'doRegister'])->name('register');
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegister'])->name('register');
Route::get('confirmemail/{email}/{key}', [\App\Http\Controllers\Auth\RegisterController::class, 'confirmEmail'])->name('confirmemail');

//  route admin
Route::get('adminLogin', [\App\Http\Controllers\Admin\AdminLoginController::class, 'showLogin'])->name('adLogin');
Route::post('postAdminLogin', [\App\Http\Controllers\Admin\AdminLoginController::class, 'postLogin'])->name('postAdLogin');
Route::get('getAdminLogout', [\App\Http\Controllers\Admin\AdminLoginController::class, 'getLogout'])->name('getAdLogout');

Route::get('adminForgotPass', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgotPass'])->name('AdForgotPass');
Route::post('postAdminForgotPass', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'doForgotPass'])->name('postAdForgotPass');

Route::group(['middleware' => 'checkAdminLogin'], function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('adminProfile', [\App\Http\Controllers\Admin\ProfileAdminController::class, 'showProfile'])->name('adProfile');

    ///////
    Route::get('/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::get('/addUser', [\App\Http\Controllers\Admin\UserController::class, 'showAddUser'])->name('add_user');
    Route::get('/user_edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user_edit');
    ///pond
    Route::get('/pond', [\App\Http\Controllers\Admin\PondController::class, 'index'])->name('pond');
    Route::get('/pond_create', [\App\Http\Controllers\Admin\PondController::class, 'create'])->name('pond_create');
    Route::post('/pond_create', [\App\Http\Controllers\Admin\PondController::class, 'store'])->name('pond_store');
    Route::get('/pond/{id}/edit', [\App\Http\Controllers\Admin\PondController::class, 'edit'])->name('pond/{id}/edit');
    Route::post('/pond_update', [\App\Http\Controllers\Admin\PondController::class, 'update'])->name('pond_update');
    Route::get('/pond/{id}/delete', [\App\Http\Controllers\Admin\PondController::class, 'delete'])->name('pond/{id}/delete');
    ////toolkit
    Route::get('/toolkit', [\App\Http\Controllers\Admin\ToolkitController::class, 'index'])->name('toolkit');
    Route::get('/toolkit_store', [\App\Http\Controllers\Admin\ToolkitController::class, 'store'])->name('toolkit_store');
    Route::get('/toolkit_edit', [\App\Http\Controllers\Admin\ToolkitController::class, 'edit'])->name('toolkit_edit');
    ////control
    Route::get('/control', [\App\Http\Controllers\Admin\ControlController::class, 'index'])->name('control');
    Route::get('/control_store', [\App\Http\Controllers\Admin\ControlController::class, 'store'])->name('control_store');
    Route::get('/control_edit', [\App\Http\Controllers\Admin\ControlController::class, 'edit'])->name('control_edit');

});

Route::get('verifile', function () {
    return view('pages.showRegister');
})->name('verifile');

Route::get('/404.html', function () {
    return view('pages.error.401');
})->name('404');

