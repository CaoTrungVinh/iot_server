<?php

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

Route::post("/storetemps", [\App\Http\Controllers\Api\DS18B20Controller::class, 'store']);
Route::get('/datatemp', [\App\Http\Controllers\Api\DS18B20Controller::class, 'getdata']);
Route::get('/datatemplast', [\App\Http\Controllers\Api\DS18B20Controller::class, 'gettemplast']);
Route::post("/warningtemp", [\App\Http\Controllers\Api\DS18B20Controller::class, 'warning_temp']);
Route::get("/temp_safe", [\App\Http\Controllers\Api\DS18B20Controller::class, 'temp_safe']);

Route::post("/storelight", [\App\Http\Controllers\Api\NVZ1Controller::class, 'store']);
Route::get('/datalight', [\App\Http\Controllers\Api\NVZ1Controller::class, 'getdata']);
Route::get('/datalightlast', [\App\Http\Controllers\Api\NVZ1Controller::class, 'getlightlast']);

Route::post("/storeph", [\App\Http\Controllers\Api\PHController::class, 'store']);
Route::get('/dataph', [\App\Http\Controllers\Api\PHController::class, 'getdata']);
Route::get('/dataphlast', [\App\Http\Controllers\Api\PHController::class, 'getphlast']);
Route::post("/warningph", [\App\Http\Controllers\Api\PHController::class, 'warning_ph']);
Route::get("/ph_safe", [\App\Http\Controllers\Api\PHController::class, 'ph_safe']);