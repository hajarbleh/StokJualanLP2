<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'barang','as' => 'barang.'], function() {
	Route::get('show', ['as' => 'showAll', 'uses' => 'BarangController@show']);
	Route::get('add', ['as' => 'showAdd', 'uses' => 'BarangController@add']);
	Route::post('add', ['as' => 'add', 'uses' => 'BarangController@add']);
	Route::get('edit/{id}', ['as' => 'showEdit', 'uses' => 'BarangController@edit']);
	Route::post('edit/{id}', ['as' => 'edit', 'uses' => 'BarangController@edit']);
	Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'BarangController@delete']);
});
