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
//PostController一覧
Route::group(['prefix' => 'auth', 'middleware'=> 'auth'], function(){
    Route::get('post/create', 'Auth\PostController@add');
    Route::post('post/create', 'Auth\PostController@create');
    Route::get('post', 'Auth\PostController@index');
    Route::get('post/edit', 'Auth\PostController@edit');
    Route::post('post/edit', 'Auth\PostController@update');
    Route::get('post/delete', 'Auth\PostController@delete');
});


//ProfileController一覧
Route::group(['prefix' => 'auth', 'middleware'=> 'auth'],function(){
    Route::get('profile/create', 'Auth\ProfileController@add');
    Route::get('profile/edit', 'Auth\ProfileController@edit');
    Route::post('profile/create', 'Auth\ProfileController@create');
    Route::post('profile/edit', 'Auth\ProfileController@update');
    Route::get('profile/userpage', 'Auth\ProfileController@show');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
