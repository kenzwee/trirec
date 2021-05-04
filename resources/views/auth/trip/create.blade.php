@extends('layouts.auth')
@section('title', '旅行リスト新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>持ち物リスト新規作成</h2>
                <form action="{{ action('Auth\TripController@create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">旅行名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" placeholder="例：アメリカ卒業旅行" value="{{ old('title') }}">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class = "col-md-2" for="trip_start">旅行開始日</label>
                            <div class="col-md-4">
                                <input type="date" id="trip_start" name="trip_start" value="2021-05-01" min="2021-05-01" max="2025-12-31">
                            </div>
                        <label class = "col-md-2" for="trip_start">旅行終了日</label>
                            <div class="col-md-4">
                                <input type="date" id="trip_end" name="trip_end" value="2021-05-01" min="2021-05-01" max="2025-12-31">
                            </div>
                    </div> 
                    <div class="form-group row">
                        <label class = "col-md-2" for="trip_start">持ち物候補</label>
                    </div>
                    @foreach($defaults as $default)  
                        {{-- seederで初期登録してあるitemとログインしてるユーザーが登録したitemを表示 --}}
                        @if(Auth::id() === ($default->user_id) || $default->user_id === 1)
                            <div class="form-check row">
                                    <div class="col-md-4">
                                            {{--name属性を配列にすれば、Controllerに配列でデータを送れる　TripController@create--}}
                                            <input type="checkbox" name="item_id[]" class="default_item"  value="{{ $default->id }}">
                                            <label class="defualt-item-label" for="customCheck1">{{ $default->goods }}</label>
                                    </div>
                            </div>  
                        @endif
                    @endforeach
                    {{ csrf_field() }}
                    <div class="row mx-auto">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}"> 
                        <input type="submit" class="btn btn-primary" value="登録">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection