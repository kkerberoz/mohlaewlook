<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');
Route::get('/boss', 'PagesController@boss');
Route::get('/about', 'PagesController@about');
Route::get('/info', 'PagesController@info');
Route::get('/contract', 'PagesController@contract');

Route::get('/login', 'UserController@login');
Route::get('/register', 'UserController@register');
