@extends('layouts.top')

@section('title', 'Trirec')

@section('content')

    <div class="top_page">
        <div id="carouselInterval" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="3000">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                    <div class="row top_button">
                        @if (Route::has('login'))
                            @auth
                                <div class="col-md-12 d-flex justify-content-center">
                                    <a href="{{ route('top') }}"><button type="button" class="top_btns btn ">ホーム</button></a>
                                </div>
                            @else
                                <div class="offset-md-3 col-md-2 col-sm-6 d-flex justify-content-center">
                                    <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                                </div>
                                @if (Route::has('register'))
                                    <div class="offset-md-2 col-md-2 col-sm-6 d-flex justify-content-center">
                                        <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                                    </div>
                                @endif
                            @endauth
                        @endif
                    </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top1.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            @if (Route::has('login'))
                                @auth
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <a href="{{ route('top') }}"><button type="button" class="top_btns btn ">ホーム</button></a>
                                    </div>
                                @else
                                    <div class="offset-md-3 col-md-2 col-sm-6 d-flex justify-content-center">
                                        <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                                    </div>
    
                                    @if (Route::has('register'))
                                        <div class="offset-md-2 col-md-2 col-sm-6 d-flex justify-content-center">
                                            <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                                        </div>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top2.jpg')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            @if (Route::has('login'))
                                @auth
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <a href="{{ route('top') }}"><button type="button" class="top_btns btn ">ホーム</button></a>
                                    </div>
                                @else
                                    <div class="offset-md-3 col-md-2 col-sm-6 d-flex justify-content-center">
                                        <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                                    </div>
                                    @if (Route::has('register'))
                                        <div class="offset-md-2 col-md-2 col-sm-6 d-flex justify-content-center">
                                            <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                                        </div>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top3.jpg')}}" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            @if (Route::has('login'))
                                @auth
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <a href="{{ route('top') }}"><button type="button" class="top_btns btn ">ホーム</button></a>
                                    </div>
                                @else
                                    <div class="offset-md-3 col-md-2 col-sm-6 d-flex justify-content-center">
                                        <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                                    </div>
    
                                    @if (Route::has('register'))
                                        <div class="offset-md-2 col-md-2 col-sm-6 d-flex justify-content-center">
                                            <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                                        </div>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top5.jpg')}}" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            @if (Route::has('login'))
                                @auth
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <a href="{{ route('top') }}"><button type="button" class="top_btns btn ">ホーム</button></a>
                                    </div>
                                @else
                                    <div class="offset-md-3 col-md-2 col-sm-6 d-flex justify-content-center">
                                        <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                                    </div>
                                    @if (Route::has('register'))
                                        <div class="offset-md-2 col-md-2 col-sm-6 d-flex justify-content-center">
                                            <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                                        </div>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top4.jpg')}}" alt="fifth slide">
                </div>
            </div>
        </div>
    </div>
@endsection