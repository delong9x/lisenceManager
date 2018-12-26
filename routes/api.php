<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('website')->name('website.')->group(function () {
    Route::get('/{id}', 'Api\WebsiteController@getDetail')->name('detail');
    Route::put('/{id}', 'Api\WebsiteController@updateToken')->name('token');
    Route::delete('/{id}', 'Api\WebsiteController@delete')->name('delete');
});
