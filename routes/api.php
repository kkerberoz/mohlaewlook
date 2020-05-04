<?php

use App\Http\Controllers\BackenController;
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

//route sanctum token auth
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//route for customer
Route::prefix('user')->group(function () {
    Route::post('/login', 'UserController@login');
    Route::post('/regis', 'UserController@register');
    Route::post('/logout', 'UserController@logout');
});

//route for employee
Route::prefix('admin')->group(function () {
    Route::post('/login', 'AdminController@login');
    Route::post('/logout', 'AdminController@logout');
    Route::post('/addEmployee', 'AdminController@addEmployee');
    Route::get('/init', 'AdminController@init');
});

//route for CRUD admin controller
Route::prefix('backend')->group(function () {
    //customer
    Route::get('/getCustomer', 'UserController@getCustomer');
    Route::delete('/customer/{id}', 'UserController@destroy');
    Route::put('/customer/{id}', 'UserController@update');

    //Flight
    Route::get('/getFlightNo', 'BackendController@getFlightNo');
    Route::post('/addAircraft', 'BackendController@addAircraft');
    Route::get('/getAirports', 'BackendController@getAirports');
    Route::post('/getAircraftAndCrew', 'BackendController@getAircraftAndCrew');
    Route::post('/addFlight', 'BackendController@addFlight');
    Route::post('/addAirport', 'BackendController@addAirport');
    Route::get('/getModelBrand', 'BackendController@getModelBrand');
    Route::post('/addPrice','BackendController@addPrice');
    Route::get('/getPrice','BackendController@getPrice');
    Route::post('/editPrice','BackendController@editPrice');
    Route::post('/analytic1_show','BackendController@analytic1_show');
    Route::get('/analytic1_get','BackendController@analytic1_get');
    Route::post('/analytic2_show','BackendController@analytic2_show');
    Route::post('/analytic3_show','BackendController@analytic3_show');
    Route::get('/analytic4','BackendController@analytic4');


});
