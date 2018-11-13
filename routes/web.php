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

Route::get('/', 'PagesController@getIndex');
Route::get('/ma', 'PagesController@getMA');
Route::resource('data', 'DataController');
Route::post('calc', 'CalculationController@calculate')->name('calc.compute');
Route::get('result/{data_array}', 'CalculationController@getResult')->name('calc.result');