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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Lấy danh sách
//Route::get('temp', 'Api\DHT11Controller@index')->name('temp.index');
Route::get('/temp', [\App\Http\Controllers\Api\DHT11Controller::class, 'index']);

Route::get('/device', [\App\Http\Controllers\Api\DeviceController::class, 'getdata']);
Route::post("/storetemp", [\App\Http\Controllers\Api\DHT11Controller::class, 'store']);

// nhiệt độ
Route::post("/storetemps", [\App\Http\Controllers\Api\TemperatureController::class, 'store']);
Route::get('/datatemp', [\App\Http\Controllers\Api\TemperatureController::class, 'getdata']);
Route::get('/datatemplast', [\App\Http\Controllers\Api\TemperatureController::class, 'gettemplast']);
Route::post("/warningtemp", [\App\Http\Controllers\Api\TemperatureController::class, 'warning_temp']);
Route::get("/temp_safe", [\App\Http\Controllers\Api\TemperatureController::class, 'temp_safe']);

// ánh sáng
Route::post("/storelight", [\App\Http\Controllers\Api\LightController::class, 'store']);
Route::get('/datalight', [\App\Http\Controllers\Api\LightController::class, 'getdata']);
Route::get('/datalightlast', [\App\Http\Controllers\Api\LightController::class, 'getlightlast']);

// độ Ph
Route::post("/storeph", [\App\Http\Controllers\Api\PHController::class, 'store']);
Route::get('/dataph', [\App\Http\Controllers\Api\PHController::class, 'getdata']);
Route::get('/dataphlast', [\App\Http\Controllers\Api\PHController::class, 'getphlast']);
Route::post("/warningph", [\App\Http\Controllers\Api\PHController::class, 'warning_ph']);
Route::get("/ph_safe", [\App\Http\Controllers\Api\PHController::class, 'ph_safe']);

// bơm vào
Route::post("/on_off_pumpin", [Device_PumpIn_Controller::class, 'on_off']);
Route::post("/timer_on_off_pumpin", [Device_PumpIn_Controller::class, 'timer_on_off']);
Route::get("/get_pump_in", [Device_PumpIn_Controller::class, 'get_pump_in']);

//bơm ra
Route::post("/on_off_pumpout", [Device_PumpOut_Controller::class, 'on_off']);
Route::post("/timer_on_off_pumpout", [Device_PumpOut_Controller::class, 'timer_on_off']);
Route::get("/get_pump_out", [Device_PumpOut_Controller::class, 'get_pump_out']);

//đèn
Route::post("/on_off_lamp", [Device_Lamp_Controller::class, 'on_off']);
Route::post("/timer_on_off_lamp", [Device_Lamp_Controller::class, 'timer_on_off']);
Route::get("/get_lamp", [Device_Lamp_Controller::class, 'get_lamp']);

//quạt oxy
Route::post("/on_off_oxygen_fan", [Device_Oxygen_Fan_Controller::class, 'on_off']);
Route::post("/timer_on_off_oxygen_fan", [Device_Oxygen_Fan_Controller::class, 'timer_on_off']);
Route::get("/get_oxygen_fan", [Device_Oxygen_Fan_Controller::class, 'get_oxygen_fan']);