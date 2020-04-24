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


Route::get('admin/init', 'AdminController@init');
Route::post('admin/login', 'AdminController@login');
Route::post('admin/logout', 'AdminController@logout');
Route::post('admin/addEmployee', 'AdminController@addEmployee');

Route::get('backend/getAirports', 'BackendController@getAirports');
