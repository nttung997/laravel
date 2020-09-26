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

Route::post('/', 'LoginController@postLogin');
Route::get('/', 'LoginController@getLogin');
Route::get('/logout', 'LoginController@getLogout');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('users', 'Admin\UserController');
    Route::resource('roles', 'Admin\RoleController');
    Route::resource('articles', 'Admin\ArticleController');
});

Route::group(['prefix' => 'user'], function () {
    Route::put('edit', 'User\UserController@update');
    Route::get('edit', 'User\UserController@edit');
    Route::get('', 'User\UserController@index');
});

Route::resource('articles', 'User\ArticleController');
