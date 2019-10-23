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

Route::get('/about', function () {
    return view('about');
});

Route::post('/search', 'ItemController@search')->name('search');
Route::get('/account', 'AccountController@show');

/**
 * 
 * User section
 */
Route::get('/additem', 'AccountController@index')->middleware('auth');
Route::get('/item', 'ItemController@showItem');
Route::get('/user/{id}', 'AccountController@getUserId');
Route::get('/viewitem', 'AccountController@view')->middleware('auth');

/*
*
* AI section
*
*/
Route::post('/createAi', 'ItemController@createAi')->middleware('auth');
Route::get('/item/ai/{id}', 'AiController@show')->name('Ai');
Route::get('/item/ai/{id}/edit', 'AiController@edit')->middleware('isAdmin');
Route::patch('/updateAi/{id}', 'AiController@update')->middleware('auth');
Route::delete('/item/ai/{id}/delete', 'AiController@delete')->middleware('auth');


/**
 * 
 * Equipment section
 */
Route::post('/createEquip', 'ItemController@createEquip')->middleware('auth');
Route::patch('/item/equip/{id}/update', 'EquipmentController@update')->middleware('auth');
Route::delete('/item/equip/{id}/delete', 'EquipmentController@delete')->middleware('auth');
Route::get('/item/equip/{id}', 'EquipmentController@show');
Route::get('/item/equip/{id}/edit', 'EquipmentController@edit')->middleware('isAdmin');


/**
 * 
 * 
 * Item section
 */
Route::post('/createItem', 'ItemController@createItem')->middleware('auth');
Route::patch('/item/items/{id}/update', 'ItemsController@update')->middleware('auth');
Route::delete('/item/items/{id}/delete', 'ItemsController@delete')->middleware('auth');
Route::get('/item/items/{id}', 'ItemsController@show');
Route::get('/item/items/{id}/edit', 'ItemsController@edit')->middleware('isAdmin');

/**
 * 
 * Xtal section
 * 
 */
Route::post('/createXtal', 'ItemController@createXtal')->middleware('auth');
Route::patch('/item/xtal/{id}/update', 'XtalController@update')->middleware('auth');
Route::delete('/item/xtal/{id/delete', 'XtalController@delete')->middleware('auth');
