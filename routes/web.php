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

Route::get('/', 'ServiceRequestsController@index')->name('home');
Route::get('/new', 'ServiceRequestsController@add')->name('add');
Route::post('/store', 'ServiceRequestsController@store')->name('store');
Route::get('/models/{makeId}', 'ServiceRequestsController@getModels')->name('modals');
Route::get('{serviceRequest}', 'ServiceRequestsController@edit')->name('edit');
Route::post('/update/{serviceRequest}', 'ServiceRequestsController@update')->name('update');
Route::get('delete/{serviceRequest}', 'ServiceRequestsController@delete')->name('delete');
Route::post('/search', 'ServiceRequestsController@search')->name('search');