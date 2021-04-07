@extends('layouts.auth')
@section('title', '持ち物リスト一覧')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 auto-max">
                <h2>持ち物リスト一覧</h2>
            </div>
            <div class="col-md-4 auto-max">
                <a href="{{ action('Auth\ItemController@add') }}" role="button" class="btn btn-primary">リスト新規作成</a>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-4 mt-4 d-flex align-items-center border border-danger">
                <p>タイトル</p>
            </div>
            <div class="col-md-6 mt-4 d-flex align-items-center border border-danger">
                <p>旅行期間</p>
            </div>
            <div class="col-md-2 mt-4 border border-danger">
                <div class="h-50 d-flex align-items-center">
                    <p>編集編集編集</p>
                </div>
                <div class="h-50 d-flex align-items-center">
                    <p>削除削除削除</p>
                </div>
            </div>
        </div>
    </div>
@endsection