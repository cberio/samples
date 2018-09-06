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

Route::group(['namespace' => 'AppLozic', 'prefix' => 'appLozic', 'as' => 'appLozic.'], function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/create', 'UserController@store')->name('store');
    Route::get('/edit/{appLozicUser}', 'UserController@edit')->name('edit');
    Route::patch('/edit/{appLozicUser}', 'UserController@update')->name('update');

    Route::group(['prefix' => 'groups', 'as' => 'groups.'], function () {
        Route::post('/', 'GroupController@store')->name('store');
        Route::delete('/', 'GroupController@removeUser')->name('remove.user');
    });

    Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
        Route::get('/', 'MessageController@index')->name('index');
        Route::post('/', 'MessageController@store')->name('store');
    });
});

Route::group(['namespace' => 'QuickBlox', 'prefix' => 'quickBlox', 'as' => 'quickBlox.'], function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/create', 'UserController@store')->name('store');
    Route::get('/edit/{quickBloxUser}', 'UserController@edit')->name('edit');
    Route::patch('/edit/{quickBloxUser}', 'UserController@update')->name('update');

    Route::group(['prefix' => 'dialogs', 'as' => 'dialogs.'], function () {
        Route::get('/', 'DialogController@index')->name('index');
    });

    Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
        Route::get('/', 'MessageController@index')->name('index');
        Route::post('/', 'MessageController@store')->name('store');
    });
});
