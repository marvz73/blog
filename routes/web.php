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
	Route::get('/', 'BlogController@index')->name('home');

	Route::get('/view/{id}', 'BlogController@single')->name('single');

	Route::get('/add', 'BlogController@add')->name('add');
	Route::post('/add', 'BlogController@saveAdd')->name('saveAdd');

	Route::get('/edit/{id}', 'BlogController@edit')->name('edit');
	Route::post('/edit', 'BlogController@saveEdit')->name('saveEdit');

	Route::get('/delete/{id}', 'BlogController@delete')->name('delete');
