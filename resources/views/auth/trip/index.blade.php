@extends('layouts.auth')
@section('title', '持ち物リスト一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>持ち物リスト一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Auth\TripController@add') }}" role="button" class="btn btn-primary">リスト新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Auth\TripController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">持ち物リストタイトル</label>
                            <div class="col-md-8">
                                <input type="hidden" class="form-control" name="type" value="search">
                                <input type="text" class="form-control" name="title" value="{{ $cond_title }}">
                            </div>
                            <div class="col-md-2">
                                {{ csrf_field() }}
                                    <input type="submit" class="btn btn-primary" value="検索">
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach($trips as $trip)
                @if(Auth::id() === ($trip->user_id))
                    <div class="col-md-4 mt-4 d-flex align-items-center border border-danger">
                        <a href="{{ action('Auth\TripController@show', ['id' => $trip->id]) }}">{{ $trip->title }}</a>
                    </div>
                    <div class="col-md-6 mt-4 d-flex align-items-center border border-danger">
                        <p>{{ date("Y年m月d日", strtotime($trip->trip_start)) }}〜</p>
                        <p>{{ date("Y年m月d日", strtotime($trip->trip_end)) }}</p>
                    </div>
                    <div class="col-md-2 mt-4 border border-danger">
                        <div class="h-50 d-flex align-items-center">
                            <p>編集編集編集</p>
                        </div>
                        <div class="h-50 d-flex align-items-center">
                            <p>削除削除削除</p>
                        </div>
                @endif    
                    </div>
            @endforeach
        </div>
    </div>
@endsection