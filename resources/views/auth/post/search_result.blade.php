@extends('layouts.auth')
@section('title', '方面別　投稿一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>方面別　投稿一覧</h2>
        </div>
 
        <div class="row">
            <div class="col-md-6">
                <img src="{{secure_asset('images/north_america.png') }}" href="{{ action('Auth\PostController@search') }}" class="north_america" alt="north_america_image">
            </div>
            <div class="col-md-6">
                <img src="{{secure_asset('images/south_america.png') }}" href="{{ action('Auth\PostController@search') }}" class="south_america" alt="south_america_image">
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-6">
                <img src="{{secure_asset('images/asia.png') }}" class="asia" alt="asia_image">
                <img src="{{secure_asset('images/europe.png') }}" class="europe" alt="europe_image">
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-12">
                <img src="{{secure_asset('images/africa.png') }}" class="africa" alt="africa_image">
                <img src="{{secure_asset('images/oceania.png') }}" class="oceania" alt="oceania_image">
            </div>
        </div>
        
    </div>
@endsection