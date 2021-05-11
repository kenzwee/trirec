@extends('layouts.profile')
@section('title', 'ユーザーページ')

@section('content')
    <div class="profile_userpage container">
        <div class="row">
            <h2>ユーザーページ</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if(Auth::id() === ($profile->user_id))
                    <a href="{{ action('Auth\ProfileController@edit', ['id' => Auth::id()] ) }}" role="button" class="btn btn-primary">プロフィール編集</a>
                @endif
            </div>
            {{ csrf_field() }}
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 mb-4 text-center">
                <h2 class="middle_title">{{ $profile->username }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="box text-center col-md-12 mb-5">
                @if(isset($profile->image_path))
                <img src="{{secure_asset('storage/profile_image/'.$profile->image_path)}}" class="profile_round_image" alt="profile_image">
                @else
                <img src="{{secure_asset('images/no_image.png') }}" class="profile_round_image" alt="no_image">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-lg-5 pl-lg-5 mt-5 text-align:center">
                <h3 class="small_title mb-2">自己紹介</h3>
                <div class="introduction_field">
                    {{ $profile->introduction }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-lg-5 pl-lg-5 mt-5">
                <h3 class="small_title mb-2">旅行したい国</h3>
                <div class="information_field">
                    {{ $profile->want_to_travel_world }}
                </div>
            </div>
            <div class="col-md-6 mb-lg-5 pl-lg-5 mt-5">
                <h3 class="small_title mb-2">旅行したことのある国</h3>
                <div class="information_field">
                    {{ $profile->traveled_world }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-lg-5 pl-lg-5 mt-5">
                <h3 class="small_title mb-2">旅行したい都道府県</h3>
                <div class="information_field">
                    {{ $profile->want_to_travel_japan }}
                    </div>
            </div>
            <div class="col-md-6 mb-lg-5 pl-lg-5 mt-5">
                <h3 class="small_title mb-2">旅行したことがある都道府県</h3>
                <div class="information_field">
                    {{ $profile->traveled_japan }}
                </div>
            </div>
        </div> 
    </div>
    {{-- 横線 --}}
    <div class="my_post container">
        <hr class="my-0">
    </div>
    <section class="u-content-space">
        <div class="container">
            <header class="text-center w-md-50 mx-auto mb-5">
                <h3 class="middle_title">My Post</h2>
            </header>
            <!-- Work Content -->
            <div class="u-portfolio row no-gutters mb-5">
                @foreach($posts as $post)
                    <figure class="col-sm-6 col-md-4 u-portfolio__item">
                        @if ($post->image_path)
                            <a href="{{ action('Auth\PostController@show', ['id' => $post->id]) }}"><img class="u-portfolio__image" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Image Description"></a>
                        @endif
                        <figcaption class="u-portfolio__info">
                            <h6 class="mb-0">{{ $post->title }}</h6>
                            <small class="d-block">{{ str_limit(config('direction.names.' . $post->direction),20) }}</small>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
            <!-- End Work Content -->
            <div class="to_my_post row d-flex justify-content-center col-md">
                <a href="{{ action('Auth\PostController@index',['type'=>'userpage_post', 'id' => $profile ->user_id]) }}"><button type="button" class="btn">{{ $profile->username }}の投稿一覧</button></a>
            </div>
    </section>
@endsection