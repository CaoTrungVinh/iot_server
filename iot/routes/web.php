<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DHT11Controller;

Route::get('/fcm', [App\Http\Controllers\Controller::class, 'index'])->name('fcm');
Route::get('/send-notification', [App\Http\Controllers\Controller::class, 'sendNotification'])->name('send-notification');

//  Đăng ký, active tài khoản
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegister'])->name('register');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'doRegister'])->name('postRegister');
Route::get('confirmemailRegister/{email}/{key}', [\App\Http\Controllers\Auth\RegisterController::class, 'confirmEmail'])->name('confirmemailRegister');

//  route admin
Route::get('adminLogin', [\App\Http\Controllers\Admin\AdminLoginController::class, 'showLogin'])->name('adLogin');
Route::post('postAdminLogin', [\App\Http\Controllers\Admin\AdminLoginController::class, 'postLogin'])->name('postAdLogin');
Route::get('getAdminLogout', [\App\Http\Controllers\Admin\AdminLoginController::class, 'getLogout'])->name('getAdLogout');

//      Quên mật khẩu của admin
Route::get('adminForgotPass', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgotPass'])->name('AdForgotPass');
Route::post('adminPostForgotPass', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'doForgotPass'])->name('postAdForgotPass');

//
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginUser'])->name('userLogin');
Route::post('postLogin', [\App\Http\Controllers\Auth\LoginController::class, 'postUserLogin'])->name('postUsLogin');
Route::get('getUserLogout', [\App\Http\Controllers\Auth\LoginController::class, 'getUserLogout'])->name('getUsLogout');

Route::get('forgotPass', [\App\Http\Controllers\User\UserAuthController::class, 'showForgotPass'])->name('forgotPass');
Route::post('postForgotPass', [\App\Http\Controllers\User\UserAuthController::class, 'doForgotPass'])->name('postForgotPass');

Route::group(['middleware' => 'checkUserLogin'], function () {
    Route::get('/', [\App\Http\Controllers\User\IndexUserController::class, 'indexUser']);
    Route::get('/home', [\App\Http\Controllers\User\IndexUserController::class, 'indexUser'])->name('homeUs');
    Route::get('/changePass', [\App\Http\Controllers\User\UserAuthController::class, 'userChangePass'])->name('userChangePass');
    Route::post('/postChangePass', [\App\Http\Controllers\User\UserAuthController::class, 'doChangePass'])->name('userpostChangePass');
//      Profile, update profile
    Route::get('/profile', [\App\Http\Controllers\User\UserAuthController::class, 'showProfileUser'])->name('userProfile');
    Route::post('/updateProfile', [\App\Http\Controllers\User\UserAuthController::class, 'updateProfileUser'])->name('userupdateProfile');

//
    Route::get('/pond/singup', [\App\Http\Controllers\User\ConfigPondController::class, 'showSingup'])->name('pondSingup');
    Route::post('/postSingupPond', [\App\Http\Controllers\User\ConfigPondController::class, 'doSingup'])->name('postSingup');
    Route::get('/pond/editInfo/{id}', [\App\Http\Controllers\User\ConfigPondController::class, 'showViewEdit'])->name('pondEdit');
    Route::post('/pond/updateInfo/{id}', [\App\Http\Controllers\User\ConfigPondController::class, 'update'])->name('pondUpdate');
    Route::get('/delete/pond/{id}', [\App\Http\Controllers\User\ConfigPondController::class, 'delete'])->name('pondDelete');

//
    Route::get('/toolkit/config', [\App\Http\Controllers\User\ConfigToolkitController::class, 'showView'])->name('configToolkit');
    Route::get('/toolkit/view/{id}', [\App\Http\Controllers\User\ConfigToolkitController::class, 'showToolkit']);
    Route::get('/toolkit/singup', [\App\Http\Controllers\User\ConfigToolkitController::class, 'showSingup'])->name('showToolSingup');
    Route::post('/toolkit/postSingup', [\App\Http\Controllers\User\ConfigToolkitController::class, 'postSingup'])->name('postSingupToll');
    Route::get('/toolkit/updateInfo/{id}', [\App\Http\Controllers\User\ConfigToolkitController::class, 'updateInfo'])->name('ToolUpdate');
    Route::post('/toolkit/post/updateInfo/{id}', [\App\Http\Controllers\User\ConfigToolkitController::class, 'postUpdateInfo'])->name('postToolUpdate');
    Route::get('/delete/toolkit/{id}', [\App\Http\Controllers\User\ConfigToolkitController::class, 'deleteTool'])->name('toolDelete');

//
    Route::get('/control/config', [\App\Http\Controllers\User\ConfigControlController::class, 'showView'])->name('configControl');
    Route::get('/control/view/{id}', [\App\Http\Controllers\User\ConfigControlController::class, 'showControl']);
    Route::get('/control/singup', [\App\Http\Controllers\User\ConfigControlController::class, 'showSingup'])->name('controlSingup');
    Route::post('/control/postSingup', [\App\Http\Controllers\User\ConfigControlController::class, 'postSingup'])->name('postSingupControl');
    Route::get('/control/updateInfo/{id}', [\App\Http\Controllers\User\ConfigControlController::class, 'updateInfo'])->name('controlUpdate');
    Route::post('/control/post/updateInfo/{id}', [\App\Http\Controllers\User\ConfigControlController::class, 'postUpdateInfo'])->name('postControlUpdate');
    Route::get('/delete/control/{id}', [\App\Http\Controllers\User\ConfigControlController::class, 'deleteControl'])->name('controlDelete');

});


//   ---------------------------------------        --------------------------------------
Route::group(['middleware' => 'checkAdminLogin'], function () {
    Route::get('/admin', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
//      Đổi pass
    Route::get('/adminChangePass', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePass'])->name('adChangePass');
    Route::post('/postAdminChangePass', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'doChangePass'])->name('postAdChangePass');
//      Profile, update profile
    Route::get('/adminProfile', [\App\Http\Controllers\Admin\ProfileAdminController::class, 'showProfile'])->name('adProfile');
    Route::post('/UpdateAdminProfile', [\App\Http\Controllers\Admin\ProfileAdminController::class, 'updateProfile'])->name('updateAdProfile');
//    Quản lý tài khoản, thêm, sửa, xóa User
    Route::get('/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::get('/user/information/{id}', [\App\Http\Controllers\Admin\UserController::class, 'viewUser'])->name('view_user');
    Route::get('/createUser', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create_user');
    Route::post('/storeUser', [\App\Http\Controllers\Admin\UserController::class, 'storeUser'])->name('store_user');
    Route::post('/storeAdmin', [\App\Http\Controllers\Admin\UserController::class, 'storeAdmin'])->name('store_admin');
//    -------- Active mail------
    Route::get('confirmemail/{email}/{key}', [\App\Http\Controllers\Admin\UserController::class, 'confirmEmail'])->name('confirmemail');
//    -------------------------------------
    Route::get('/user/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user_edit');
    Route::post('/user/update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user_update');
    Route::get('/user/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user_delete');


    ///pond
    Route::get('/pond', [\App\Http\Controllers\Admin\PondController::class, 'index'])->name('pond');
    Route::get('/pond/info/{id}', [\App\Http\Controllers\Admin\PondController::class, 'viewPond'])->name('pond_infor');
    Route::get('/pond_create', [\App\Http\Controllers\Admin\PondController::class, 'create'])->name('pond_create');
    Route::post('/pond_create', [\App\Http\Controllers\Admin\PondController::class, 'store'])->name('pond_store');
    Route::get('/pond/edit/{id}', [\App\Http\Controllers\Admin\PondController::class, 'edit'])->name('pond_edit');
    Route::post('/pond_update', [\App\Http\Controllers\Admin\PondController::class, 'update'])->name('pond_update');
    Route::get('/pond/delete/{id}', [\App\Http\Controllers\Admin\PondController::class, 'delete'])->name('pond_delete');



    ////toolkit
    Route::get('/toolkit', [\App\Http\Controllers\Admin\ToolkitController::class, 'index'])->name('toolkit');
    Route::get('/toolkit/info/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'viewToolkit'])->name('toolkit_infor');
    Route::get('/toolkit_create', [\App\Http\Controllers\Admin\ToolkitController::class, 'create'])->name('toolkit_create');
    Route::post('/toolkit_create', [\App\Http\Controllers\Admin\ToolkitController::class, 'store'])->name('toolkit_store');
    Route::get('/toolkit/edit/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'edit'])->name('toolkit_edit');
    Route::post('/toolkit_update', [\App\Http\Controllers\Admin\ToolkitController::class, 'update'])->name('toolkit_update');
    Route::get('/toolkit/delete/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'delete'])->name('toolkit_delete');
    ////control
    Route::get('/control', [\App\Http\Controllers\Admin\ControlController::class, 'index'])->name('control');
    Route::get('/control/info/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'viewControl'])->name('control_infor');
    Route::get('/control_create', [\App\Http\Controllers\Admin\ControlController::class, 'create'])->name('control_create');
    Route::post('/control_create', [\App\Http\Controllers\Admin\ControlController::class, 'store'])->name('control_store');
    Route::get('/control/edit/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'edit'])->name('control_edit');
    Route::post('/control_update', [\App\Http\Controllers\Admin\ControlController::class, 'update'])->name('control_update');
    Route::get('/control/delete/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'delete'])->name('control_delete');

});

Route::get('verifile', function () {
    return view('pages.showRegister');
})->name('verifile');

Route::get('/404.html', function () {
    return view('pages.error.401');
})->name('404');

