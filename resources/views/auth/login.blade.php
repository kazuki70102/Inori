@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        ログイン情報を保持する
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    ログイン
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        パスワードを忘れた場合
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="providers pt-5 pl-5 text-center">
                        <a href="{{ route('login.provider', ['provider' => 'twitter']) }}" class="twitter mb-3">
                            <img src="{{ asset("/img/twitter.png") }}" width="20" class="mr-2">
                            twitterでログイン
                        </a>
                        <br>
                        <a href="{{ route('login.provider', ['provider' => 'facebook']) }}" class="facebook mb-3">
                            <img src="{{ asset("/img/facebook.png") }}" width="20" class="mr-2">
                            facebookでログイン
                        </a>
                    </div>
                    <div class="example pt-5">
                        <p>ログイン用ユーザー</p>
                        <span>ドライバー</span>
                        <br>
                        <span>メールアドレス: driver@test.com</span>
                        <span>パスワード: password</span>
                        <br>
                        <span>ライダー</span>
                        <br>
                        <span>メールアドレス: rider@test.com</span>
                        <span>パスワード: password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
