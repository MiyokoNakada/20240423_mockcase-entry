@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-content">
    <div class="login-ttl">
        <h2 class="login-ttl__text">
            ログイン
        </h2>
    </div>
    <div class="login-form">
        <form class="login-form__form" action="/login" method="post">
            @csrf
            <div class="login-form__item">
                <input type="email" name="email" value="email" placeholder="メールアドレス">
            </div>
            <div class="login-form__item">
                <input type="password" name="password" value="password" placeholder="パスワード">
            </div>
            <input class="login-form__btn" type="submit" value="ログイン">
        </form>
    </div>
    <div class="register-link">
        <p>アカウントをお持ちでない方はこちらから</p>
        <a href="/register">会員登録</a>
    </div>

</div>




@endsection