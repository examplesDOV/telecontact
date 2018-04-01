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
Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function() {
    
    Route::get('/call', 'CallController@call')->name('client.call');
    Route::get('/pause', 'CallController@pause')->name('client.pause');
    Route::post('/call', 'CallController@update')->name('client.update');

});



