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

// ------------------------ // --------------------------------------------------
Route::group(['middleware' => 'checkUserLogin'], function () {
    Route::get('/', [\App\Http\Controllers\User\IndexUserController::class, 'indexUser']);
    Route::get('/home', [\App\Http\Controllers\User\IndexUserController::class, 'indexUser'])->name('homeUs');
    Route::get('/changePass', [\App\Http\Controllers\User\UserAuthController::class, 'userChangePass'])->name('userChangePass');
    Route::post('/postChangePass', [\App\Http\Controllers\User\UserAuthController::class, 'doChangePass'])->name('userpostChangePass');
//      Profile, update profile
    Route::get('/profile', [\App\Http\Controllers\User\UserAuthController::class, 'showProfileUser'])->name('userProfile');
    Route::post('/updateProfile', [\App\Http\Controllers\User\UserAuthController::class, 'updateProfileUser'])->name('userupdateProfile');

//
    Route::get('/pond/config', [\App\Http\Controllers\User\ConfigPondController::class, 'showPond'])->name('pondConfig');
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
    Route::get('/admin/userAll', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::get('/admin/user/info/{id}', [\App\Http\Controllers\Admin\UserController::class, 'viewUser'])->name('view_user');
    Route::get('/admin/createUser', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create_user');
    Route::post('/admin/storeUser', [\App\Http\Controllers\Admin\UserController::class, 'storeUser'])->name('store_user');
    Route::post('/admin/storeAdmin', [\App\Http\Controllers\Admin\UserController::class, 'storeAdmin'])->name('store_admin');
//    -------- Active mail------
    Route::get('confirmemail/{email}/{key}', [\App\Http\Controllers\Admin\UserController::class, 'confirmEmail'])->name('confirmemail');

    //    -------------------------------------
    Route::get('/admin/user/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user_edit');
    Route::post('/admin/user/update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user_update');
    Route::get('/admin/user/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user_delete');


    ///pond
    Route::get('/admin/pond', [\App\Http\Controllers\Admin\PondController::class, 'index'])->name('pond');
    Route::get('/admin/pond/info/{id_pond}', [\App\Http\Controllers\Admin\PondController::class, 'viewPond'])->name('pond_infor');
    Route::get('/admin/pond/create', [\App\Http\Controllers\Admin\PondController::class, 'create'])->name('pond_create');
    Route::post('/admin/pond/create', [\App\Http\Controllers\Admin\PondController::class, 'store'])->name('pond_store');
    Route::get('/admin/pond/undo/{id}', [\App\Http\Controllers\Admin\PondController::class, 'undoPond'])->name('pondUndo');
    Route::get('/admin/pond/delete/{id}', [\App\Http\Controllers\Admin\PondController::class, 'delete'])->name('pond_delete');


    ////toolkit
    Route::get('/admin/toolkit', [\App\Http\Controllers\Admin\ToolkitController::class, 'index'])->name('toolkit');
    Route::get('/admin/toolkit/info/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'viewToolkit'])->name('toolkit_infor');
    Route::get('/admin/toolkit/create', [\App\Http\Controllers\Admin\ToolkitController::class, 'create'])->name('toolkit_create');
    Route::post('/admin/toolkit/create', [\App\Http\Controllers\Admin\ToolkitController::class, 'store'])->name('toolkit_store');
    Route::get('/admin/toolkit/undo/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'showViewUndo'])->name('toolkitUndo');
    Route::post('/admin/toolkit/postUndo/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'undoToolkit'])->name('toolkitPostUndo');
//    Route::post('/admin/toolkit_update', [\App\Http\Controllers\Admin\ToolkitController::class, 'update'])->name('toolkit_update');
    Route::get('/admin/toolkit/delete/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'delete'])->name('toolkit_delete');
    Route::get('/admin/toolkit/register', [\App\Http\Controllers\Admin\ToolkitController::class, 'showIndexRegisTool'])->name('re_toolkit');
    Route::get('/admin/toolkit/register/ok/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'okRegisterTool'])->name('okRegis_toolkit');
    Route::get('/admin/toolkit/register/cancel/{id}', [\App\Http\Controllers\Admin\ToolkitController::class, 'cancelRegisterTool'])->name('cancelRegis_toolkit');


    ////control
    Route::get('/admin/control', [\App\Http\Controllers\Admin\ControlController::class, 'index'])->name('control');
    Route::get('/admin/control/info/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'viewControl'])->name('control_infor');
    Route::get('/admin/control/create', [\App\Http\Controllers\Admin\ControlController::class, 'create'])->name('control_create');
    Route::post('/admin/control/create', [\App\Http\Controllers\Admin\ControlController::class, 'store'])->name('control_store');
    Route::get('/admin/control/undo/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'showViewUndo'])->name('control_undo');
    Route::post('/admin/control/postUndo/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'undoControl'])->name('control_postUndo');
    Route::get('/admin/control/delete/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'delete'])->name('control_delete');
    Route::get('/admin/control/register', [\App\Http\Controllers\Admin\ControlController::class, 'showIndexRegisControl'])->name('reControl');
    Route::get('/admin/control/register/ok/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'okRegisterControl'])->name('okRegis_control');
    Route::get('/admin/control/register/cancel/{id}', [\App\Http\Controllers\Admin\ControlController::class, 'cancelRegisterControl'])->name('cancelRegis_control');
});

Route::get('verifile', function () {
    return view('pages.showRegister');
})->name('verifile');

Route::get('/404.html', function () {
    return view('pages.error.401');
})->name('404');

