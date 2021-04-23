@extends('layouts.auth')
@section('title', '投稿内容')

@section('content')
    <div class="container">
        <div class="row">
            <h2>投稿内容</h2>
        </div>
        
        <div class="row">
            <p>閲覧数：{{ $post->count }}</p>
        </div>
        
        <div class="row">
            {{-- ビューに現在設定中の画像を表示 --}}
            <img class = "col-md-10 offset-md-1" src="{{secure_asset('storage/image/'.$post->image_path)}}">
        </div>
        <div class="row text-center">
            <div class="col-md-6">
                <p>{{ $post->user->profile->username }}</p>
            </div>
            <div class="col-md-6">
                <p>{{ $post->direction }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-5">
                <h2>タイトル</h2>
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-10 offset-md-1 border border-primary">
                <p>{{ $post->title }}</p>
            </div>    
        </div>
        <div class="row">
            <div class="col-md-4 mt-5">
                <h2>本文</h2>
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-10 offset-md-1 border border-primary">
                <p>{{ $post->body }}</p>
            </div>    
        </div>
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <a href="{{ action('Auth\PostController@index') }}"><button class="btn btn-primary btn-lg btn-block" type="button">全ての投稿一覧に戻る</button></a>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                @if($post->direction === 'north_america')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'north_america']) }}"><button class="btn btn-primary btn-lg btn-block" type="button">北アメリカ一覧に戻る</button></a>
                @elseif($post->direction === 'south_america')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'south_america']) }}"><button class="btn btn-primary btn-lg btn-block" type="button">南アメリカ一覧に戻る</button></a>
                @elseif($post->direction === 'asia')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'asia']) }}"><button class="btn btn-primary btn-lg btn-block" type="button">アジア一覧に戻る</button></a>
                @elseif($post->direction === 'europe')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'europe']) }}"><button class="btn btn-primary btn-lg btn-block" type="button">ヨーロッパ一覧に戻る</button></a>
                @elseif($post->direction === 'africa')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'africa']) }}"><button class="btn btn-primary btn-lg btn-block" type="button">アフリカ一覧に戻る</button></a>
                @elseif($post->direction === 'oceania')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'oceania']) }}"><button class="btn btn-primary btn-lg btn-block" type="button">オセアニア一覧に戻る</button></a>
                @endif
            </div>  
        </div>
        
        <form action="{{ action('Auth\CommentController@create') }}" method="post">
            <input type="hidden" name="post_id" value="{{ $post->id }}"> 
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
            <div class="row col-md-4 mt-5">
                <h2>コメント一覧</h2>
            </div>
            <h3>ユーザー名 --- コメント</h3>
            {{-- PostController@showで定義した$postの中のcommentsからCommentControllerで定義した$commentを１つ１つ取り出してる--}}
            {{-- $postデータベースから。comments:hasManyのリレーションを定義したやつ　$commentはforeach(comment as $comment) --}}
            
            @foreach($post->comments as $comment)
                <a href="{{ action('Auth\ProfileController@show', ["id" =>$comment->user_id]) }}"><li>{{ $comment->user->profile->username }}</a>--- {{ $comment->body }}({{ $comment->created_at}})</li>
                    @if(Auth::id() === ($comment->user_id))
                        <a href="{{ action('Auth\CommentController@edit', ['id' => $comment->id]) }}" type="button" class="btn btn-primary btn-sm">編集</a>
                        
                        <!-- 削除選択時の警告文を表示するボタン -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                          削除
                        </button>
                        <!-- 削除選択時の警告文 -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">本当に削除しますか？</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                    １度削除すると元に戻せません。
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">削除するのをやめる</button>
                                        <a href="{{ action('Auth\CommentController@delete',['id'=>$comment->id]) }}" ><button type="button" class="btn btn-primary ">削除する</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
            @endforeach 
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
                <textarea class="form-control" name="body" rows="5">{{ old('body') }}</textarea>
            </div>
            {{ csrf_field() }}
            <div class="row col-md-8 offset-md-2 mt-4">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="コメントする">
            </div>
        </form>
    </div>
@endsection