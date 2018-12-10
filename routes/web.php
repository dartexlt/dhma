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
Route::get('/ma1', 'PagesController@getMA1');
Route::get('/ma2', 'PagesController@getMA2');
Route::resource('data', 'DataController');
Route::post('calc', 'CalculationController@calculate')->name('calc.compute');
Route::post('calc2', 'CalculationController@calculate2')->name('calc.compute2');
Route::get('result/{data_array}', 'CalculationController@getResult')->name('calc.result');