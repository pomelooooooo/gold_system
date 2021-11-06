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

// Route::get('/first', 'HomeController@firstpage')->name('firstpage');

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/stores', 'StoresController@index');
// Route::post('/stores/store', 'StoresController@store')->name('stores.store');

Route::resource('/managegold', 'ManagegoldController');

Route::resource('/stores', 'StoresController');

Route::resource('/median_price', 'MedianPriceController');

Route::resource('/set_price', 'SetPriceController');
