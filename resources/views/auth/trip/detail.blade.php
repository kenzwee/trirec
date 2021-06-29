@extends('layouts.auth')
@section('title', '持ち物リスト/Trirec')

@section('content')
    <div class="container">
        <div class="trip_detail row">
            <div class="col-md-10 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Item list</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-4 d-flex justify-content-center align-items-center">
                        {{ $trip->trip_title }}
                    </div>
                    <div class="col-md-4 mt-4 d-flex justify-content-center align-items-center">
                        {{ date("Y年m月d日", strtotime($trip->trip_start)) }}〜{{ date("Y年m月d日", strtotime($trip->trip_end)) }}
                    </div>
                    <div class="col-md-2 mt-4 d-flex align-items-center justify-content-center">
                       <a href="{{ action('Auth\TripController@edit',['id'=>$trip->id]) }}" ><button type="button" class="edit_btn btn">編集</button></a>
                    </div>
                    <div class="col-md-2 mt-4 d-flex align-items-center justify-content-center">
                    {{-- 持ち物を全て削除するボタン --}}
                        <button type="button" class="delete_btn btn" data-toggle="modal" data-target="#all_item_Modal" >
                        持ち物全削除
                        </button>
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
                                    <a href="{{ action('Auth\ItemController@alldelete',['id'=>$trip->id]) }}" ><button type="button" class="delete_btn btn" id="deletebtn" name="deletebtn">全ての持ち物を削除する</button></a>
                                    <button type="button" class="stop_delete_btn btn" data-dismiss="modal">削除するのをやめる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover mt-3 mb-3 text-center">
                    <thead class="thead">
                        <tr>
                        <th>重要度</th>
                        <th>持ち物</th>
                        <th>メモ</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                {{-- 重要度 --}}
                                @if($item->importance == "1" || $item->importance == "2")
                                    <td>S rank</td>
                                @elseif($item->importance == "3")
                                    <td>A rank</td>  
                                @elseif($item->importance == "4")
                                    <td>B rank</td>                                
                                @elseif($item->importance == "5")
                                    <td>C rank</td>    
                                @elseif($item->importance == "6")
                                    <td>D rank</td> 
                                @endif
                                <td>{{ $item->goods }}</td>
                                <td>{{ $item->pivot->memo }}</td>
                                <td><a href="{{ action('Auth\ItemController@delete',['id'=>$item->id]) }}" ><button type="button" class="delete_btn btn btn-sm">削除</button></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($items)==0)
                    <div class="no_item d-flex justify-content-center">
                        持ち物の登録はありません
                    </div>
                @endif
                <div class="row text-left mt-5">
                    <h2 class="middle_title">Add Item</h2>
                </div>
                <form action="{{ action('Auth\ItemController@create') }}" method="post">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
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
                    @csrf
                </form>
                <div class="row d-flex justify-content-center mt-5">
                    <a href="{{ action('Auth\TripController@index') }}"><button class="return_all_post btn" type="button">旅行リスト一覧に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection