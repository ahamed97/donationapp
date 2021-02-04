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


Route::post('register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('password/email', [App\Http\Controllers\API\AuthController::class, 'checkRequest']);
Route::put('profile/update', [App\Http\Controllers\API\AuthController::class, 'profileUpdate']);
Route::get('profile', [App\Http\Controllers\API\AuthController::class, 'profile']);
Route::put('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);


Route::group(['middleware' => 'api'], function () {
    //Route::get('test', [App\Http\Controllers\API\TestController::class, 'index']);
    Route::get('vehicle-types', [App\Http\Controllers\API\VehicleTypeController::class, 'index']);
    Route::get('districts', [App\Http\Controllers\API\DistrictController::class, 'index']);
});
