@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance-content">
    <div class="attendance-ttl">
        <h2 class="attendance-ttl__text">
            <form action="/attendance" method="get">
                <input type="hidden" name="date" value="{{ \Carbon\Carbon::parse($date)->subDay()->toDateString() }}">
                <button type="submit">&lt;</button>
            </form>
            {{ $date }}
            <form action="/attendance" method="get">
                <input type="hidden" name="date" value="{{ \Carbon\Carbon::parse($date)->addDay()->toDateString() }}">
                <button type="submit">&gt;</button>
            </form>
        </h2>
    </div>

    <div class="attendance-table">
        <table class="attendance-table__inner">
            <tr class="attendance-table__row">
                <th class="attendance-table__header">名前</th>
                <th class="attendance-table__header">勤務開始</th>
                <th class="attendance-table__header">勤務終了</th>
                <th class="attendance-table__header">休憩時間</th>
                <th class="attendance-table__header">勤務時間</th>
            </tr>

            @foreach($attendanceLists as $attendanceList )
            <tr class="attendance-table__row">
                <td class="attendance-table__item">
                    <span>{{ $attendanceList->user->name }}</span>
                </td>
                <td class="attendance-table__item">{{ $attendanceList['work_start'] }}</td>
                <td class="attendance-table__item">{{ $attendanceList['work_finish'] }}</td>
                <td class="attendance-table__item">{{ $attendanceList->rest_duration }}</td>
                <td class="attendance-table__item">{{ $attendanceList->work_duration }}</td>
            </tr>
            @endforeach
        </table>
        <div class="attendance-table__pagenation">
            {{ $attendanceLists->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>




</div>
@endsection