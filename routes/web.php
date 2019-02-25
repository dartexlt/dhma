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
Route::get('/HLcalculator1', 'PagesController@getHeatLoad1');
Route::get('/HLcalculator2', 'PagesController@getHeatLoad2');
Route::get('/RiLcalculator', 'PagesController@getRiL');
Route::get('/PEFcalculator', 'PagesController@getPEF');
Route::get('/model', 'PagesController@getModel');
Route::get('/crud', 'PagesController@getCrud')->name('crud');
Route::resource('data', 'DataController');
Route::post('HL1', 'CalculationController@calcHL1')->name('calc.HL1');
Route::post('HL2', 'CalculationController@calcHL2')->name('calc.HL2');
Route::post('RiL', 'CalculationController@calcRiL')->name('calc.RiL');
Route::post('PEF', 'CalculationController@calcPEF')->name('calc.PEF');

Route::get('region','DataController@getRegion');
Route::get('getAnalysisData', 'DataController@getCharts');


Route::get('dropdownlist','DropdownController@index');
Route::get('get-state-list','DropdownController@getStateList');
Route::get('get-city-list','DropdownController@getCityList');