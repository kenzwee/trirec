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
Route::group(['prefix' => 'auth/profile', 'middleware'=> 'auth'],function(){
    Route::get('/create', 'Auth\ProfileController@add');
    Route::get('/edit', 'Auth\ProfileController@edit');
    Route::post('/create', 'Auth\ProfileController@create');
    Route::post('/edit', 'Auth\ProfileController@update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
