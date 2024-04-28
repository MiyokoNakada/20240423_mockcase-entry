@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance-content">
    <div class="attendance-ttl">
        <h2 class="attendance-ttl__text">
            {{ Auth::user()->name }}さんお疲れ様です！
        </h2>
    </div>

    <div class="attendance-record">

        <div class="work-start">
            <form class="work-start__form" action="/workstart" method="POST">
                @csrf
                <button class="attendance-record__btn" type="submit" @if (session('work_started')==1) disabled @endif>
                    勤務開始
                </button>

            </form>
        </div>
        <div class="work-finish">
            <form class="work-finish__form" action="/workfinish" method="POST">
                @csrf
                <button class="attendance-record__btn" type="submit" @if (session('work_finished')!=1) disabled @endif>
                    勤務終了
                </button>
            </form>
        </div>
        <div class="rest-start">
            <form class="rest-start__form" action="/reststart" method="POST">
                @csrf
                <button class="attendance-record__btn" type="submit" @if (session('rest_started')!=1) disabled @endif>休憩開始</button>
            </form>
        </div>
        <div class="rest-finish">
            <form class="rest-finish__form" action="/restfinish" method="POST">
                @csrf
                <button class="attendance-record__btn" type="submit" @if (session('rest_finished')!=1) disabled @endif>休憩終了</button>
            </form>
        </div>
    </div>

</div>

@endsection