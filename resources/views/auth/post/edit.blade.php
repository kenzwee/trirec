@extends('layouts.auth')

@section('title', '投稿編集/Trirec')

@section('content')
    <div class="container">
        <div class="post_edit row">
            <div class="col-md-6 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Update Post</h2>
                </div>                
                <form action="{{ action('Auth\PostController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row mt-2">
                        <label class="col-md col-form-label text-md-left" for="image">画像<span class="caution">jpeg・jpg・png形式</span></label>
                        <input type="file" class="form-control-file mb-3" name="image">
                        {{-- ビューに現在設定中の画像を表示 --}}
                    </div>
                    <div class="form-group row">
                        <div class="d-flex justify-content-center">
                            {{--<img class = "col-md-10" src="{{secure_asset('storage/image/'.$post_form->image_path)}}">--}}
                            <img class = "col-md-10" src="{{ $post_form->image_path }}">
                        </div>
                        <div class="text-info text-center row col-md-10 mt-3">
                            設定中: {{ $post_form->image_path }}
                        </div>
                        <div class="form-check row mt-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <label class ="col-md-2">方面</label>
                        </div>
                        <div class="row select_direction">
                            <select name="direction" id="direction-select" value="{{ $post_form->direction }}">
                                <option value="">--方面を選んでください--</option>
                                <option value="north_america" {{ ($post_form->direction == "north_america") ? "selected" : "" }}>北アメリカ</option>
                                <option value="south_america" {{ ($post_form->direction == "south_america") ? "selected" : "" }}>南アメリカ</option>
                                <option value="asia" {{ ($post_form->direction == "asia") ? "selected" : "" }}>アジア</option>
                                <option value="europe" {{ ($post_form->direction == "europe") ? "selected" : "" }}>ヨーロッパ</option>
                                <option value="africa" {{ ($post_form->direction == "africa") ? "selected" : "" }}>アフリカ</option>
                                <option value="oceania" {{ ($post_form->direction == "oceania") ? "selected" : "" }}>オセアニア</option>
                                <option value="middle_east" {{ ($post_form->direction == "middle_east") ? "selected" : "" }}>中東</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md mt-2 ol-form-label text-md-left">タイトル</label>
                        <input type="text" class="form-control" name="title" value="{{ $post_form->title }}">
                    </div>
                    <div class="form-group row">
                        <label class="col-md mt-2 ol-form-label text-md-left">本文</label>
                        <textarea class="form-control" name="body" rows="10">{{ $post_form->body }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-6 mx-auto mt-4">
                            <input type="hidden" name="id" value="{{ $post_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-block" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection