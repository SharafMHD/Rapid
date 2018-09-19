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
Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index');

Route::resource('customers', 'customerController');

Route::resource('cities', 'citiesController');

Route::resource('countries', 'countriesController');

Route::resource('units', 'unitsController');

Route::resource('countries', 'countriesController');

Route::resource('shippers', 'shippersController');

Route::resource('customers', 'customersController');

Route::resource('itemsCategories', 'items_categoryController');

Route::resource('items', 'itemsController');

Route::resource('bills', 'billsController');

Route::get('/bills/showCustomer/{id}', 'billsController@showCustomer');
Route::get('/bills/getitem/{id}', 'billsController@getitem');