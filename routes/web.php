<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\StopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes(['register' => false]);
Route::get('/', function () { return view('auth/login');});
//Route::get('/register', function () { return view('auth/register');});


    Route::get('/signup', [UserController::class, 'signUp'])->name('signUp');
    Route::post('/signup', [UserController::class, 'signUp'])->name('signUp');

    Route::get('/map', function () {
        return view('admin/map');
    });
    


Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard');

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    Route::resource('products', ProductController::class);


    #-- User Management
    Route::get('/manage_users', [UserController::class, 'index'])->name('manage_users');
    Route::get('/add_user', [UserController::class, 'create'])->name('add_user');
    Route::post('/add_user', [UserController::class, 'create'])->name('add_user');
    Route::get('/edit_user/{id}', [UserController::class, 'update'])->name('edit_user');
    Route::post('/edit_user', [UserController::class, 'update'])->name('edit_user');
    Route::delete('userdel/{id}', 'UserController@destroy')->name('user.destroy');

    #-- Permission Management
    Route::get('/manage_permission', [PermissionController::class, 'index'])->name('manage_permissin');
    Route::get('/add_permission', [PermissionController::class, 'create'])->name('add_permission');
    Route::post('/add_permission', [PermissionController::class, 'create'])->name('add_permission');
    Route::get('/edit_permission/{id}', [PermissionController::class, 'update'])->name('edit_permission');
    Route::post('/edit_permission', [PermissionController::class, 'update'])->name('edit_permission');
    //Route::delete('userdel/{id}', 'PermissionController@destroy')->name('user.destroy');

    #-- Company Management
    Route::get('/manage_company', [CompanyController::class, 'index'])->name('manage_company');
    Route::get('/add_company', [CompanyController::class, 'create'])->name('add_company');
    Route::post('/add_company', [CompanyController::class, 'create'])->name('add_company');
    Route::get('/edit_company/{id}', [CompanyController::class, 'update'])->name('edit_company');
    Route::post('/edit_company', [CompanyController::class, 'update'])->name('edit_company');

    #-- Driver Management
    Route::get('/manage_driver', [DriverController::class, 'index'])->name('manage_driver');
    Route::get('/add_driver', [DriverController::class, 'create'])->name('add_driver');
    Route::post('/add_driver', [DriverController::class, 'create'])->name('add_driver');
    Route::get('/edit_driver/{id}', [DriverController::class, 'update'])->name('edit_driver');
    Route::post('/edit_driver', [DriverController::class, 'update'])->name('edit_driver');

    #-- Country Management
    // Route::get('/manage_country', [CountryController::class, 'index'])->name('manage_country');
    // Route::get('/add_country', [CountryController::class, 'create'])->name('add_country');
    // Route::post('/add_country', [CountryController::class, 'create'])->name('add_country');
    // Route::get('/edit_country/{id}', [CountryController::class, 'update'])->name('edit_country');
    // Route::post('/edit_country', [CountryController::class, 'update'])->name('edit_country');

    #-- State Management
    Route::get('/manage_state', [StateController::class, 'index'])->name('manage_state');
    Route::get('/add_state', [StateController::class, 'create'])->name('add_state');
    Route::post('/add_state', [StateController::class, 'create'])->name('add_state');
    Route::get('/edit_state/{id}', [StateController::class, 'update'])->name('edit_state');
    Route::post('/edit_state', [StateController::class, 'update'])->name('edit_state');

    #-- City Management
    Route::get('/manage_city', [CityController::class, 'index'])->name('manage_city');
    Route::get('/add_city', [CityController::class, 'create'])->name('add_city');
    Route::post('/add_city', [CityController::class, 'create'])->name('add_city');
    Route::get('/edit_city/{id}', [CityController::class, 'update'])->name('edit_city');
    Route::post('/edit_city', [CityController::class, 'update'])->name('edit_city');


    #-- Trip Management
    Route::get('/manage_own_trip', [TripController::class, 'index_own'])->name('manage_own_trip');

    Route::get('/manage_trip', [TripController::class, 'index'])->name('manage_trip');
    Route::get('/manage_trip/{rid}', [TripController::class, 'index'])->name('manage_trip');
    
    Route::get('/add_trip', [TripController::class, 'create'])->name('add_trip');
    Route::post('/add_trip', [TripController::class, 'create'])->name('add_trip');
    Route::get('/edit_trip/{id}', [TripController::class, 'update'])->name('edit_trip');
    Route::post('/edit_trip', [TripController::class, 'update'])->name('edit_trip');

    Route::get('/show_trip/{id}', [TripController::class, 'show'])->name('show_trip');

    Route::get('/state', [TripController::class, 'getCity'])->name('state');

    #-- Transaction Management
    Route::get('/manage_transaction', [TransactionController::class, 'index'])->name('manage_transaction');
    //Route::get('/add_trip', [TransactionController::class, 'create'])->name('add_trip');


    #-- Route Management
    Route::get('/manage_route', [RouteController::class, 'index'])->name('manage_route');
    Route::get('/add_route', [RouteController::class, 'create'])->name('add_route');
    Route::post('/add_route', [RouteController::class, 'create'])->name('add_route');
    Route::get('/edit_route/{id}', [RouteController::class, 'update'])->name('edit_route');
    Route::post('/edit_route', [RouteController::class, 'update'])->name('edit_route');


    #-- Stops Management
    Route::get('/manage_stop', [StopController::class, 'index'])->name('manage_stop');
    Route::get('/manage_stop/{id}', [StopController::class, 'index'])->name('manage_stop');
    Route::get('/add_stop', [StopController::class, 'create'])->name('add_stop');
    Route::post('/add_stop', [StopController::class, 'create'])->name('add_stop');
    Route::get('/edit_stop/{id}', [StopController::class, 'update'])->name('edit_stop');
    Route::post('/edit_stop', [StopController::class, 'update'])->name('edit_stop');

    


});
