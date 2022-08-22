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
	return view('auth.login');
});
Auth::routes();

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('roleuser', 'RoleUserController');
	Route::resource('user', 'UserController');
	Route::resource('permission', 'PermissionController');
	Route::resource('role', 'RoleController');
	Route::resource('items', 'ItemsController');
	Route::get('search/autocomplete_username', 'RoleUserController@autocomplete_username')->name('autocomplete_username');
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
	Route::get('datasales', 'SalesOrderController@data_sales')->name('data_sales');
	Route::get('/listojobrdersalesshow', 'SalesOrderController@listojobrdersalesshow')->name('listojobrdersalesshow');
	Route::get('pickup/{id}', 'SalesOrderController@pickup')->name('pickup');
	//vendor client routes
	Route::resource('client', 'ClientController');
	Route::resource('vendor_data', 'VendorController');
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
	Route::put('pembukuan/{id}', 'FinanceController@pembukuan')->name('finance.pembukuan');
	//end
	//history routes
	Route::get('/history_orders', 'HistoryController@history_index')->name('history_orders');
	Route::get('/historyinvoiceshow', 'HistoryController@historyinvoiceshow')->name('historyinvoiceshow');
	//end
	//reports
	Route::post('/datamonthly', 'HistoryController@export')->name('export');
	Route::post('/datamonthlyreport', 'HistoryController@export_profit')->name('export_profit');
	Route::get('/daily_home', 'HistoryController@daily_home')->name('report');
	Route::get('/tarik_profit', 'HistoryController@tarik_profit')->name('tarik_profit');
	Route::put('profile/password', 'ProfileController@password')->name('profile.password');
	//history routes
	Route::get('/listsaleshistory', 'HistorySalesController@listsaleshistory')->name('listsaleshistory');
	Route::get('/history_sales', 'HistorySalesController@index')->name('history_sales');
	//BOL Routes
	Route::resource('bol', 'BOLController');
	Route::get('getdatabol', 'BOLController@getdatabol')->name('getdatabol');
	Route::get('cetakbol/{id}', 'BOLController@Cetak')->name('cetakbol');
	//ajax profit
	Route::get('/getprofit', 'HomeController@getprofit')->name('getprofit');
	//jurnal routes
	Route::get('/jurnal', 'JurnalController@index')->name('jurnal');
	Route::post('/export_jurnal', 'JurnalController@export_jurnal')->name('export_jurnal');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
