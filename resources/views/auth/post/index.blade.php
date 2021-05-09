@extends('layouts.auth')
@section('title', '登録済みの投稿一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>投稿一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mt-1 mb-3">
                <a href="{{ action('Auth\PostController@index',['type'=>'mypost']) }}" role="button" class="btn">{{ Auth::user()->profile->username }}の投稿一覧</a>
            </div>
            <div class="col-md-8 mt-1 mb-3">
                <form action="{{ action('Auth\PostController@index') }}" method="get">
                    <div class="form-group row">
                        <div class="offset-md-2 col-md-8">
                            <input type="hidden" class="form-control" name="type" value="search">
                            <input type="text" class="form-control" placeholder="タイトルで検索" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @php $count = 1 @endphp
            
            @foreach($posts as $post)
                <div class="col-md-3">
                    <div class="card w-100 h-100">
                        <div class="card_image">
                        {{-- 目のアイコンを画像に重ねる--}}
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                            <div class="eye">
                                <p class="count-text"><img src="{{secure_asset('images/eye_icon.png') }}" class="eye_icon" alt="eye_icon_image"> {{ $post->count }}</p>
                            </div>
                        </div>
                        <div class="card_body">
                            <div class="card_title">{{ str_limit($post->title, 18) }}</div>
                            <div class="card_text">
                                <p class="username"><a href="{{ action('Auth\ProfileController@show', ["id" =>$post->user_id]) }}">{{ str_limit($post ->user->profile->username, 20) }}</a></p>
                                <p class="direction"><a href="{{ action('Auth\PostController@result', ["direction" => $post->direction]) }}">{{ str_limit(config('direction.names.' . $post->direction),20) }}</a></p>
                                <p class="create_at text-center">{{ date("Y年m月d日 H:i", strtotime($post->created_at)) }}</p>
                                {{--<div class="card-text"><a href="{{ action('Auth\PostController@result', ["direction" => $post->direction]) }}">{{ str_limit(config('direction.names.' . $post->direction),20) }}</a></div>--}}
                            </div>
                            
                            {{-- ログインしているユーザーと投稿者のIDが一致したら編集ボタン、削除ボタンを表示 --}}
                            @if(Auth::id() === ($post->user_id))
                            <div class="index_btns d-flex justify-content-center">
                                <a href="{{ action('Auth\PostController@edit', ['id' => $post->id]) }}"><button type="button" class="edit_btn btn-sm">編集</button></a>
                                <!-- 削除選択時の警告文を表示するボタン -->
                                <button type="button" class="delete_btn btn btn-sm" data-toggle="modal" data-target="#auth_post_index_Modal-{{$post->id}}" value="['id'=>{{ $post->id }}]">
                                  削除
                                </button> 
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- 削除選択時の警告文 -->
                <div class="modal fade" id="auth_post_index_Modal-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="auth_post_index_Modal" aria-hidden="true">
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
                                <a href="{{ action('Auth\PostController@delete',['id' => $post->id]) }}" ><button type="button" class="btn btn-primary ">削除する</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @php $count +=1 @endphp
                @if($count > 4)
        {{-- この</div>は4つの投稿を1グループとしてここで１本線を引くためのもの--}}
        </div>
                    <hr color="#c0c0c0">
                    <div class = "row">
                @php $count = 1 @endphp
                @endif
            @endforeach
        </div>
        
        
        <div class="row d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection