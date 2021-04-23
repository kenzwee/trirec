@extends('layouts.profile')
@section('title', 'ユーザーページ')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ユーザーページ</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                
                @if(Auth::id() === ($profile->id))
                <a href="{{ action('Auth\ProfileController@edit') }}" role="button" class="btn btn-primary">プロフィール編集</a>
                @endif
            </div>
            {{ csrf_field() }}
        </div>
        
        <div class="row">
            <div class="box text-center col-md-12">
                @if(isset($profile->image_path))
                <img src="{{secure_asset('storage/profile_image/'.$profile->image_path)}}" class="profile_round_image" alt="profile_image">
                @else
                <img src="{{secure_asset('images/no_image.png') }}" class="profile_round_image" alt="no_image">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 text-center">
                <h2>{{ $profile->username }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-5">
                <h2>自己紹介</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 border border-primary">
                <h2>{{ $profile->introduction }}</h2>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-4 mt-5">
                <h2>行きたい国</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 border border-primary">
                <h2>{{ $profile->want_to_travel_world }}</h2>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-4 mt-5">
                <h2>行ったことある国</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 border border-primary">
                <h2>{{ $profile->traveled_world }}</h2>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-4 mt-5">
                <h2>行きたい都道府県</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 border border-primary">
                <h2>{{ $profile->want_to_travel_japan }}</h2>
            </div>
        </div>  
                <div class="row">
            <div class="col-md-4 mt-5">
                <h2>行ったことある都道府県</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5 border border-primary">
                <h2>{{ $profile->traveled_japan }}</h2>
            </div>
        </div>  
    </div>
    
@endsection