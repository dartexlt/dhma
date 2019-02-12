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
Route::get('/ma3', 'PagesController@getMA3');
Route::get('/ma', 'PagesController@getMA');
Route::get('/model', 'PagesController@getModel');
Route::get('/crud', 'PagesController@getCrud')->name('crud');
Route::resource('data', 'DataController');
Route::post('calc', 'CalculationController@calculate')->name('calc.compute');
Route::post('calc2', 'CalculationController@calculate2')->name('calc.compute2');
Route::post('calc3', 'CalculationController@calculate3')->name('calc.compute3');
Route::post('calcMA', 'CalculationController@calculateMA')->name('calc.computeMA');
Route::get('result/{data_array}', 'CalculationController@getResult')->name('calc.result');

Route::get('search','DataController@search');
Route::get('getAnalysisData', 'DataController@getCharts');


Route::post('/Amet1', 'CalculationController@calculate');
Route::post('/Amet2', 'CalculationController@calculate2');

Route::get('dropdownlist','DropdownController@index');
Route::get('get-state-list','DropdownController@getStateList');
Route::get('get-city-list','DropdownController@getCityList');