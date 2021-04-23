@extends('layouts.auth')
@section('title', '方面別　投稿一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>方面別　投稿一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Auth\PostController@add') }}" role="button" class="btn btn-primary">新規作成</a>
                <a href="{{ action('Auth\PostController@result',['type'=>'mypost', 'direction' => isset($posts[0]) ? $posts[0]->direction : ''])}}" role="button" class="btn btn-primary">{{ Auth::user()->profile->username }}の投稿一覧</a>
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
        @foreach($posts as $post)
        <div class="row">
            <div class="text-center col-md-12">
                {{-- 選択された方面に合わせてtop画像を表示--}}
                @php $count = 0 @endphp
                    @if($post->direction === 'north_america')
                        <img src="{{secure_asset('images/north_america.png') }}" href="{{ action('Auth\PostController@search') }}" class="north_america" alt="north_america_image">
                    @elseif($post->direction === 'south_america')
                        <img src="{{secure_asset('images/south_america.png') }}" href="{{ action('Auth\PostController@search') }}" class="south_america" alt="south_america_image">
                    @elseif($post->direction === 'asia')
                        <img src="{{secure_asset('images/asia.png') }}" href="{{ action('Auth\PostController@search') }}" class="asia" alt="asia_image">
                    @elseif($post->direction === 'europe')
                        <img src="{{secure_asset('images/europe.png') }}" href="{{ action('Auth\PostController@search') }}" class="europe" alt="europe_image">
                    @elseif($post->direction === 'africa')
                        <img src="{{secure_asset('images/africa.png') }}" href="{{ action('Auth\PostController@search') }}" class="africa" alt="africa_image">
                    @elseif($post->direction === 'oceania')
                        <img src="{{secure_asset('images/oceania.png') }}" href="{{ action('Auth\PostController@search') }}" class="oceania" alt="oceania_image">
                @php $count +=1 @endphp

                    @endif                   
                    @if($count = 1)
                        @break
                    @endif 
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row row-cols-4 card-body bg-secondary">
        @foreach($posts as $post)
            <div class="col">
          {{-- directionがnorth_americaの場合 --}}
            @if ($post->direction === 'north_america')
                <img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap">
          {{-- directionがsouth_americaの場合 --}}
            @elseif ($post->direction === 'south_america')
                <img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap">
          {{-- directionがasiaの場合 --}}
            @elseif ($post->direction === 'asia')
                <img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap">
          {{-- directionがeuropeの場合 --}}
            @elseif ($post->direction === 'europe')
                <img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap">
          {{-- directionがafricaの場合 --}}
            @elseif ($post->direction === 'africa')
                <img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap">
          {{-- directionがoceaniaの場合 --}}
            @elseif ($post->direction === 'oceania')
                <img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap">
            @endif                
                <h4 class="card-title">{{ str_limit($post->title, 20) }}</h4>
                <a class="card-text" href="{{ action('Auth\ProfileController@show', ["id" =>$post->user_id]) }}"><p class="card-text">{{ str_limit($post ->user->profile->username, 20) }}</a>
                <p class="card-text">閲覧数：{{ $post->count }}</p>
                <p class="card-text">{{ str_limit($post->body, 650) }}</p>
                <p class="card-text">{{ $post->updated_at }}</p>
                {{-- ログインしているユーザーと投稿者のIDが一致したら編集ボタン、削除ボタンを表示 --}}
                @if(Auth::id() === ($post->user_id))
                    <a href="{{ action('Auth\PostController@edit', ['id' => $post->id]) }}" type="button" class="btn btn-primary">編集</a>
                    <a href="{{ action('Auth\PostController@delete',['id' => $post->id]) }}" type="button" class="btn btn-primary">削除</a>
                @endif
                    <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}" type="button" class="btn btn-primary">詳細</a>
            </div>
        @endforeach
        </div>
        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <a href="{{ action('Auth\PostController@index') }}"><button class="btn btn-primary btn-lg btn-block" type="button">投稿一覧に戻る</button></a>
            </div>
        </div>        
    </div>


@endsection