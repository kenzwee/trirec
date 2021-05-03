@extends('layouts.auth')
@section('title', '投稿内容')

@section('content')
    <div class="container">
        <div class="row">
            <h2>投稿内容</h2>
        </div>
        
        <div class="row">
            <div class="col-md-6">
            {{ str_limit(config('direction.names.' . $post->direction),20) }}
            </div>
            <div class="col-md-5 d-flex justify-content-end">
                @if(Auth::id() === ($post->user_id))
                    <div class="button mr-1">
                    <a href="{{ action('Auth\PostController@edit', ['id' => $post->id]) }}" type="button" class="btn btn-primary btn-sm">編集</a>
                    </div>
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
                                    <a href="{{ action('Auth\PostController@delete',['id'=>$post->id]) }}" ><button type="button" class="btn btn-primary ">削除する</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>   
        </div>
        
        
        
        
        
        {{-- タイトル --}}
        <div class="row d-flex justify-content-center col-md-10 offset-md-1 mt-2 mb-3 border border-primary">
            <h2>{{ $post->title }}<h2>
        </div>    
        <div class="row d-flex justify-content-center">
            {{-- ビューに現在設定中の画像を表示 --}}
            <img class = "col-md-10" src="{{secure_asset('storage/image/'.$post->image_path)}}">
            {{-- 閲覧数 --}}
            <div class="col-md-5 text-center">
                <img src="{{secure_asset('images/eye_icon.png') }}" class="eye_icon" alt="eye_icon_image">{{ $post->count }}
            </div>
            {{-- ユーザー名--}}
            <div class="col-md-5 text-center">
                <a href="{{ action('Auth\ProfileController@show', ["id" =>$post->user_id]) }}">{{ $post->user->profile->username }}</a>
            </div>
            {{--本文--}}
            <div class="box text-center col-md-10 border border-primary">
                <p>{{ $post->body }}</p>
            </div>    
        </div>
        {{-- コメント投稿フォーム --}}
        <form action="{{ action('Auth\CommentController@create') }}" method="post">
            <input type="hidden" name="post_id" value="{{ $post->id }}"> 
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
            <div class="row mt-5">
                <div class="col-md-2">
                    <h3>User name</h3>
                </div>
                <div class="col-md-9">
                    <h3>Comments</h3>
                </div>
            </div>
            
            {{-- PostController@showで定義した$postの中のcommentsからCommentControllerで定義した$commentを１つ１つ取り出してる--}}
            {{-- $postデータベースから。comments:hasManyのリレーションを定義したやつ　$commentはforeach(comment as $comment) --}}
            @php $count = 0 @endphp
            {{-- @foreach($post->comments as $comment) --}}
            @foreach($comments as $comment)
                <div class="row">
                    <div class="col-md-2">
                        <a href="{{ action('Auth\ProfileController@show', ['id' =>$comment->user->id]) }}">{{ $comment->user->profile->username }}</a>
                    </div>
                    <div class="col-md-8">
                        {{ $comment->body }} ({{ date("Y年m月d日 H:i", strtotime($comment->created_at)) }})
                    </div>
                    <div class="col-md-2">
                        @if(Auth::id() === ($comment->user_id))
                            <a href="{{ action('Auth\CommentController@edit', ['id' => $comment->id]) }}" type="button" class="btn btn-primary btn-sm">編集</a>
                            
                            <!-- 削除選択時の警告文を表示するボタン -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                              削除
                            </button>
                    </div>
            
                            @php $count += 1 @endphp
                            @if($count > 0)
                {{-- この</div>は１つのコメントを1グループとしてここで１本線を引くためのもの--}}
                </div>
                                <hr color="#c0c0c0">
                                <div class = "row">
                            @php $count = 0 @endphp
                            @endif
                            
                </div>
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
            {{--ページネーション  2ページ目にどのpost_idかを知らせる為にappendsを使用--}}
            <div class="row d-flex justify-content-center">
                {{ $comments->appends(request()->query())->links() }}
            </div>
               
                
            <div class="row col-md-4 mt-5 mb-3">
                <h2>Comment it!</h2>
            </div>

            <div class="row col-md-10 mx-auto">
                <textarea class="form-control" name="body" rows="5">{{ old('body') }}</textarea>
            </div>
            {{ csrf_field() }}
            <div class="row col-md-8 offset-md-2 mt-4 mb-4">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="コメントする">
            </div>
        </form>
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-4 mb-4">
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
    </div>
@endsection