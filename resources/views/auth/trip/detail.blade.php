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
            <div class="col-md-2 mt-4 d-flex align-items-center border border-danger">
                <p>title/period/body編集</p>
            </div>
            <div class="col-md-2 mt-4 d-flex align-items-center border border-danger">
                <p>全リスト削除</p>
            </div>
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
                {{-- TripController@showで定義した$tripの中の???からItemControllerで定義した$itemを１つ１つ取り出してる--}}
            　　{{--$postデータベースから。comments:hasManyのリレーションを定義したやつ　$commentはforeach(comment as $comment) --}}

                @foreach($trip->items as $item)
                <div class="row">
                    <div class="col-md-10 form-check d-flex align-items-center border border-danger">
                        <label class="form-check-label" for="defaultCheck1">
                            @if($item->check_flag == 0)
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="defaultCheck1">
                            @else($item->check_flage == 1)
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="defaultCheck1" checked>
                            @endif    
                                <p>{{ $item->body }}</p>
                        </label>
                    </div>
                        
                    <div class="col-md-2 d-flex align-items-center border border-danger">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                          削除
                        </button>
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
                                        <a href="{{ action('Auth\ItemController@delete',['id'=>$item->id]) }}" ><button type="button" class="btn btn-primary ">削除する</button></a>
                                    </div>
                                </div>
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
            <div class="row">
                <label class ="col-md-4">重要度</label>
                <div class="col-md-8">
                    <p>持っていくもの</p>
                </div>
            </div>
            <div class="form-group row">
                    <div class="dropdown col-md-4">
                        <select name="importance" id="importance-select">
                            <option value="">--重要度を選んでください--</option>
                            <option value="1">S</option>
                            <option value="2">A</option>
                            <option value="3">B</option>
                            <option value="4">C</option>
                            <option value="5">D</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="body" value="{{ old('body') }}">
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