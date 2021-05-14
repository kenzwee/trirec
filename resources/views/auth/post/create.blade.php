{{-- layouts/auth.blade.phpを読み込む --}}
@extends('layouts.auth')

{{-- auth.blade.phpの@yield('title')に'投稿新規作成'を埋め込む --}}
@section('title', '投稿新規作成/Trirec')

{{-- auth.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="post_create row">
            <div class="col-md-6 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">New Post</h2>
                </div>
                <form action="{{ action('Auth\PostController@create') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}"> 
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="post-create-form-group mt-2">
                        <div class="row">
                            <label class ="col-md-2">方面</label>
                        </div>
                        <div class="row select_direction">
                            <select name="direction" id="direction-select">
                                <option value="">--方面を選んでください--</option>
                                <option value="north_america">北アメリカ</option>
                                <option value="south_america">南アメリカ</option>
                                <option value="asia">アジア</option>
                                <option value="europe">ヨーロッパ</option>
                                <option value="africa">アフリカ</option>
                                <option value="oceania">オセアニア</option>
                                <option value="middle_east">中東</option>
                            </select>
                        </div>
                    </div>
                    <div class="post-create-form-group row">
                        <label class ="col-md mt-2 col-form-label text-md-left">画像<span class="caution">jpeg・jpg・png形式</span></label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    
                    <div class="post-create-form-group row">
                        <label class="col-md mt-2 ol-form-label text-md-left">タイトル</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                    
                    <div class="post-create-form-group row">
                        <label class="col-md mt-2 ol-form-label text-md-left">本文</label>
                        <textarea class="form-control" name="body" rows="10">{{ old('body') }}</textarea>
                    </div>
                        @csrf

                    <div class="row">
                        <div class="col-6 mx-auto mt-4">
                            <input type="submit" class="btn btn-block" value="投稿">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
