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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users', 'UserController@index')->name('users');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::post('/store', 'StoreController@store')->name('store');
});

