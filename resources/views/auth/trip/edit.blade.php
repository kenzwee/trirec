@extends('layouts.auth')
@section('title', '持ち物リスト編集')

@section('content')
    <div class="container">
        <div class="row">
            <h2>持ち物リスト編集画面</h2>
        </div>
        <form action="{{ action('Auth\TripController@update') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 mt-4 d-flex align-items-center border border-danger">
                    <input type="text" class="form-control" name="title" value="{{ $trip->title }}">
                </div>
                <div class="col-md-4 mt-4 d-flex align-items-center justify-content-center border border-danger">
                    <p>
                        <input type="date" id="trip_start" name="trip_start" value="{{ $trip->trip_start }}" min="2021-05-01" max="2025-12-31">〜
                        <input type="date" id="trip_end" name="trip_end" value="{{ $trip->trip_end }}" min="2021-05-01" max="2025-12-31">
                    </p>
                </div>
                <div class="col-md-2 offset-md-2 mt-4 d-flex align-items-center border border-danger">
                    <p>全リスト削除</p>
                </div>
            </div>
            {{-- TripController@showで定義した$tripの中の???からItemControllerで定義した$itemを１つ１つ取り出してる--}}
            {{--$postデータベースから。comments:hasManyのリレーションを定義したやつ　$commentはforeach(comment as $comment) --}}
            @foreach($trip->items as $item)
                <div class="form-group row">
                    <div class="dropdown col-md-3 border border-danger">
                        <select name="importance" id="importance-select" value="{{ $item->importance }}">
                            
                            <option value="">--重要度を選んでください--</option>
                            <option value="2" {{ (($item->importance == 1)||($item->importance == 2)) ? "selected" : "" }}>S</option>
                            <option value="3" {{ $item->importance == 3 ? "selected" : "" }}>A</option>
                            <option value="4" {{ $item->importance == 4 ? "selected" : "" }}>B</option>
                            <option value="5" {{ $item->importance == 5 ? "selected" : "" }}>C</option>
                            <option value="6" {{ $item->importance == 6 ? "selected" : "" }}>D</option>
                        </select>
                    </div>
                    <div class="col-md-3 border border-danger">
                        <input type="text" class="form-control" name="goods" value="{{ $item->goods }}">
                    </div>
                    <div class="col-md-3 border border-danger ">
                        <input type="text" class="form-control" name="memo" value="{{ $item->memo }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-center border border-danger">
                        <button type="button" class="delete-confirm btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" value="['id'=>$item->id]">
                            削除
                        </button>
                    </div>
                </div>
            @endforeach
                <!-- 削除選択時の警告文 -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">本当に削除しますか？</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                            １度削除すると元に戻せません。
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">削除するのをやめる</button>
                                <a href="{{ action('Auth\ItemController@delete',['id'=>$item->id]) }}" ><button type="button" class="btn btn-primary" id="deletebtn" name="deletebtn">削除する</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                    @csrf
                <div class="row d-flex justify-content-center mt-4 mb-4">
                  <button type="submit" class="btn btn-primary btn-lg">保存する</button>
                </div>
            <input type="hidden" name="id" value="{{ $trip->id }}">
            
        </form>
        
                <div class="row">
                    <h2>持ち物追加</h2>
                </div>
                <form action="{{ action('Auth\ItemController@create') }}" method="post">
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}"> 
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                    <div class="row">
                        <label class ="col-md-3">重要度</label>
                            <div class="col-md-3">
                                <p>持っていくもの</p>
                            </div>
                            <div class="col-md-3">
                                <p>メモ</p>
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="dropdown col-md-3">
                            <select name="importance" id="importance-select">
                                <option value="">--重要度を選んでください--</option>
                                <option value="2">S</option>
                                <option value="3">A</option>
                                <option value="4">B</option>
                                <option value="5">C</option>
                                <option value="6">D</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="goods" value="{{ old('goods') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="memo" value="{{ old('memo') }}">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-4 mb-4">
                        <input type="submit" class="btn btn-primary btn-lg" value="追加">
                    </div>
                    {{ csrf_field() }}
                </form>
                <div class="row d-flex justify-content-center mt-5">
                    <a href="{{ action('Auth\TripController@index') }}"><input type="submit" class="btn btn-primary btn-lg btn-block" value="持ち物リスト一覧に戻る"></a>
                </div>
    </div>
@endsection