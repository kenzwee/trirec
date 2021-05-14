@extends('layouts.auth')
@section('title', '新規登録/Trirec')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row col-md-12">
                <div class="page_title mx-auto mt-5">
                    Sign up
                </div>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="mt-2 col-form-label text-md-left">{{ __('messages.Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="email" class="mt-2 col-form-label text-md-left">{{ __('messages.E-Mail Address') }}<span class="caution">半角</span></label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="password" class="mt-2 col-form-label text-md-left">{{ __('messages.Password') }}<span class="caution">半角・8文字以上</span></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="mt-2 col-form-label text-md-left">{{ __('messages.Re-Enter Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group row mb-0 mt-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button class="btn" type="submmit">
                            {{ __('messages.Sign Up') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
