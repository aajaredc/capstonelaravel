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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/inventoryitems', 'InventoryItemsController@index')->name('indexinventoryitem');
Route::get('/inventoryitems/create', 'InventoryItemsController@create');
Route::get('/inventoryitems/{id}', 'InventoryItemsController@show')->name('showinventoryitem');
Route::post('/inventoryitems', 'InventoryItemsController@store');
Route::get('/inventoryitems/{id}/edit', 'InventoryItemsController@edit');
Route::patch('/inventoryitems/{id}', 'InventoryItemsController@update');
Route::delete('/inventoryitems/{id}', 'InventoryItemsController@destory');
