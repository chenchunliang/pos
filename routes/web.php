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


Route::get('/', 'IndexController@index');
Route::get('/index', 'IndexController@index');
Route::post('/login', 'IndexController@login');
Route::get('/menu', 'IndexController@menu');

Route::get('/test', 'testController@index');//QRcode

Route::resource('parameter', 'ParameterController');
Route::resource('item', 'ItemController');
Route::resource('catalog', 'CatalogController');
Route::resource('position', 'PositionController');
Route::resource('customer', 'CustomerController');
Route::resource('invoice', 'InvoiceController');

//ajax 一定要比resource('salesinvoice')還要前面
Route::get('/salesinvoice/display_detail/{id}', 'SalesinvoiceController@display_detail');
Route::get('/salesinvoice/sales', 'SalesinvoiceController@sales');
Route::get('/salesinvoice/show/{id}/type/{type}', 'SalesinvoiceController@show');
Route::get('/salesinvoice/uploadC0401', 'SalesinvoiceController@uploadC0401');

Route::resource('salesinvoice', 'SalesinvoiceController');

Route::get('/invalidinvoice/uploadC0501', 'InvalidinvoiceController@uploadC0501');
Route::resource('invalidinvoice', 'InvalidinvoiceController');
