{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'プロフィール新規作成'を埋め込む --}}
@section('title', 'プロフィール編集')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('Auth\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">ユーザー名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                        </div>
                    </div>  
                    
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="4">{{ old('introduction') }}</textarea>
                        </div>
                    </div>   
                    
                    <div class="form-group row">
                        <label class="col-md-2">行きたい国</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="want_to_travel_world" rows="4">{{ old('want_to_travel_world') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">行ったことある国</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="traveled_world" rows="4">{{ old('traveled_world') }}</textarea>
                        </div>
                    </div> 
                    
                    <div class="form-group row">
                        <label class="col-md-2">行きたい都道府県（日本）</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="want_to_travel_japan" rows="4">{{ old('want_to_travel_japan') }}</textarea>
                        </div>
                    </div>   
                    
                    <div class="form-group row">
                        <label class="col-md-2">行ったことある都道府県（日本）</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="traveled_japan" rows="4">{{ old('traveled_japan') }}</textarea>
                        </div>
                    </div> 
                    
                    <div class="form-group row">
                        <label class ="col-md-2">プロフィール画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="profile_image">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="image">プロフィール画像</label>
                        <div class="col-md-10 ">
                            <input type="file" class="form-control-file" name="profile_image">
                            {{-- ビューに現在設定中のプロフィール画像を表示 --}}
                            <img class = "col-md-10" src="{{secure_asset('storage/profile_image/'.$profile_form->image_path)}}">
                            <div class="form-text text-info">
                                設定中: {{ $profile_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection