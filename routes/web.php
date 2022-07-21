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

Route::get('/', function () {
	return view('welcome');
});
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController');
	Route::resource('permission', 'PermissionController');
	Route::resource('role', 'RoleController');
	Route::resource('items', 'ItemsController');
	//job order routes
	Route::resource('job_order', 'JobOrderController');
	Route::resource('sales_order', 'SalesOrderController');
	Route::get('/customer_data', 'JobOrderController@getdata');
	Route::get('/job_data', 'JobOrderController@getdataorder');
	Route::get('/tipe_order', 'JobOrderController@gettipeorder');
	Route::get('/set_tipe', 'JobOrderController@settipeorder');
	Route::get('/job_detail/{id}', 'JobOrderController@showDetail');
	Route::get('/listcustomer', 'JobOrderController@listcustomer')->name('listcustomer');
	Route::get('/listorder', 'JobOrderController@listorder')->name('listorder');
	Route::get('/listordershow', 'JobOrderController@listordershow')->name('listordershow');
	//sales order routes
	Route::get('/listsalesshow', 'SalesOrderController@listsalesshow')->name('listsalesshow');
	Route::get('/sales_selling_detail/{id}', 'SalesOrderController@showDetailSelling');
	Route::get('/sales_buying_detail/{id}', 'SalesOrderController@showDetailBuying');
	Route::get('/sales_profit_detail/{id}', 'SalesOrderController@showDetailProfit');
	Route::get('/sales_dp_detail/{id}', 'SalesOrderController@showDetailDP');
	Route::get('/job_data_sales', 'SalesOrderController@getdataordersales');
	Route::get('/listordersales', 'SalesOrderController@listordersales')->name('listordersales');
	Route::resource('sales_order', 'SalesOrderController');
	Route::get('search/autocomplete/', 'SalesOrderController@autocomplete_desc');
	Route::get('search/autocomplete_remark/', 'SalesOrderController@autocomplete_remark');
	Route::get('search/autocomplete_client/', 'SalesOrderController@autocomplete_client');
	Route::put('send/{id}', 'SalesOrderController@sendtofinance')->name('sales_order.send');
	//vendor client routes
	Route::resource('client', 'ClientController');
	Route::resource('vendor', 'VendorController');
	Route::get('/vendor_detail/{id}', 'VendorController@showTracking');
	Route::get('/client_detail/{id}', 'ClientController@showTracking');
	Route::get('profile', 'ProfileController@edit')->name('profile.edit');
	Route::put('profile/update', 'ProfileController@update')->name('profile.update');
	//finance routes
	Route::get('/finance', 'FinanceController@index')->name('finance.index');
	Route::get('/listinvoiceshow', 'FinanceController@listinvoiceshow')->name('listinvoiceshow');
	Route::get('/modal_cetak_invoice/{id}/{tipe}', 'FinanceController@modal_cetak_invoice');
	// Route::get('/cetak_invoice/{id}/{tipe}', 'FinanceController@cetak_invoice');
	Route::post('/cetak_invoice_dua', 'FinanceController@cetak_invoice_dua')->name('cetak_invoice_dua');
	Route::put('return/{id}', 'FinanceController@returntosales')->name('finance.return');
	//end
	Route::put('profile/password', 'ProfileController@password')->name('profile.password');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
