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




Route::group(['middleware'=>'alreadylogin'],function () {
	Route::get('/', 'IndexController@index');
	Route::get('index', 'IndexController@index');
});

Route::post('login', 'IndexController@login');
Route::get('logout', 'IndexController@logout');

Route::group(['middleware'=>'guest'],function () {
	Route::get('menu', 'IndexController@menu');
	
	Route::resource('parameter', 'ParameterController');
	Route::resource('item', 'ItemController');
	Route::resource('catalog', 'CatalogController');
	Route::resource('position', 'PositionController');
	Route::resource('customer', 'CustomerController');
	
	//特別指定路徑 一定要比resource還要前面
	Route::get('invoice/outputEmptyInvoice', 'InvoiceController@outputEmptyInvoice');//空白發票匯出csv
	Route::resource('invoice', 'InvoiceController');
	
	Route::prefix('salesinvoice')->group(function () {
		Route::get('display_detail/{id}', 'SalesinvoiceController@display_detail');//首頁 顯示發票明細
		Route::get('sales', 'SalesinvoiceController@sales');//櫃台
		Route::get('show/{id}/type/{type}', 'SalesinvoiceController@show');//顯示發票QRcode
		Route::get('uploadC0401', 'SalesinvoiceController@uploadC0401');//上傳C0401發票
	});
	Route::resource('salesinvoice', 'SalesinvoiceController');
	
	Route::get('invalidinvoice/uploadC0501', 'InvalidinvoiceController@uploadC0501');//上傳C0501作廢發票
	Route::resource('invalidinvoice', 'InvalidinvoiceController');
	
	Route::prefix('report')->group(function () {
		Route::get('sales', 'ReportController@sales');//銷售狀況查詢view
		Route::get('sales/print','ReportController@sales_print');
		Route::get('invoice', 'ReportController@invoice');//發票明細查詢view
		Route::get('invoice/print','ReportController@sales_print');
	});
});