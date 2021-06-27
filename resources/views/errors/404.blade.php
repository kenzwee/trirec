@extends('layouts.auth')

@section('content')
<meta http-equiv="refresh" content=" 5; url=/auth/post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">{{ __('ページが見つかりません。') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        {{ __('申し訳ありません。ページが見つかりません。') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection