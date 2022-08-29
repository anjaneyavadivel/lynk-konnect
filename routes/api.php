<?php

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

Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class, 'forget_password']);
Route::post('otp-verify', [AuthController::class, 'otp_verify']);
Route::post('reset-password', [AuthController::class, 'reset_password']);

Route::group(['middleware' => ['auth:api']], function () {
     
    Route::post('update-profile', [ProjectController::class, 'update_profile']);
    Route::get('logout',[ProjectController::class, 'logout']);
    Route::get('dashboard',[ProjectController::class, 'index']);
    Route::get('trip-list',[ProjectController::class, 'trip_list']);
    Route::get('transaction-list',[ProjectController::class, 'transaction_list']);
    Route::get('common-list',[ProjectController::class, 'common_list']);
    Route::get('city-list', [ProjectController::class, 'getCity']);

    Route::get('driver-list',[ProjectController::class, 'driver_list']);
    Route::post('add-driver', [ProjectController::class, 'create_driver']);
    Route::post('edit-driver', [ProjectController::class, 'update_driver']);
    Route::post('delete-driver', [ProjectController::class, 'delete_driver']);

    Route::post('add-trip', [ProjectController::class, 'create_trip']);
    Route::post('edit-trip', [ProjectController::class, 'update_trip']);
    Route::post('delete-trip', [ProjectController::class, 'delete_trip']);
    Route::get('manage-own-trip', [ProjectController::class, 'manageown_trip']);
    Route::post('change-trip-status', [ProjectController::class, 'change_trip_status']);
});

?>


