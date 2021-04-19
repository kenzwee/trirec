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
                        <div class="col-md-4 mt-4 d-flex align-items-center border border-danger">
                            <a href="{{ action('Auth\TripController@show', ['id' => $trip->id]) }}">{{ $trip->title }}</a>
                        </div>
                        <div class="col-md-6 mt-4 d-flex align-items-center border border-danger">
                            <p>{{ date("Y年m月d日", strtotime($trip->trip_start)) }}〜</p>
                            <p>{{ date("Y年m月d日", strtotime($trip->trip_end)) }}</p>
                        </div>
                        <div class="col-md-2 mt-4 border border-danger">
                          　<div class="d-flex justify-content-center border border-danger">
                                <a href="{{ action('Auth\TripController@edit',['id'=>$trip->id]) }}" ><button type="button" class="btn btn-primary ">編集</button></a>
                            </div>
                          　<div class="d-flex justify-content-center border border-danger">
                                <a href="{{ action('Auth\TripController@delete',['id'=>$trip->id]) }}" ><button type="button" class="btn btn-primary ">削除</button></a>
                            </div>
                        </div>
                @endforeach
            </div>
        <div class="row d-flex justify-content-center">
        {{ $trips->links() }}
        </div>
    </div>
@endsection