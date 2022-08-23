<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;

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
Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class, 'forget_password']);
Route::post('otp-verify', [AuthController::class, 'otp_verify']);
Route::post('reset-password', [AuthController::class, 'reset_password']);

Route::group(['middleware' => ['auth:api']], function () {    
    Route::get('dashboard',[ProjectController::class, 'index']);
    Route::get('driver-list',[ProjectController::class, 'driver_list']);
    Route::get('trip-list',[ProjectController::class, 'trip_list']);
});

//Route::apiResource('dashboard', ProjectController::class)->middleware('auth:api');


