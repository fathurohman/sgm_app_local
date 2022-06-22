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
	//job order routes
	Route::resource('job_order', 'JobOrderController');
	Route::get('/customer_data', 'JobOrderController@getdata');
	Route::get('/job_data', 'JobOrderController@getdataorder');
	Route::get('/tipe_order', 'JobOrderController@gettipeorder');
	Route::get('/set_tipe', 'JobOrderController@settipeorder');
	//vendor client routes
	Route::resource('client', 'ClientController');
	Route::resource('vendor', 'VendorController');
	Route::get('/vendor_detail/{id}', 'VendorController@showTracking');
	Route::get('/client_detail/{id}', 'ClientController@showTracking');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('map', function () {
		return view('pages.maps');
	})->name('map');
	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');
	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
