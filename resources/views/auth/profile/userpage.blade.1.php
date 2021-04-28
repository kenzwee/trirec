@extends('layouts.profile')
@section('title', 'ユーザーページ')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ユーザーページ</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if(Auth::id() === ($profile->id))
                <a href="{{ action('Auth\ProfileController@edit') }}" role="button" class="btn btn-primary">プロフィール編集</a>
                @endif
            </div>
            {{ csrf_field() }}
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 mb-3 text-center">
                <h2>{{ $profile->username }}</h2>
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
            <div class="col-lg-12 mb-lg-5 pl-lg-5 mt-5 text-align:center">
                <h4 class="mb-3">自己紹介</h4>
                <p>{{ $profile->introduction }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-lg-5 pl-lg-5 mt-5">
                <h4 class="mb-3">旅行したい国</h4>
                <p>{{ $profile->want_to_travel_world }}</p>
            </div>
            <div class="col-lg-6 mb-lg-5 pl-lg-5 mt-5">
                <h4 class="mb-3">旅行したことのある国</h4>
                <p>{{ $profile->traveled_world }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-lg-5 pl-lg-5 mt-5">
                <h4 class="mb-3">旅行したい都道府県</h4>
                <p>{{ $profile->want_to_travel_japan }}</p>
            </div>
            <div class="col-lg-6 mb-lg-5 pl-lg-5 mt-5">
                <h4 class="mb-3">旅行したことがある都道府県</h4>
                <p>{{ $profile->traveled_japan }}</p>
            </div>
        </div>        
    </div>
    {{-- 横線 --}}
    <div class="container">
        <hr class="my-0">
    </div>
    
    <section class="u-content-space">
        <div class="container">
            <header class="text-center w-md-50 mx-auto mb-5">
                <h2 class="h1">My Post</h2>
            </header>
                    

                    
                    

          <!-- Work Content -->
         <div class="u-portfolio row no-gutters mb-6">
        @foreach($posts as $post)
        <div class="u-portfolio_a"> 
            <figure class="col-sm-6 col-md-4 u-portfolio__item" data-groups="[&quot;its-illustration&quot;]">
                @if ($post->image_path)
                <img class="u-portfolio__image" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Image Description">
                @endif
                    <figcaption class="u-portfolio__info">
                        <h6 class="mb-0">IX Project</h6>
                        <small class="d-block">Branding</small>
                    </figcaption>
            </figure>
        </div>

                
        @endforeach
        </div>
          <!-- End Work Content -->


     </section>
    
@endsection