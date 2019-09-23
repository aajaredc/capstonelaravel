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

// Inventory Items
Route::get('/inventoryitems', 'InventoryItemsController@index')->name('indexinventoryitem');
Route::get('/inventoryitems/create', 'InventoryItemsController@create')->name('createinventoryitem');
Route::get('/inventoryitems/{inventoryItem}', 'InventoryItemsController@show')->name('showinventoryitem');
Route::post('/inventoryitems', 'InventoryItemsController@store')->name('storeinventoryitem');
Route::get('/inventoryitems/{inventoryItem}/edit', 'InventoryItemsController@edit')->name('editinventoryitem');
Route::patch('/inventoryitems/{inventoryItem}', 'InventoryItemsController@update')->name('updateinventoryitem');
Route::delete('/inventoryitems/{inventoryItem}', 'InventoryItemsController@destroy')->name('destroyinventoryitem');

// Inventory Types
Route::get('/inventorytypes', 'InventoryTypesController@index')->name('indexinventorytype');
Route::get('/inventorytypes/create', 'InventoryTypesController@create')->name('createinventorytype');
Route::get('/inventorytypes/{inventoryType}', 'InventoryTypesController@show')->name('showinventorytype');
Route::post('/inventorytypes', 'InventoryTypesController@store')->name('storeinventorytype');
Route::get('/inventorytypes/{inventoryType}/edit', 'InventoryTypesController@edit')->name('editinventorytype');
Route::patch('/inventorytypes/{inventoryType}', 'InventoryTypesController@update')->name('updateinventorytype');
Route::delete('/inventorytypes/{inventoryType}', 'InventoryTypesController@destroy')->name('destroyinventorytype');
