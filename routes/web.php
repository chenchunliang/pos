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
    return view('login');
});


Route::get('/test', 'testController@index');

Route::resource('parameter', 'ParameterController');
Route::resource('item', 'ItemController');
Route::resource('catalog', 'CatalogController');
Route::resource('position', 'PositionController');
Route::resource('customer', 'CustomerController');
Route::resource('invoice', 'InvoiceController');
Route::resource('salesinvoice', 'SalesinvoiceController');
Route::resource('invalidinvoice', 'InvalidinvoiceController');
