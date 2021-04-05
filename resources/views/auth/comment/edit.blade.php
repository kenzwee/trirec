@extends('layouts.auth')
@section('title', 'コメント編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>コメント編集</h2>
        </div>
            <form action="{{ action('Auth\CommentController@update') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row col-md-4 mt-5">
                    <h2>コメントはこちらから！</h2>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 mt-5">ユーザー名</label>
                        <div class="col-md-10 mt-5">
                            <p>{{ Auth::user()->profile->username }}</p>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">本文</label>
                </div>
                <div class="row col-md-10 mx-auto">
                    <textarea class="form-control" name="body" rows="5">{{ $comment_form->body }}</textarea>
                </div>
                    <input type="hidden" name="id" value="{{ $comment_form->id }}">
                    {{ csrf_field() }}
                <div class="row col-md-8 mx-auto mt-4">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="コメントする">
                </div>
            </form>
    </div>
@endsection