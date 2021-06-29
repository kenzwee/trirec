@extends('layouts.auth')
@section('title', '方面別投稿一覧/Trirec')

@section('content')
    <div class="container">
        <div class="row">
            <h2>方面別　投稿一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mt-1 mb-3">
                <a href="{{ action('Auth\PostController@result',['type'=>'mypost', 'direction' => isset($posts[0]) ? $posts[0]->direction : ''])}}" role="button" class="btn btn-primary">{{ Auth::user()->profile->username }}の投稿一覧</a>
            </div>
            <div class="col-md-8 mt-1 mb-3">
                <form action="{{ action('Auth\PostController@index') }}" method="get">
                    <div class="form-group row">
                        <div class="offset-md-2 col-md-8">
                            <input type="hidden" class="form-control" name="type" value="search">
                            <input type="text" class="form-control" placeholder="タイトルで検索" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @foreach($posts as $post)
        <div class="search_result_direction row">
            <div class="text-center col-md-12 mb-2">
                {{-- 選択された方面に合わせてtop画像を表示--}}
                @php $count = 0 @endphp
                    @if($post->direction === 'north_america')
                        <img src="{{secure_asset('images/north_america.png') }}" href="{{ action('Auth\PostController@search') }}" class="direction_img" alt="north_america_image">
                    @elseif($post->direction === 'south_america')
                        <img src="{{secure_asset('images/south_america.png') }}" href="{{ action('Auth\PostController@search') }}" class="direction_img" alt="south_america_image">
                    @elseif($post->direction === 'asia')
                        <img src="{{secure_asset('images/asia.png') }}" href="{{ action('Auth\PostController@search') }}" class="direction_img" alt="asia_image">
                    @elseif($post->direction === 'europe')
                        <img src="{{secure_asset('images/europe.png') }}" href="{{ action('Auth\PostController@search') }}" class="direction_img" alt="europe_image">
                    @elseif($post->direction === 'africa')
                        <img src="{{secure_asset('images/africa.png') }}" href="{{ action('Auth\PostController@search') }}" class="direction_img" alt="africa_image">
                    @elseif($post->direction === 'middle_east')
                        <img src="{{secure_asset('images/middle_east.png') }}" href="{{ action('Auth\PostController@search') }}" class="direction_img" alt="middle_east_image">
                    @elseif($post->direction === 'oceania')
                        <img src="{{secure_asset('images/oceania.png') }}" href="{{ action('Auth\PostController@search') }}" class="direction_img" alt="oceania_image">
                        
                @php $count +=1 @endphp

                    @endif                   
                    @if($count = 1)
                        @break
                    @endif 
            </div>
        </div>
        @endforeach
    </div>
    <div class="post_search_result container">
        <div class="row">
            <div class="no_post col-md-8">
                @if(count($posts) == 0)
                    投稿はありません
                @endif
            </div>
        @php $count = 1 @endphp
        @foreach($posts as $post)
            <div class="col-md-3">
                <div class="card w-100 h-100">
                    {{-- 目のアイコンを画像に重ねる--}}
                    <div class="card_image">
                        @if ($post->direction === 'north_america')
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                        @elseif ($post->direction === 'south_america')
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                        @elseif ($post->direction === 'asia')
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                        @elseif ($post->direction === 'europe')
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                        @elseif ($post->direction === 'africa')
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                        @elseif ($post->direction === 'middle_east')
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                        @elseif ($post->direction === 'oceania')
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Card image cap"></a>
                        @endif
                        <div class="eye">
                            <p class="count-text"><img src="{{secure_asset('images/eye_icon.png') }}" class="eye_icon" alt="eye_icon_image"> {{ $post->count }}</p>
                        </div>
                    </div>
                    <div class="card_body">
                        <div class="card_title">
                            {{ str_limit($post->title, 18) }}
                        </div>
                        <div class="card_text">
                            <p class="username"><a href="{{ action('Auth\ProfileController@show', ["id" =>$post->user_id]) }}">{{ str_limit($post ->user->profile->username, 10) }}</a></p>
                            <p class="create_at text-center">{{ date("Y年m月d日 H:i", strtotime($post->created_at)) }}</p>
                        </div>
                        {{-- ログインしているユーザーと投稿者のIDが一致したら編集ボタン、削除ボタンを表示 --}}
                        @if(Auth::id() === ($post->user_id))
                            <div class="index_btns d-flex justify-content-center">
                                <a href="{{ action('Auth\PostController@edit', ['id' => $post->id]) }}"><button type="button" class="edit_btn btn btn-sm">編集</button></a>
                                <!-- 削除選択時の警告文を表示するボタン -->
                                <button type="button" class="delete_btn btn btn-sm" data-toggle="modal" data-target="#auth_post_search_result_Modal-{{$post->id}}" value="['id'=>{{ $post->id }}]">削除</button> 
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- 削除選択時の警告文 -->
            <div class="modal fade" id="auth_post_search_result_Modal-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="auth_post_search_result_Modal" aria-hidden="true">
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
                            <a href="{{ action('Auth\PostController@delete',['id' => $post->id]) }}" ><button type="button" class="btn">削除する</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @php $count += 1 @endphp
            {{-- 投稿が４件になったら区切り線を挿入 --}}
            @if(4 < $count)
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
        <div class="col-6 mx-auto  mt-4">
            <a href="{{ action('Auth\PostController@index') }}"><button class="btn btn-primary btn-lg btn-block" type="button">投稿一覧に戻る</button></a>
        </div>
    </div>
@endsection