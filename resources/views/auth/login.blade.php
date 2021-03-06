@extends('layouts.auth')

@section('title', 'ログイン/Trirec')

@section('content')
    <div class="login container">
        <div class="row justify-content-center">
            <div class="row col-md-12">
                <h2 class="page_title mx-auto mt-5">Login</h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label for="email" class="mt-2 col-form-label text-md-left">
                        {{ __('messages.E-Mail Address') }}
                    </label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="password" class="mt-2 col-form-label text-md-left">
                         {{ __('messages.Password') }}
                    </label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group row">
                    <div class="col-form-label text-md-left">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button class="btn" type="submmit">
                            {{ __('messages.Login') }}
                        </button>
                    </div>
                </div>
            </form>                     
        </div>
    </div>
@endsection