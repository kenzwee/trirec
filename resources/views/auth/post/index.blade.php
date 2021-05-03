@extends('layouts.auth')
@section('title', '登録済みの投稿一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>投稿一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Auth\PostController@add') }}" role="button" class="btn btn-primary">新規作成</a>
                <a href="{{ action('Auth\PostController@index',['type'=>'mypost']) }}" role="button" class="btn btn-primary">{{ Auth::user()->profile->username }}の投稿一覧</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Auth\PostController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="hidden" class="form-control" name="type" value="search">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
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
                        @if ($post->image_path)
                        {{-- 目のアイコンを画像に重ねる--}}
                        <div class="sample">
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                                <div class="eye">
                                    <p class="card-text"><img src="{{secure_asset('images/eye_icon.png') }}" class="eye_icon" alt="eye_icon_image"> {{ $post->count }}</p>
                                </div>
                        </div>
                        @endif
                        <div class="card-body bg-secondary">
                            <h4 class="card-title">{{ str_limit($post->title, 18) }}</h4>
                            <a class="card-text" href="{{ action('Auth\ProfileController@show', ["id" =>$post->user_id]) }}"><p class="card-text-username">{{ str_limit($post ->user->profile->username, 20) }}</p></a>
                            <p class="card-text-direction">{{ str_limit(config('direction.names.' . $post->direction),20) }}</p>
                            <p class="card-text">投稿:{{ date("Y年m月d日 H:i", strtotime($post->created_at)) }}</p>
                            


                            {{-- ログインしているユーザーと投稿者のIDが一致したら編集ボタン、削除ボタンを表示 --}}
                            @if(Auth::id() === ($post->user_id))
                            <a href="{{ action('Auth\PostController@edit', ['id' => $post->id]) }}" type="button" class="btn btn-primary">編集</a>
                            <a href="{{ action('Auth\PostController@delete',['id' => $post->id]) }}" type="button" class="btn btn-primary">削除</a>
                            @endif
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