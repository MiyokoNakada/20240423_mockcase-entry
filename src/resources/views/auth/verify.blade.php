@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify.css') }}">
@endsection

@section('content')
<div class="verify-content">
    <div class="verify-ttl">
        <h2 class="verify-ttl__text">
            アカウントの登録を受け付けました
        </h2>
    </div>
    <div class="verify-text">
        <p>
            ご登録いただいたメールアドレス宛に登録確認用のご案内をお送りしました。<br>
            メールの内容を確認して、アカウントの登録を完了してください。
        </p>
    </div>
    <div class="login-link">
        <p>ログイン画面へ</p>
        <a href="/login">ログイン</a>
    </div>
</div>
@endsection