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

Route::get('create_code','App\Http\Controllers\CodeController@show')->name('create.show');
Route::post('create','App\Http\Controllers\CodeController@create')->name('create.code');
Route::post('get_updatecodes','App\Http\Controllers\CodeController@getupcode')->name('getup.codedata');
Route::post('update_codedata','App\Http\Controllers\CodeController@update')->name('update.codedata');
Route::post('delete_code','App\Http\Controllers\CodeController@delete')->name('delete.codedata');

#---------------------------------------------------------------------------------------------------------------------------
Route::get('create_links','App\Http\Controllers\LinksController@show')->name('createpdf.show');
Route::post('createe','App\Http\Controllers\LinksController@create')->name('create.file');
Route::post('get_updatefiles','App\Http\Controllers\LinksController@getuppdf')->name('getup.file');
Route::post('update_filedata','App\Http\Controllers\LinksController@update')->name('update.filedata');
Route::post('delete_file','App\Http\Controllers\LinksController@delete')->name('delete.file');

