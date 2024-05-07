@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/employee.css') }}">
@endsection

@section('content')
<div class="employee-content">
    <div class="employee-ttl">
        <h2 class="employee-ttl__text">
            従業員一覧
        </h2>
    </div>

    <div class="employee-table">
        <table class="employee-table__inner">
            <tr class="employee-table__row">
                <th class="employee-table__header">名前</th>
                <th class="employee-table__header"></th>
            </tr>
            @foreach($users as $user)
            <tr class="employee-table__row">
                <form class="employee-form" action="/employee/attendance" method="post">
                    @csrf
                    <td class="employee-table__item">
                        <span class="employee-table__item-text">
                            {{ $user->name }}
                        </span>
                    </td>
                    <td class="employee-table__item">
                        {{-- 表示されているユーザーのIDを取得してhiddenで送る --}}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button class="employee-table__item-btn" type="submit">勤務詳細
                        </button>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
        <div class="employee-table__pagenation">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

</div>
@endsection