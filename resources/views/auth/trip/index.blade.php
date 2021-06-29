@extends('layouts.auth')

@section('title', '旅行リスト一覧/Trirec')

@section('content')
    <div class="container">
        <div class="trip_index row">
            <div class="col-md-10 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Trip list</h2>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <a href="{{ action('Auth\TripController@add') }}"><button type="button" class="btn" role="button">新規作成</button></a>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ action('Auth\TripController@index') }}" method="get">
                            <div class="form-group row justify-content-end">
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" name="type" value="search">
                                    <input type="text" class="form-control" placeholder="旅行名で検索" name="trip_title" value="{{ $cond_title }}">
                                </div>
                                <div class="col-md-2">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="検索">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row text-center mt-2 mb-3">
                    <div class="col-md-4">
                        旅行名
                    </div>
                    <div class="col-md-5">
                        旅行期間
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>    
                <div class="row">
                @php $count = 0 @endphp
                    @foreach($trips as $trip)
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <a href="{{ action('Auth\TripController@show', ['id' => $trip->id]) }}" >{{ $trip->trip_title }}</a>
                        </div>
                        <div class="col-md-5 d-flex align-items-center justify-content-center">
                            {{ date("Y年m月d日", strtotime($trip->trip_start)) }}〜{{ date("Y年m月d日", strtotime($trip->trip_end)) }}
                        </div>
                      　<div class="index_btns col-md-3 d-flex justify-content-center">
                            <a href="{{ action('Auth\TripController@edit',['id'=>$trip->id]) }}" ><button type="button" class="edit_btn btn btn-sm">編集</button></a>
                            <button type="button" class="delete_btn btn btn-sm" data-toggle="modal" data-target="#auth_trip_index_Modal-{{ $trip->id }}" value="['id'=>{{ $trip->id }}]">削除</button>
                        </div>
                        <!-- 削除選択時の警告文 -->
                        <div class="modal fade" id="auth_trip_index_Modal-{{ $trip->id }}" tabindex="-1" role="dialog" aria-labelledby="auth_trip_index_ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="auth_trip_index_ModalLabel">本当に削除しますか？</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                    １度削除すると元に戻せません。
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <a href="{{ action('Auth\TripController@delete',['id'=>$trip->id]) }}" ><button type="button" class="delete_btn btn" id="deletebtn" name="deletebtn">削除する</button></a>
                                        <button type="button" class="stop_delete_btn btn" data-dismiss="modal">削除するのをやめる</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                @php $count += 1 @endphp
                    @if($count > 0)
                {{-- この</div>は1つの持ち物リストごとに１本線を引くためのもの--}}
                </div>
                    <hr class="index_line">
                    <div class = "row">
                @php $count = 0 @endphp
                    @endif 
                    @endforeach
                </div>
                {{--ページネーション--}}
                <div class="row d-flex justify-content-center">
                    {{ $trips->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection