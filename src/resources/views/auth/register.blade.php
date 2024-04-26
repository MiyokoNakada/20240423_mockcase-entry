@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-content">
    <div class="register-ttl">
        <h2 class="register-ttl__text">
            会員登録
        </h2>
    </div>
    <div class="register-form">
        <form class="register-form__form" action="/register" method="post">
            @csrf
            <div class="register-form__item">
                <input type="text" name="name" placeholder="名前">
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form__item">
                <input type="email" name="email" placeholder="メールアドレス">
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form__item">
                <input type="password" name="password" placeholder="パスワード">
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form__item">
                <input type="password" name="password_confirmation" placeholder="確認用パスワード">
                <div class="form__error">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-form__submit">
                <input class="register-form__submit-btn" type="submit" value="会員登録">
            </div>
        </form>
    </div>
    <div class="login-link">
        <p>アカウントをお持ちの方はこちらから</p>
        <a href="/login">ログイン</a>
    </div>


</div>
@endsection