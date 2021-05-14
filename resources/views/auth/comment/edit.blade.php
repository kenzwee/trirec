@extends('layouts.auth')
@section('title', 'コメント編集/Trirec')

@section('content')
    <div class="container">
        <div class="post_comment row">
            <div class="col-md-6 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Update Comment</h2>
                </div>
                <form action="{{ action('Auth\CommentController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="mt-2 col-form-label text-md-left">ユーザー名</label>
                        <div class="form-control" name="username">
                            <p>{{ Auth::user()->profile->username}}</p>
                        </div>  
                    </div>
                    
                    <div class="form-group row">
                        <label class="mt-2 col-form-label text-md-left">本文</label>
                        <textarea class="form-control" name="body" rows="5">{{ $comment_form->body }}</textarea>
                    </div>
                        <input type="hidden" name="id" value="{{ $comment_form->id }}">
                        @csrf
                    <div class="row mt-4 d-flex justify-content-center">
                        <input type="submit" class="btn" value="更新">
                    </div>
                </form>
    </div>
@endsection