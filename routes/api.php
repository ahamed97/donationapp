<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DistrictController;
use App\Http\Controllers\API\DonationController;
use App\Http\Controllers\API\VehicleTypeController;
use App\Http\Controllers\API\DonationTypeController;
use App\Http\Controllers\API\NotificationController;

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
Route::get('vehicle-types', [App\Http\Controllers\API\VehicleTypeController::class, 'index']);
Route::get('districts', [App\Http\Controllers\API\DistrictController::class, 'index']);


//Route::group(['middleware' => 'api'], function () {


Route::get('notifications', [App\Http\Controllers\API\NotificationController::class, 'index']);
Route::put('notification', [App\Http\Controllers\API\NotificationController::class, 'read']);

Route::get('donation-types', [App\Http\Controllers\API\DonationTypeController::class, 'index']);

Route::get('donations', [App\Http\Controllers\API\DonationController::class, 'index']);
Route::get('donation', [App\Http\Controllers\API\DonationController::class, 'show']);
Route::post('donation', [App\Http\Controllers\API\DonationController::class, 'store']);
Route::delete('donation', [App\Http\Controllers\API\DonationController::class, 'destroy']);
Route::post('donation/pickdrop', [App\Http\Controllers\API\DonationController::class, 'update']);
Route::get('weights', [App\Http\Controllers\API\WeightController::class, 'index']);
//});
