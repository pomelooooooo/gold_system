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

// Route::get('/first', 'HomeController@firstpage')->name('firstpage');

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/stores', 'StoresController@index');
// Route::post('/stores/store', 'StoresController@store')->name('stores.store');

Route::resource('/managegold', 'ManagegoldController')->middleware('auth');

Route::resource('/product', 'ProductController')->middleware('auth');

Route::resource('/productdetail', 'ProductDetailController')->middleware('auth');
Route::get('/productdetail/price_of_gold/{lot}', 'ProductDetailController@getprice_of_gold')->middleware('auth');

Route::resource('/stores', 'StoresController')->middleware('auth');

Route::resource('/median_price', 'MedianPriceController')->middleware('auth');

Route::resource('/set_price', 'SetPriceController')->middleware('auth');

Route::resource('/manage_employee', 'ManageEmployeeController')->middleware('auth');
Route::get('/manage_employee/validateIdcard/{idCard}/{id?}', 'ManageEmployeeController@validateIdcard')->middleware('auth');

Route::resource('/type_gold', 'TypeGoldController')->middleware('auth');

Route::resource('/striped', 'StripedController')->middleware('auth');

Route::resource('/manage_customer', 'ManageCustomerController')->middleware('auth');
Route::get('/manage_customer/validateIdcard/{idCard}/{id?}', 'ManageCustomerController@validateIdcard')->middleware('auth');

Route::resource('/buy', 'BuyController')->middleware('auth');
Route::get('/buy/formBuy/{id}', 'BuyController@formBuy')->middleware('auth');
Route::post('/buyGroup/update', 'BuyController@updateGroup')->middleware('auth');


Route::resource('/sell', 'SellController')->middleware('auth');
Route::get('/sell/group/{id}', 'SellController@sell_group')->middleware('auth');
Route::post('/sellGroup/update', 'SellController@updateGroup')->middleware('auth');
Route::get('/sellGroup/formSell/{id}', 'SellController@formSell')->middleware('auth');


Route::resource('/manufacturer', 'ManufacturerController')->middleware('auth');

Route::resource('/stock', 'StockController')->middleware('auth');

Route::get('/stocknew', 'StockController@stocknew')->middleware('auth');
Route::post('/stocknew/status_check_new', 'StockController@updateStatusCheckNew')->middleware('auth');

Route::get('/stock_old', 'StockController@stock_old')->middleware('auth');
Route::post('/stock_old/status_check', 'StockController@updateStatusCheck')->middleware('auth');

Route::get('/stockold', 'StockController@stockold')->middleware('auth');
Route::post('/stockold/report_smelters', 'StockController@reportSmelters')->middleware('auth');
Route::post('/stockold/group', 'StockController@updateGroup')->middleware('auth');
Route::get('/stockold/getManusactor', 'StockController@getManusactor')->middleware('auth');

Route::resource('/pledge', 'PledgeController')->middleware('auth');
