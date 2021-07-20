<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@index')->name('page.index');
Route::get('/page/{page?}', 'PageController@index');
Route::get('pokemon_info', 'AjaxController@pokemon_info')->name('ajax.pokemon_info');
Route::get('/search', 'PageController@search')->name('page.search');
