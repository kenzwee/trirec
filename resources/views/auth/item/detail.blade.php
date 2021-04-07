@extends('layouts.auth')
@section('title', '持ち物リスト')

@section('content')
    <div class="container">
        <div class="row">
            <h2>持ち物リスト</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mt-4d-flex align-items-center border border-danger">
                <p>タイトル</p>
            </div>
            <div class="col-md-4 mt-4 d-flex align-items-center border border-danger">
                <p>旅行期間</p>
            </div>
            <div class="col-md-2 mt-4 d-flex align-items-center border border-danger">
                <p>title/period/body編集</p>
            </div>
            <div class="col-md-2 mt-4 d-flex align-items-center border border-danger">
                <p>全リスト削除</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-check d-flex align-items-center border border-danger">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                Default checkbox(ここにbody埋め込み？)
                </label>
            </div>
            <div class="col-md-2 d-flex align-items-center border border-danger">
                <p>削除</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-check d-flex align-items-center border border-danger">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                Default checkbox(ここにbody埋め込み？)
                </label>
            </div>
            <div class="col-md-2 d-flex align-items-center border border-danger">
                <p>削除</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-check d-flex align-items-center border border-danger">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                Default checkbox(ここにbody埋め込み？)
                </label>
            </div>
            <div class="col-md-2 d-flex align-items-center border border-danger">
                <p>削除</p>
            </div>
        </div>
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
                        <option value="s_rank">S</option>
                        <option value="a_rank">A</option>
                        <option value="b_rank">B</option>
                        <option value="c_rank">C</option>
                        <option value="d_rank">D</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="body">
                </div>
        </div>
        <div class="row d-flex justify-content-center mt-4 mb-4">
            <button type="button" class="btn btn-primary btn-lg">追加</button>
        </div>
            {{ csrf_field() }}
        <div class="row col-md-8 offset-md-2 mt-5">
            <input type="submit" class="btn btn-primary btn-lg btn-block" value="持ち物リスト一覧に戻る">
        </div>
    </div>
@endsection