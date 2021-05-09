<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Trirec') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    
    </head>
<body>

    <div id="app" class="top_page">
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
                                <div class="col-md-6 d-flex justify-content-center">
                                    <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                                </div>

                                @if (Route::has('register'))
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                                    </div>
                                @endif
                            @endauth
                        @endif
                    </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top2.jpg')}}" alt="First slide">
                </div>


                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                            </div>
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top3.jpg')}}" alt="Second slide">
                </div>
                
                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                            </div>
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top4.jpg')}}" alt="Third slide">
                </div>
                
                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                            </div>
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top5.jpg')}}" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="top_logo" src="{{secure_asset('images/top/top_logo2.png')}}" alt="top_logo">
                        <div class="row top_button">
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('login') }}"><button type="button" class="top_btns btn ">ログイン</button></a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('register') }}"><button type="button" class="top_btns btn ">新規登録</button></a>
                            </div>
                        </div>
                    <img class="d-block w-100" src="{{secure_asset('images/top/top7.JPG')}}" alt="Sixth slide">
                </div>
            </div>
        </div>
    </div>
</body>
</html>