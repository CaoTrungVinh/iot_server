<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DHT11Controller;

Route::get('/fcm', [App\Http\Controllers\Controller::class, 'index'])->name('fcm');
Route::get('/send-notification', [App\Http\Controllers\Controller::class, 'sendNotification'])->name('send-notification');

//  Đăng ký, active tài khoản
//Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
//Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'doRegister'])->name('register');
//Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegister'])->name('register');
//Route::get('confirmemail/{email}/{key}', [\App\Http\Controllers\Auth\RegisterController::class, 'confirmEmail'])->name('confirmemail');

//  route admin
Route::get('adminLogin', [\App\Http\Controllers\Admin\AdminLoginController::class, 'showLogin'])->name('adLogin');
Route::post('postAdminLogin', [\App\Http\Controllers\Admin\AdminLoginController::class, 'postLogin'])->name('postAdLogin');
Route::get('getAdminLogout', [\App\Http\Controllers\Admin\AdminLoginController::class, 'getLogout'])->name('getAdLogout');
//      Quên mật khẩu của admin
Route::get('adminForgotPass', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgotPass'])->name('AdForgotPass');
Route::post('postAdminForgotPass', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'doForgotPass'])->name('postAdForgotPass');

Route::group(['middleware' => 'checkAdminLogin'], function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
//      Đổi pass
    Route::get('/adminChangePass', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePass'])->name('adChangePass');
    Route::post('/postAdminChangePass', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'doChangePass'])->name('postAdChangePass');
//      Profile, update profile
    Route::get('/adminProfile', [\App\Http\Controllers\Admin\ProfileAdminController::class, 'showProfile'])->name('adProfile');
    Route::post('/UpdateAdminProfile', [\App\Http\Controllers\Admin\ProfileAdminController::class, 'updateProfile'])->name('updateAdProfile');
//    Quản lý tài khoản, thêm, sửa, xóa User
    Route::get('/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');


//    -----------------------------------
    Route::get('/view_user/{id}', [\App\Http\Controllers\Admin\UserController::class, 'viewUser'])->name('view_user');



    Route::get('/createUser', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create_user');
    Route::post('/storeUser', [\App\Http\Controllers\Admin\UserController::class, 'storeUser'])->name('store_user');
    Route::post('/storeAdmin', [\App\Http\Controllers\Admin\UserController::class, 'storeAdmin'])->name('store_admin');
    Route::get('confirmemail/{email}/{key}', [\App\Http\Controllers\Admin\UserController::class, 'confirmEmail'])->name('confirmemail');
    Route::get('/user_edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user_edit');
    Route::post('/user_update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user_update');


    ///pond
    Route::get('/pond', [\App\Http\Controllers\Admin\PondController::class, 'index'])->name('pond');
    Route::get('/pond_create', [\App\Http\Controllers\Admin\PondController::class, 'create'])->name('pond_create');
    Route::post('/pond_create', [\App\Http\Controllers\Admin\PondController::class, 'store'])->name('pond_store');
    Route::get('/pond/{id}/edit', [\App\Http\Controllers\Admin\PondController::class, 'edit'])->name('pond/{id}/edit');
    Route::post('/pond_update', [\App\Http\Controllers\Admin\PondController::class, 'update'])->name('pond_update');
    Route::get('/pond/{id}/delete', [\App\Http\Controllers\Admin\PondController::class, 'delete'])->name('pond/{id}/delete');



    ////toolkit
    Route::get('/toolkit', [\App\Http\Controllers\Admin\ToolkitController::class, 'index'])->name('toolkit');
    Route::get('/toolkit_create', [\App\Http\Controllers\Admin\ToolkitController::class, 'create'])->name('toolkit_create');
    Route::post('/toolkit_create', [\App\Http\Controllers\Admin\ToolkitController::class, 'store'])->name('toolkit_store');
    Route::get('/toolkit/{id}/edit', [\App\Http\Controllers\Admin\ToolkitController::class, 'edit'])->name('toolkit/{id}/edit');
    Route::post('/toolkit_update', [\App\Http\Controllers\Admin\ToolkitController::class, 'update'])->name('toolkit_update');
    Route::get('/toolkit/{id}/delete', [\App\Http\Controllers\Admin\ToolkitController::class, 'delete'])->name('toolkit/{id}/delete');
    ////control
    Route::get('/control', [\App\Http\Controllers\Admin\ControlController::class, 'index'])->name('control');
    Route::get('/control_create', [\App\Http\Controllers\Admin\ControlController::class, 'create'])->name('control_create');
    Route::post('/control_create', [\App\Http\Controllers\Admin\ControlController::class, 'store'])->name('control_store');
    Route::get('/control/{id}/edit', [\App\Http\Controllers\Admin\ControlController::class, 'edit'])->name('control/{id}/edit');
    Route::post('/control_update', [\App\Http\Controllers\Admin\ControlController::class, 'update'])->name('control_update');
    Route::get('/control/{id}/delete', [\App\Http\Controllers\Admin\ControlController::class, 'delete'])->name('control/{id}/delete');

});

Route::get('verifile', function () {
    return view('pages.showRegister');
})->name('verifile');

Route::get('/404.html', function () {
    return view('pages.error.401');
})->name('404');

