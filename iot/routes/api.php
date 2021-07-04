<?php

use App\Http\Controllers\Api\Device_Lamp_Controller;
use App\Http\Controllers\Api\Device_Oxygen_Fan_Controller;
use App\Http\Controllers\Api\Device_PumpIn_Controller;
use App\Http\Controllers\Api\Device_PumpOut_Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [\App\Http\Controllers\Api\Auth\UserAuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\Api\Auth\UserAuthController::class, 'register']);
    Route::post('forgotPass', [\App\Http\Controllers\Api\Auth\UserAuthController::class, 'forgotPass']);
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', [\App\Http\Controllers\Api\Auth\UserAuthController::class, 'logout']);
        Route::get('user', [\App\Http\Controllers\Api\Auth\UserAuthController::class, 'user']);
        Route::get('profile',[\App\Http\Controllers\Api\Auth\ProfileUser::class, 'profile']);
        Route::post('updateProfile',[\App\Http\Controllers\Api\Auth\ProfileUser::class, 'updateProfile']);
        // change pass
        Route::post('changePassword',[\App\Http\Controllers\Api\Auth\ProfileUser::class, 'changePassword']);
    });
});

Route::get('/pond', [\App\Http\Controllers\Api\PondController::class, 'pond']);

