{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')


{{-- profile.blade.phpの@yield('title')に'プロフィール新規作成'を埋め込む --}}
@section('title', 'プロフィール新規作成')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Create Profile</h2>
                </div>
                <form action="{{ action('Auth\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="mt-2 col-form-label text-md-left">ユーザー名</label>
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                    </div>  
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">自己紹介</label>
                        <textarea class="form-control" name="introduction" rows="3">{{ old('introduction') }}</textarea>
                    </div>   
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行きたい国</label>
                        <textarea class="form-control" name="want_to_travel_world" rows="3">{{ old('want_to_travel_world') }}</textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行ったことある国</label>
                        <textarea class="form-control" name="traveled_world" rows="3">{{ old('traveled_world') }}</textarea>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行きたい都道府県（日本）</label>
                        <textarea class="form-control" name="want_to_travel_japan" rows="4">{{ old('want_to_travel_japan') }}</textarea>
                    </div>   
                    <div class="form-group row">
                        <label class="col-form-label text-md-left">行ったことある都道府県（日本）</label>
                        <textarea class="form-control" name="traveled_japan" rows="4">{{ old('traveled_japan') }}</textarea>
                    </div> 
                    <div class="form-group row">
                        <label class ="col-form-label text-md-left">プロフィール画像</label>
                        <input type="file" class="form-control-file mt-1" name="profile_image">
                    </div>
                    {{ csrf_field() }}
                    
                    <div class="form-group row mb-0">
                        <div class="col-md-12 mt-3 d-flex justify-content-center">
                            <button class="button-fill" type="submmit">
                                ENTRY
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection