@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/employee_attendance.css') }}">
@endsection

@section('content')
<div class="employee-content">
    <div class="employee-ttl">
        <h2 class="employee-ttl__text">
            {{ $user['name'] }}さんの勤務一覧です
        </h2>
    </div>

    <div class="employee-table">
        <table class="employee-table__inner">
            <tr class="employee-table__row">
                <th class="employee-table__header">日付</th>
                <th class="employee-table__header">勤務開始</th>
                <th class="employee-table__header">勤務終了</th>
                <th class="employee-table__header">休憩時間</th>
                <th class="employee-table__header">勤務時間</th>
            </tr>

            @foreach($attendanceLists as $attendanceList )
            <tr class="employee-table__row">
                <td class="employee-table__item">
                    {{ $attendanceList['work_day'] }}
                </td>
                <td class="employee-table__item">
                    {{ $attendanceList['work_start'] }}
                </td>
                <td class="employee-table__item">
                    {{ $attendanceList['work_finish'] }}
                </td>
                <td class="employee-table__item">
                    {{ $attendanceList->rest_duration }}
                </td>
                <td class="employee-table__item">
                    {{ $attendanceList->work_duration }}
                </td>
            </tr>
            @endforeach

        </table>
        <div class="employee-table__pagenation">
            {{ $attendanceLists->appends(['user_id' => $user['id']])->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@endsection