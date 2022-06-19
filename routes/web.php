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

// Route::resource('/','MedicineController');
Route::get('/','MedicineController@front_index')->name('medicines.front_index');

Route::middleware(['auth'])->group(function(){
    Route::get('add-to-cart/{id}','MedicineController@addToCart');
    Route::get('checkout','MedicineController@checkout');
    Route::post('/medicines/qtychanges','MedicineController@qtychanges')->name('medicines.qtychanges');
    Route::post('/medicines/deleteitem','MedicineController@deleteitem')->name('medicines.deleteitem');
});


Route::middleware(['auth'])->group(function(){
    Route::resource('medicines','MedicineController');  
    Route::post('/medicines/getEditForm','MedicineController@getEditForm')->name('medicines.getEditForm');
    Route::post('/medicines/saveDataField','MedicineController@saveDataField')->name('medicines.saveDataField');
});



Route::middleware(['auth'])->group(function(){
    Route::resource('categories','CategoryController');
    Route::post('/categories/getEditForm','CategoryController@getEditForm')->name('categories.getEditForm');
    Route::post('/categories/saveDataField','CategoryController@saveDataField')->name('categories.saveDataField');
});

Route::resource('transactions','TransactionController');
Route::get('submit','TransactionController@submit');
Route::get('terlaris','TransactionController@terlaris');
Route::get('topspender','TransactionController@topspender');


Auth::routes();

Route::get('/history', 'HomeController@index')->name('history');
