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

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'Admin\AdminController@index');


    Route::prefix('website')->name('website.')->group(function () {
        Route::get('/', 'Admin\WebsiteController@index')->name('index');
        Route::get('/create', 'Admin\WebsiteController@create')->name('create');
        Route::post('/create', 'Admin\WebsiteController@saveNew')->name('saveNew');
        Route::get('/update/{id}', 'Admin\WebsiteController@update')->name('update');
        Route::put('/update/{id}', 'Admin\WebsiteController@store')->name('store');
        Route::put('/update/{id}/token', 'Admin\WebsiteController@updateToken')->name('updateToken');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', 'Admin\AdminController@index')->name('index');
        Route::get('/create', 'Admin\AdminController@create')->name('create');
        Route::post('/create', 'Admin\AdminController@saveNew')->name('saveNew');
        Route::get('/update/{id}', 'Admin\AdminController@update')->name('update');
        Route::put('/update/{id}', 'Admin\AdminController@store')->name('store');
    });

    Route::prefix('config')->name('config.')->group(function () {
        Route::get('/', 'Admin\ConfigController@index')->name('index');
        Route::put('/store', 'Admin\ConfigController@store')->name('store');

    });

});
