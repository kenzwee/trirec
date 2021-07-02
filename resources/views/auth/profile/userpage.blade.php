@extends('layouts.profile')

@section('title', 'ユーザーページ/Trirec')

@section('content')
    <div class="profile_userpage container">
        <div class="row">
            <h2>ユーザーページ</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if(Auth::id() === ($profile->user_id))
                    <a href="{{ action('Auth\ProfileController@edit', ['id' => Auth::id()] ) }}" role="button" class="btn">プロフィール編集</a>
                @endif
            </div>
            @csrf
        </div>
        <div class="introduce row">
            <div class="col-md-6 img">
                @if(isset($profile->image_path))
                {{--<img src="{{secure_asset('storage/profile_image/'.$profile->image_path)}}" class="profile_round_image" alt="profile_image">--}}
                <img src="{{ $profile->image_path }}" class="profile_round_image" alt="profile_image">
                @else
                <img src="{{secure_asset('images/no_image.png') }}" class="profile_round_image" alt="no_image">
                @endif
            </div>
            <div class="col-md-6 mb-2 details">
                    <h2 class="user_name">{{ $profile->username }}</h2>
                    <div class="tags mb-2">
                        <div class="small_title">
                            自己紹介
                        </div>
                    </div>
                <textarea readonly class="detail_text form-control" name="body" rows="5">{{ $profile->introduction }}</textarea>
            </div>
        </div>
        <div class="introduce row">
            <div class="col-md-6 mb-2 details">
                    <div class="tags mb-2">
                        <div class="small_title">
                            旅行したい国
                        </div>
                    </div>
                <textarea readonly class="detail_text form-control" name="body" rows="5">{{ $profile->want_to_travel_world }}</textarea>
            </div>
            <div class="col-md-6 mb-2 details">
                    <div class="tags mb-2">
                        <div class="small_title">
                            旅行したことのある国
                        </div>
                    </div>
                <textarea readonly class="detail_text form-control" name="body" rows="5">{{ $profile->traveled_world  }}</textarea>
            </div>
        </div>
        <div class="introduce row">
            <div class="col-md-6 mb-2 details">
                    <div class="tags mb-2">
                        <div class="small_title">
                            旅行したい都道府県
                        </div>
                    </div>
                <textarea readonly class="detail_text form-control" name="body" rows="5">{{ $profile->want_to_travel_japan }}</textarea>
            </div>
            <div class="col-md-6 mb-2 details">
                    <div class="tags mb-2">
                        <div class="small_title">
                            旅行したことがある都道府県
                        </div>
                    </div>
                <textarea readonly class="detail_text form-control" name="body" rows="5">{{ $profile->traveled_japan }}</textarea>
            </div>
        </div>
    </div>
    {{-- 横線 --}}
    <div class="container">
        <hr class="my-0">
    </div>
    <section class="u-content-space">
        <div class="my_post container">
            <header class="text-center w-md-50 mx-auto mb-5">
                <h2 class="middle_title">My Post</h2>
            </header>
            <div class="u-portfolio row no-gutters mb-5">
                @foreach($posts as $post)
                    <figure class="col-sm-6 col-md-4 u-portfolio__item">
                        @if ($post->image_path)
                            {{--<a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="u-portfolio__image" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Image Description"></a>--}}
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="u-portfolio__image" src="{{ $post->image_path }}" alt="Image Description"></a>
                        @endif
                        <figcaption class="u-portfolio__info">
                            <h6 class="mb-0">{{ $post->title }}</h6>
                            <small class="d-block">{{ str_limit(config('direction.names.' . $post->direction),20) }}</small>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
            <div class="to_my_post col-md-4 mx-auto">
                <a href="{{ action('Auth\PostController@index',['type'=>'userpage_post', 'id' => $profile ->user_id]) }}"><button type="button" class="btn btn-block">{{ $profile->username }}の投稿一覧</button></a>
            </div>
        </div>
    </section>
@endsection