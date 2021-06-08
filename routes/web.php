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

Route::get('/', function(){
    return redirect('/dashboard');
});

Route::get('/login','AuthController@login')->name('login');
Route::post('/login','AuthController@postLogin');
Route::get('/logout','AuthController@logout');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard','WebController@dashboard');
    
    Route::get('/incoming','WebController@incoming');
    Route::get('/inventory','WebController@inventory');
    Route::get('/transaction','WebController@transactions');
    Route::get('/report','WebController@reports');
    
    Route::get('/account','WebController@account');
    Route::post('/account/changeName','WebController@changeName');
    Route::post('/account/changePassword','WebController@changePassword');
    
    Route::post('/product', 'ProductController@addProduct');
    Route::post('/product/edit', 'ProductController@editProduct');

    Route::post('/category', 'ProductController@addCategory');
    Route::post('/category/qry', 'ProductController@queryCategory');
    Route::post('/category/remove', 'ProductController@removeCategory');

    Route::post('/trx/request', 'TransactionController@requestTransaction');
    Route::post('/trx/return', 'TransactionController@returnTransaction');
    Route::get('/trx/query', 'TransactionController@searchReport');

    Route::get('/monitoring', 'MonitoringController@browse');
    Route::post('/monitoring/edit', 'MonitoringController@edit');
    Route::post('/monitoring/checklatency', 'MonitoringController@pingExec');
    
    Route::get('/supplier', 'SupplierController@browse');
    Route::post('/supplier/add', 'SupplierController@store');
    Route::post('/supplier/edit', 'SupplierController@edit');
    Route::get('/supplier/{id}/remove', 'SupplierController@remove');
    


});    

