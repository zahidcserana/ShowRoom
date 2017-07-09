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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/purchase', 'PurchaseController@index')->name('purchase');
Route::post('/purchase', 'PurchaseController@Purchase')->name('purchase');
Route::get('/sale', 'PurchaseController@index')->name('sale');
Route::get('/inventory', 'PurchaseController@index')->name('inventory');
Route::get('/finance', 'PurchaseController@index')->name('finance');
