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
Route::get('/toolkit', [\App\Http\Controllers\Api\PondController::class, 'toolkit']);
Route::get('/control', [\App\Http\Controllers\Api\PondController::class, 'control']);
Route::get('/temperature', [\App\Http\Controllers\Api\PondController::class, 'temperature']);
Route::get('/light', [\App\Http\Controllers\Api\PondController::class, 'light']);
Route::get('/ph', [\App\Http\Controllers\Api\PondController::class, 'ph']);
Route::put('/setWarningTemp', [\App\Http\Controllers\Api\PondController::class, 'setWarningTemp']);
Route::put('/setWarningPh', [\App\Http\Controllers\Api\PondController::class, 'setWarningPh']);
Route::put('/setWarningTemp_onoff', [\App\Http\Controllers\Api\PondController::class, 'setWarningTemp_onoff']);
Route::put('/setWarningPh_onoff', [\App\Http\Controllers\Api\PondController::class, 'setWarningPh_onoff']);
Route::put('/setWarningLight_onoff', [\App\Http\Controllers\Api\PondController::class, 'setWarningLight_onoff']);
Route::get('/pump_in', [\App\Http\Controllers\Api\PondController::class, 'pump_in']);
Route::put('/setPumpIn_onoff', [\App\Http\Controllers\Api\PondController::class, 'setPumpIn_onoff']);
Route::get('/pump_out', [\App\Http\Controllers\Api\PondController::class, 'pump_out']);
Route::put('/setPumpOut_onoff', [\App\Http\Controllers\Api\PondController::class, 'setPumpOut_onoff']);
Route::get('/lamp', [\App\Http\Controllers\Api\PondController::class, 'lamp']);
Route::put('/setLamp_onoff', [\App\Http\Controllers\Api\PondController::class, 'setLamp_onoff']);
Route::get('/oxygen_fan', [\App\Http\Controllers\Api\PondController::class, 'oxygen_fan']);
Route::put('/setOxygen_fan_onoff', [\App\Http\Controllers\Api\PondController::class, 'setOxygen_fan_onoff']);
Route::put('/set_timer_pump_in', [\App\Http\Controllers\Api\PondController::class, 'set_timer_pump_in']);
Route::put('/set_timer_pump_out', [\App\Http\Controllers\Api\PondController::class, 'set_timer_pump_out']);
Route::put('/set_timer_lamp', [\App\Http\Controllers\Api\PondController::class, 'set_timer_lamp']);
Route::put('/set_timer_oxygen_fan', [\App\Http\Controllers\Api\PondController::class, 'set_timer_oxygen_fan']);

//fcm
Route::post('/token_fcm', [\App\Http\Controllers\Api\PondController::class, 'token_fcm']);
Route::delete('/delete_fcm', [\App\Http\Controllers\Api\PondController::class, 'delete_fcm']);


Route::put('/server_temp', [\App\Http\Controllers\Api\PondController::class, 'server_temp']);
Route::put('/server_ph', [\App\Http\Controllers\Api\PondController::class, 'server_ph']);
Route::put('/server_light', [\App\Http\Controllers\Api\PondController::class, 'server_light']);

Route::put('/activetoolkit', [\App\Http\Controllers\Api\PondController::class, 'activetoolkit']);
Route::put('/setDataTemp', [\App\Http\Controllers\Api\PondController::class, 'setDataTemp']);
Route::put('/setDataPh', [\App\Http\Controllers\Api\PondController::class, 'setDataPh']);
Route::put('/setDataLight', [\App\Http\Controllers\Api\PondController::class, 'setDataLight']);

Route::put('/activeControl', [\App\Http\Controllers\Api\PondController::class, 'activeControl']);
Route::get('/getDataPumpIn', [\App\Http\Controllers\Api\PondController::class, 'getDataPumpIn']);
Route::get('/getDataPumpOut', [\App\Http\Controllers\Api\PondController::class, 'getDataPumpOut']);
Route::get('/getDataLamp', [\App\Http\Controllers\Api\PondController::class, 'getDataLamp']);
Route::get('/getDataOxygenFan', [\App\Http\Controllers\Api\PondController::class, 'getDataOxygenFan']);

Route::put('/setAutoTemp', [\App\Http\Controllers\Api\PondController::class, 'setAutoTemp']);
Route::put('/setAutoPh', [\App\Http\Controllers\Api\PondController::class, 'setAutoPh']);
Route::put('/setAutoLight', [\App\Http\Controllers\Api\PondController::class, 'setAutoLight']);