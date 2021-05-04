{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'プロフィール新規作成'を埋め込む --}}
@section('title', 'プロフィール編集')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Update Profile</h2>
                </div>
                <form action="{{ action('Auth\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group row">
                        <label class="mt-2 col-form-label text-md-left">ユーザー名</label>
                        <input type="text" class="form-control" name="username" value="{{ $profile_form->username }}">
                    </div>  
                    
                    
                     <div class="form-group row">
                        <label class="col-form-label text-md-left">自己紹介</label>
                        <textarea class="form-control" name="introduction" rows="3">{{ $profile_form->introduction }}</textarea>
                    </div>   
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行きたい国</label>
                        <textarea class="form-control" name="want_to_travel_world" rows="3">{{ $profile_form->want_to_travel_world }}</textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行ったことある国</label>
                        <textarea class="form-control" name="traveled_world" rows="3">{{ $profile_form->traveled_world }}</textarea>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行きたい都道府県（日本）</label>
                        <textarea class="form-control" name="want_to_travel_japan" rows="3">{{ $profile_form->want_to_travel_japan }}</textarea>
                    </div>   
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行ったことある都道府県（日本）</label>
                        <textarea class="form-control" name="traveled_japan" rows="3">{{ $profile_form->traveled_japan }}</textarea>
                    </div> 
                    <div class="form-group row">
                        <label class ="col-form-label text-md-left" for="image">プロフィール画像</label>
                        <input type="file" class="form-control-file" name="profile_image">
                            {{-- ビューに現在設定中のプロフィール画像を表示 --}}
                            @if(isset($profile_form->image_path))
                            <img src="{{secure_asset('storage/profile_image/'.$profile_form->image_path)}}" class="profile_round_image mt-5 mx-auto" alt="profile_image">
                            @else
                            <img src="{{secure_asset('images/no_image.png') }}" class="profile_round_image mt-5 mx-auto" alt="no_image">
                            @endif                         
                    </div>
                    {{-- <img class = "col-md-10" src="{{secure_asset('storage/profile_image/'.$profile_form->image_path)}}"> --}}
                    <div class="form-text text-info">
                                設定中: {{ $profile_form->image_path }}
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                        </label>
                    </div>
                        
                    
                    <input type="hidden" name="id" value="{{ $profile_form->id }}">
                    {{ csrf_field() }}
                    <div class="form-group row mb-0">
                        <div class="col-md-12 mt-4 d-flex justify-content-center">
                            <button class="button-fill" type="submmit">
                                UPDATE
                            </button>
                        </div>
                    </div>    
                        
                        
                </form>
            </div>
        </div>
    </div>
@endsection