<?php

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

Route::get('/','WebController@index');
Route::get('/dashboard','WebController@dashboard');
Route::get('/incoming','WebController@incoming');
Route::get('/inventory','WebController@inventory');
Route::get('/transaction','WebController@transactions');
Route::get('/report','WebController@reports');
Route::get('/account','WebController@account');

Route::get('/monitoring', 'MonitoringController@index');

Route::get('/supplier', 'WebController@supplier');

