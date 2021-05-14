@extends('layouts.auth')
@section('title', '持ち物リスト編集/Trirec')

@section('content')
    <div class="trip_edit container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Update Item list</h2>
                </div>
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ action('Auth\TripController@update') }}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 mt-4 d-flex align-items-center">
                            <input type="text" class="form-control" name="trip_title" value="{{ $trip->trip_title }}">
                        </div>
                        <div class="col-md-5 mt-4 d-flex align-items-center justify-content-center">
                                <input type="date" id="trip_start" name="trip_start" value="{{ $trip->trip_start }}" min="2021-05-01" max="2025-12-31">〜
                                <input type="date" id="trip_end" name="trip_end" value="{{ $trip->trip_end }}" min="2021-05-01" max="2025-12-31">
                        </div>
                        <div class="col-md-2 mt-4">
                        {{-- 持ち物保存ボタン --}}
                            <button type="submit" class="btn">保存する</button>
                        </div>
                        
                        <div class="col-md-2 mt-4">
                        {{-- 持ち物を全て削除するボタン --}}
                            <button type="button" class="delete_btn btn" data-toggle="modal" data-target="#all_item_Modal" >持ち物全削除</button>
                        </div>
                        <!-- 削除選択時の警告文 -->
                        <div class="modal fade" id="all_item_Modal" tabindex="-1" role="dialog" aria-labelledby="all_item_ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="all_item_ModalLabel">本当に削除しますか？</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                    １度削除すると元に戻せません。
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <a href="{{ action('Auth\ItemController@alldelete',['id'=>$trip->id]) }}" ><button type="button" class="delete_btn btn" id="deletebtn" name="deletebtn">全ての持ち物削除する</button></a>
                                        <button type="button" class="stop_delete_btn btn" data-dismiss="modal">削除するのをやめる</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--tripとitemの区切り線--}}
                    <hr class="item_line">
                    <div class="detail_items_title row mt-2 mb-3">
                        <div class="col-md-3 text-center">
                            重要度
                        </div>
                        <div class="col-md-3 text-center">
                            持ち物
                        </div>
                        <div class="col-md-3 text-center">
                            メモ
                        </div>
                    </div>
                    {{-- TripController@showで定義した$tripの中の???からItemControllerで定義した$itemを１つ１つ取り出してる--}}
                    {{--$postデータベースから。comments:hasManyのリレーションを定義したやつ　$commentはforeach(comment as $comment) --}}
                    {{-- @foreach($trip->items as $item) --}}
                    <div class="add_items row">
                        @php $count = 0 @endphp
                            @foreach($items as $item)
                                {{-- 重要度 --}}
                                <div class="dropdown col-md-3 d-flex justify-content-center align-items-center">
                                    <select name="importance[]" id="importance-select" value="{{ $item->importance }}">
                                        <option value="">--重要度を選択--</option>
                                        <option value="2" {{ (($item->importance == 1)||($item->importance == 2)) ? "selected" : "" }}>S</option>
                                        <option value="3" {{ $item->importance == 3 ? "selected" : "" }}>A</option>
                                        <option value="4" {{ $item->importance == 4 ? "selected" : "" }}>B</option>
                                        <option value="5" {{ $item->importance == 5 ? "selected" : "" }}>C</option>
                                        <option value="6" {{ $item->importance == 6 ? "selected" : "" }}>D</option>
                                    </select>
                                </div>
                                {{-- 持ち物 --}}
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="goods[]" value="{{ $item->goods }}">
                                </div>
                                {{-- メモ --}}
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="memo[]" value="{{ $item->pivot->memo }}">
                                </div>
                                <div class="col-md-3 d-flex justify-content-center align-items-center">
                                    <a href="{{ action('Auth\ItemController@delete',['id'=>$item->id]) }}" ><button type="button" class="delete_btn btn btn-sm">削除</button></a>
                                </div>
                    <input type="hidden" name="item_ids[]" value="{{ $item->id }}">

                        @php $count += 1 @endphp
                            @if($count > 0)
                            {{-- この</div>は1つの持ち物ごとに１本線を引くためのもの--}}
                            </div>
                                <hr class="index_line">
                                <div class ="row">
                        @php $count = 0 @endphp
                            @endif 
                            @endforeach
                        </div>
                        @csrf
                        <input type="hidden" name="id" value="{{ $trip->id }}">
                </form>
                <div class="row text-left mt-5">
                    <h2 class="middle_title">Add Item</h2>
                </div>
                <form action="{{ action('Auth\ItemController@create') }}" method="post">
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}"> 
        
                    <div class="row text-center mt-3">
                        <label class ="col-md-3">重要度</label>
                            <div class="col-md-3">
                                持ち物
                            </div>
                            <div class="col-md-3">
                                メモ
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="dropdown col-md-3 d-flex justify-content-center">
                            <select name="importance" id="importance-select">
                                <option value="">---重要度を選択---</option>
                                <option value="2">S</option>
                                <option value="3">A</option>
                                <option value="4">B</option>
                                <option value="5">C</option>
                                <option value="6">D</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <input type="text" class="form-control" name="goods" value="">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <input type="text" class="form-control" name="memo" value="">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <input type="submit" class="btn" value="追加">
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
                <div class="row d-flex justify-content-center mt-5">
                    <a href="{{ action('Auth\TripController@index') }}"><button class="return_all_post btn" type="button">旅行リスト一覧に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection