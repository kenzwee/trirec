@extends('layouts.auth')
@section('title', '持ち物リスト')

@section('content')
    <div class="container">
        <div class="row">
            <h2>持ち物リスト</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mt-4d-flex align-items-center border border-danger">
                <p>{{ $trip->title }}</p>
            </div>
            <div class="col-md-4 mt-4 d-flex align-items-center border border-danger">
                <p>{{ date("Y年m月d日", strtotime($trip->trip_start)) }} 〜 {{ date("Y年m月d日", strtotime($trip->trip_end)) }}</p>
            </div>
            <div class="col-md-2 mt-4 d-flex justify-content-center border border-danger">
               <a href="{{ action('Auth\TripController@edit',['id'=>$trip->id]) }}" ><button type="button" class="btn btn-primary ">編集</button></a>
            </div>
        
            
            <div class="col-md-2 mt-4 d-flex align-items-center border border-danger">
                            {{-- 持ち物を全て削除するボタン --}}
            
                <button type="button" class="delete-confirm btn btn-primary btn-block" data-toggle="modal" data-target="#all_item_Modal" >
                全ての持ち物削除
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">削除するのをやめる</button>
                            <a href="{{ action('Auth\ItemController@alldelete',['id'=>$trip->id]) }}" ><button type="button" class="btn btn-primary" id="deletebtn" name="deletebtn">全ての持ち物削除する</button></a>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
        
                {{-- TripController@showで定義した$tripの中の???からItemControllerで定義した$itemを１つ１つ取り出してる--}}
            　　{{--$postデータベースから。comments:hasManyのリレーションを定義したやつ　$commentはforeach(comment as $comment) --}}
    
        {{-- @foreach($trip->items as $item) --}}
        @foreach($items as $item)
            <div class="row">
                <div class="col-md-3 form-check d-flex align-items-center border border-danger">
                    <label class="form-check-label" for="defaultCheck1">
                            @if($item->importance == "1" || $item->importance == "2")
                            <p>S rank</p>
                            @elseif($item->importance == "3")
                            <p>A rank</p>  
                            @elseif($item->importance == "4")
                            <p>B rank</p>                                
                            @elseif($item->importance == "5")
                            <p>C rank</p>    
                            @elseif($item->importance == "6")
                            <p>D rank</p> 
                            @endif
                    </label>
                </div>
                
                <div class="col-md-3 form-check d-flex align-items-center border border-danger">
                    <label class="form-check-label" for="defaultCheck1">
                            <p>{{ $item->goods }}</p>
                    </label>
                </div>
                <div class="col-md-3 form-check d-flex align-items-center border border-danger">
                    <label class="form-check-label" for="defaultCheck1">
                            <p>{{ $item->pivot->memo }}</p>
                    </label>
                </div>
                <div class="col-md-3 d-flex align-items-center border border-danger">
                    <button type="button" class="delete-confirm btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal-{{ $item->id }}" value="['id'=>{{ $item->id }}]">
                      削除
                    </button>
                </div>
            </div>
        <!-- 削除選択時の警告文 -->
        <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        @endforeach
        
        <div class="row d-flex justify-content-center mt-4 mb-4">
          <button type="button" class="btn btn-primary btn-lg">保存する</button>
        </div>
        
        
        <div class="row">
            <h2>持ち物追加</h2>
        </div>
        <form action="{{ action('Auth\ItemController@create') }}" method="post">
            <input type="hidden" name="trip_id" value="{{ $trip->id }}"> 

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
                    <input type="text" class="form-control" name="goods" value="">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="memo" value="">
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