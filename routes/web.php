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
Route::get('/purchases', 'PurchaseController@Purchases')->name('purchases');
Route::get('/purchase', 'PurchaseController@index')->name('purchase');
Route::post('/purchase', 'PurchaseController@Purchase')->name('purchase');

Route::get('/sales', 'SalesController@Sales')->name('sales');
Route::get('/sale', 'SalesController@index')->name('sale');
Route::post('/sale', 'SalesController@sale')->name('sale');

Route::get('/returns', 'SalesController@Returns')->name('returns');
Route::get('/return', 'SalesController@ReturnPrd')->name('return');
Route::post('/return', 'SalesController@ReturnProduct')->name('return');

Route::get('/finance', 'FinanceController@index')->name('finance');
Route::post('/finance', 'FinanceController@Finance')->name('finance');
Route::get('/inventory_report', 'FinanceController@InventoryReport')->name('inventory_report');
Route::post('/inventory_report', 'FinanceController@InventorySearch')->name('inventory_report');
Route::get('/finance_report', 'FinanceController@FinanceReport')->name('finance_report');
Route::post('/finance_report', 'FinanceController@FinanceSearch')->name('finance_report');

Route::get('/categories', 'HomeController@CategoryInfo')->name('categories');
Route::get('/category', 'HomeController@CategoryForm')->name('category');
Route::post('/category', 'HomeController@CategoryAdd')->name('category');

Route::get('/items', 'HomeController@ItemInfo')->name('items');
Route::get('/item', 'HomeController@ItemForm')->name('item');
Route::post('/item', 'HomeController@ItemAdd')->name('item');

Route::post('/item_by_category', 'HomeController@ItemByCategory')->name('item_by_category');
Route::post('/item_stock', 'HomeController@GetItemStock')->name('item_stock');






