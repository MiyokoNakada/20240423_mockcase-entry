@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="attendance-ttl">
    <h2 class="attendance-ttl__text">
        nameさんお疲れ様です！
    </h2>
</div>
<div class="attendance-content">
    <div class="work">
        <div class="work-start">
            <button class="work-start__btn">勤務開始</button>
        </div>
        <div class="work-finish">
            <button class="work-finish__btn">勤務終了</button>
        </div>
    </div>
    <div class="break">
        <div class="break-start">
            <button class="break-start__btn">休憩開始</button>
        </div>
        <div class="break-finish">
            <button class="break-finish__btn">休憩終了</button>
        </div>
    </div>

</div>

@endsection