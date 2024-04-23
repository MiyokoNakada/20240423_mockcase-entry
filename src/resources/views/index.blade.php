@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance-content">
    <div class="attendance-ttl">
        <h2 class="attendance-ttl__text">
            nameさんお疲れ様です！
        </h2>
    </div>

    <div class="attedance-record">
        
        <div class="work-start">
            <form class="work-start__form" action="/workstart" method="POST">
                @csrf
                {{-- ログインしているユーザーのIDを取得してhiddenで送る --}}
                {{-- <input type="hidden" name="user_id" value="{{ Auth::id() }}">--}}
                <button class="attedance-record__btn" type="submit" 
                 >勤務開始</button>
            </form>
        </div>
        <div class="work-finish">
            <button class="attedance-record__btn" type="submit">勤務終了</button>
        </div>
        <div class="rest-start">
            <button class="attedance-record__btn" type="submit">休憩開始</button>
        </div>
        <div class="rest-finish">
            <button class="attedance-record__btn" type="submit">休憩終了</button>
        </div>
    </div>

</div>

@endsection