@extends('layouts.auth')

@section('title', '投稿詳細/Trirec')

@section('content')
    <div class="detail_page container">
        <div class="row">
            <h2>投稿詳細</h2>
        </div>
        <div class="row">
            <div class="detail_direction col-md-6">
            {{ str_limit(config('direction.names.' . $post->direction),20) }}
            </div>
            @if(Auth::id() === ($post->user_id))
                <div class="index_btns col-md-5 d-flex justify-content-end">
                    <a href="{{ action('Auth\PostController@edit', ['id' => $post->id]) }}"><button type="button" class="edit_btn btn">編集</button></a>
                    <button type="button" class="delete_btn btn" data-toggle="modal" data-target="#post_delete_modal">削除</button>
                </div>
            @endif

            <div class="modal fade" id="post_delete_modal" tabindex="-1" role="dialog" aria-labelledby="post_delete_modal_Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="post_delete_modal_Label">本当に削除しますか？</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                        １度削除すると元に戻せません。
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <a href="{{ action('Auth\PostController@delete',['id'=>$post->id]) }}" ><button type="button" class="delete_btn btn">削除する</button></a>
                            <button type="button" class="stop_delete_btn btn" data-dismiss="modal">削除するのをやめる</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        {{-- タイトル --}}
        <div class="detail_title row d-flex justify-content-center col-md-10 offset-md-1 mt-3 mb-3">
            {{ $post->title }}
        </div>    
        <div class="detail_body row d-flex justify-content-center">
            {{-- ビューに現在設定中の画像を表示 --}}
            <img class = "col-md-10" src="{{secure_asset('storage/image/'.$post->image_path)}}">
            {{-- 閲覧数 --}}
            <div class="detail_count col-md-5 d-flex align-items-center justify-content-center mt-2">
                <img src="{{secure_asset('images/eye_icon_black.png') }}" class="eye_icon" alt="eye_icon_image">{{ $post->count }}views
            </div>
            {{-- ユーザー名--}}
            <div class="detail_username col-md-5 text-center mt-2">
                <a class="detail_username" href="{{ action('Auth\ProfileController@show', ["id" =>$post->user_id]) }}">{{ $post->user->profile->username }}</a>
            </div>
            {{--本文--}}
            <div class="row col-md-10 mt-3">
                    <label class="col-form-label text-md-left"></label>
                    <textarea readonly class="detail_text form-control" name="body" rows="5">{{ $post->body }}</textarea>
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
            <div class="row mt-5 mb-2">
                <div class="middle_title col-md-2">
                    <h3>User name</h3>
                </div>
                <div class="middle_title col-md-9">
                    <h3>Comments</h3>
                </div>
            </div>
            @php $count = 0 @endphp
            <div class="comments row">
                @foreach($comments as $comment)
                    <div class="username col-md-2 d-flex align-items-center">
                        <a href="{{ action('Auth\ProfileController@show', ['id' =>$comment->user->id]) }}">{{ $comment->user->profile->username }}</a>
                    </div>
                    <div class="comment col-md-8 d-flex align-items-center">
                        {{ $comment->body }} ({{ date("Y年m月d日 H:i", strtotime($comment->created_at)) }})
                    </div>
                    <div class="comment_index_btns col-md-2 d-flex align-items-center">
                        @if(Auth::id() === ($comment->user_id))
                            <a href="{{ action('Auth\CommentController@edit', ['id'=>$comment->id]) }}" ><button type="button" class="edit_btn btn btn-sm">編集</button></a>
                            <a href="{{ action('Auth\CommentController@delete', ['id'=>$comment->id]) }}" ><button type="button" class="delete_btn btn btn-sm">削除</button></a>
                        @endif
                    </div>

                    @php $count += 1 @endphp
                    @if($count > 0)
        {{-- この</div>は１つのコメントを1グループとしてここで１本線を引くためのもの--}}
            </div>    
                        <hr color="#c0c0c0">
                        <div class = "row">
                    @php $count = 0 @endphp
                    @endif
            @endforeach 
                        </div>
                
            <div class="row d-flex justify-content-center">
                {{ $comments->appends(request()->query())->links() }}
            </div>
            <div class="middle_title row col-md-4 mt-5 mb-3">
                <h2>Comment it! <span class="caution">最大50文字</span></h2>
            </div>
            <div class="row col-md-10 mx-auto">
                <textarea class="form-control" name="body" rows="3">{{ old('body') }}</textarea>
            </div>
            @csrf
            <div class="row d-flex justify-content-center mt-4 mb-5">
                <input type="submit" class="btn" value="コメントする">
            </div>
        </form>
        <div class="return_btn row">
            <div class="col-6 mx-auto mt-3 mb-4 d-flex justify-content-center">
                <a href="{{ action('Auth\PostController@index') }}"><button class="return_all_post btn" type="button">全ての投稿一覧に戻る</button></a>
                @if($post->direction === 'north_america')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'north_america']) }}"><button class="return_direction_post btn" type="button">北アメリカ一覧に戻る</button></a>
                @elseif($post->direction === 'south_america')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'south_america']) }}"><button class="return_direction_post btn" type="button">南アメリカ一覧に戻る</button></a>
                @elseif($post->direction === 'asia')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'asia']) }}"><button class="return_direction_post btn" type="button">アジア一覧に戻る</button></a>
                @elseif($post->direction === 'europe')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'europe']) }}"><button class="return_direction_post btn" type="button">ヨーロッパ一覧に戻る</button></a>
                @elseif($post->direction === 'africa')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'africa']) }}"><button class="return_direction_post btn" type="button">アフリカ一覧に戻る</button></a>
                @elseif($post->direction === 'oceania')
                    <a href="{{ action('Auth\PostController@result', ['direction' => 'oceania']) }}"><button class="return_direction_post btn" type="button">オセアニア一覧に戻る</button></a>
                @endif
            </div>  
        </div>
    </div>
@endsection