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

// トップ画面を表示
Route::get('/', function () {
    return view('top');
});


//PostController一覧
Route::group(['prefix' => 'auth', 'middleware'=> ['auth', 'profile']], function(){
    Route::get('post/create', 'Auth\PostController@add');
    Route::post('post/create', 'Auth\PostController@create');
    Route::get('post', 'Auth\PostController@index')->name('top');
    Route::get('post/edit', 'Auth\PostController@edit');
    Route::post('post/edit', 'Auth\PostController@update');
    Route::get('post/delete', 'Auth\PostController@delete');
    Route::get('post/search', 'Auth\PostController@search');
    Route::get('post/search_result', 'Auth\PostController@result');
    Route::get('post/detail', 'Auth\PostController@show')->name('post_detail');
});
//post フォームで送る時　何かをデータベースに追加・削除・変更する時書き込　
//追加、get 文字列だけ、見られてもいいもの　読み出し　画面表示など

//ProfileController一覧
Route::group(['prefix' => 'auth', 'middleware'=> ['auth','profile']],function(){
    Route::get('profile/create', 'Auth\ProfileController@add');
    Route::get('profile/edit', 'Auth\ProfileController@edit');
    Route::post('profile/create', 'Auth\ProfileController@create');
    Route::post('profile/edit', 'Auth\ProfileController@update');
    Route::get('profile/userpage', 'Auth\ProfileController@show')->name('userpage');
});

//CommentController一覧
Route::group(['prefix' => 'auth', 'middleware'=> ['auth', 'profile']],function(){
    Route::post('commment/create', 'Auth\CommentController@create');
    Route::get('comment/delete', 'Auth\CommentController@delete');
    Route::get('comment/edit', 'Auth\CommentController@edit');
    Route::post('comment/edit', 'Auth\CommentController@update');
});

//TripController一覧
Route::group(['prefix' => 'auth', 'middleware'=> ['auth', 'profile']],function(){
    Route::get('trip/index', 'Auth\TripController@index');
    Route::get('trip/detail', 'Auth\TripController@show');
    Route::get('trip/create', 'Auth\TripController@add');
    Route::post('trip/create', 'Auth\TripController@create');
    Route::get('trip/edit', 'Auth\TripController@edit');
    Route::post('trip/edit', 'Auth\TripController@update');
    Route::get('trip/delete', 'Auth\TripController@delete');
});

//ItemController一覧
Route::group(['prefix' => 'auth', 'middleware'=> ['auth', 'profile']],function(){
    Route::post('item/create', 'Auth\ItemController@create');
    Route::get('item/delete', 'Auth\ItemController@delete');
    Route::get('item/all_delete', 'Auth\ItemController@alldelete');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
