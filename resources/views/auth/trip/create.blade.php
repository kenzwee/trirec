@extends('layouts.auth')

@section('title', '旅行リスト新規作成/Trirec')

@section('content')
    <div class="trip_create container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Create Trip</h2>
                </div>
                <form action="{{ action('Auth\TripController@create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="mt-2 col-form-label text-md-left">旅行名</label>
                        <input type="text" class="form-control" name="trip_title" placeholder="例：アメリカ卒業旅行" value="{{ old('trip_title') }}">
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class ="col-md-2 col-form-label text-md-left" for="trip_start">旅行開始日</label>
                        <input type="date" id="trip_start" name="trip_start" value="date(Y-m-d)" min="2021-05-01" max="2025-12-31">
                        <label class ="col-md-2 col-form-label text-md-left" for="trip_end">旅行終了日</label>
                        <input type="date" id="trip_end" name="trip_end" value="date(Y-m-d)" min="2021-05-01" max="2025-12-31">
                    </div> 
                    <div class="form-group row">
                        <label class ="col-md-2 mt-2" for="trip_start">持ち物候補</label>
                    </div>
                    @foreach($defaults as $default)  
                        {{-- seederで初期登録してあるitemとログインしてるユーザーが登録したitemを表示 --}}
                        @if(Auth::id() === ($default->user_id) || $default->user_id === 1)
                            <div class="form-check row  d-flex justify-content-center">
                                    <div class="col-md-4">
                                            {{--name属性を配列にすれば、Controllerに配列でデータを送れる　TripController@create--}}
                                            <input type="checkbox" name="item_id[]" class="default_item" value="{{ $default->id }}">
                                            <label class="defualt-item-label" for="customCheck1">{{ $default->goods }}</label>
                                    </div>
                            </div>  
                        @endif
                    @endforeach
                    @csrf
                    <div class="row d-flex justify-content-center mt-4 mb-5">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}"> 
                        <input type="submit" class="btn btn-block col-md-4" value="登録">
                    </div>
                    <div class="return_btn row d-flex justify-content-center">
                        <a href="{{ action('Auth\TripController@index') }}"><input type="submit" class="btn btn-block" value="旅行リスト一覧に戻る"></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection