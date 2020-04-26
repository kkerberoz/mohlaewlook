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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});


// Route::get('init', 'UserController@init');
Route::post('login', 'UserController@login');
Route::post('regis', 'UserController@register');
Route::post('logout', 'UserController@logout');

Route::prefix("admin")->group(function () {
    Route::post('/login', 'AdminController@login');
    Route::post('/logout', 'AdminController@logout');
    Route::post('/addEmployee', 'AdminController@addEmployee');
    Route::get('/init', 'AdminController@init');
});

Route::post('/backend/addAircraft','BackendController@addAircraft');
Route::get('/getModelBrand','BackendController@getModelBrand');

Route::get('backend/getAirports', 'BackendController@getAirports');
Route::post('backend/getAircraftAndCrew', 'BackendController@getAircraftAndCrew');

Route::post('backend/addAirport', 'BackendController@addAirport');
