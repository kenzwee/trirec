@extends('layouts.profile')
@section('title', 'ユーザーページ')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ユーザーページ</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Auth\ProfileController@edit') }}" role="button" class="btn btn-primary">プロフィール編集</a>
            </div>
            {{ csrf_field() }}
        </div>
        
        <div class="row">
            <div class="box text-center col-md-8">
                @if(isset($profile->image))
                <img src="{{secure_asset('storage/profile_image/'.$profile_image->image_path)}}" class="profile_round_image" alt="profile_image">
                @else
                <img src="{{secure_asset('images/no_image.png') }}" class="profile_round_image" alt="no_image">
                @endif
            </div>
        </div>
    </div>
@endsection