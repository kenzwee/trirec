@extends('layouts.auth')
@section('title', '方面選択')

@section('content')
    <div class="container">
        <div class="row">
            <h2>方面を選ぶ(画像をクリック！)</h2>
        </div>
 
        <div class="row">
            <div class="box text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'north_america']) }}"><img src="{{secure_asset('images/north_america.png') }}"  class="north_america" alt="north_america_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'south_america']) }}"><img src="{{secure_asset('images/south_america.png') }}"  class="north_america" alt="north_america_image"></a>
            </div>
        </div>        
        <div class="row">
            <div class="box text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'asia']) }}"><img src="{{secure_asset('images/asia.png') }}" class="asia" alt="asia_image"></a>
            </div>
        </div>                
        <div class="row">
            <div class="box text-center col-md-12">
                <a href="{{ action('Auth\PostController@result' , ['direction' => 'europe'])}}"><img src="{{secure_asset('images/europe.png') }}" class="europe" alt="europe_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'africa']) }}"><img src="{{secure_asset('images/africa.png') }}" class="africa" alt="africa_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'oceania']) }}"><img src="{{secure_asset('images/oceania.png') }}" class="oceania" alt="oceania_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <a href="{{ action('Auth\PostController@index') }}"><button class="btn btn-primary btn-lg btn-block" type="button">投稿一覧に戻る</button></a>
            </div>
        </div>
    </div>
@endsection