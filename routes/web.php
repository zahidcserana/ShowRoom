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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/purchase', 'PurchaseController@index')->name('purchase');
Route::post('/purchase', 'PurchaseController@Purchase')->name('purchase');
Route::get('/sale', 'SalesController@index')->name('sale');
Route::post('/sale', 'SalesController@sale')->name('sale');
//Route::get('/inventory', 'PurchaseController@index')->name('inventory');
Route::get('/finance', 'FinanceController@index')->name('finance');
Route::post('/finance', 'FinanceController@Finance')->name('finance');
Route::get('/inventory_report', 'FinanceController@InventoryReport')->name('inventory_report');
Route::post('/inventory_report', 'FinanceController@InventorySearch')->name('inventory_report');
Route::get('/finance_report', 'FinanceController@FinanceReport')->name('finance_report');
Route::post('/finance_report', 'FinanceController@FinanceSearch')->name('finance_report');




