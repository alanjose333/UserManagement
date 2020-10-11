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


Auth::routes();
Route::get('/', 'UserController@index')->name('users');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getusers', 'UserController@getUsers')->name('get.users');
Route::post('/updateusers', 'UserController@updateUser')->name('update.users');
Route::get('/create', 'UserController@create')->name('create.user');
Route::post('/storeuser', 'UserController@storeUser')->name('store.user');
Route::get('/export', 'UserController@export_csv')->name('export.user');
Route::post('/import', 'UserController@import')->name('import.user');
