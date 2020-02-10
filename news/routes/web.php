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
Route::prefix('admin')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('newstypes', 'NewsTypeController');
    Route::resource('news', 'NewsController');
    Route::resource('comments', 'CommentController');
    Route::resource('slide', 'SlideController');
    Route::group(['prefix'=>'ajax'],function(){
        Route::get('newstypes/{category}','AjaxController@getNewsTypes');
    });
});
Route::get('test', function () {
    echo "123";
});

