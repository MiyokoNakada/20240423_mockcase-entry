<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class RecordController extends Controller
{
    //勤務開始
    public function workStart(Request $request)
    {
        $user = $request->user();
        $attendance = new Attendance();
        $attendance->user_id = $user->id;
        $attendance->work_start = Carbon::now();
        $attendance->save();

        // 各ボタンの状態を設定
        // $request->session()->flush();
        $request->session()->put('work_started', True); //inactive
        $request->session()->put('work_finished', True); //active
        $request->session()->put('rest_started', True); //active
        $request->session()->put('rest_finished', False); //inactive
        //   dd($request);
        return redirect()->route('index');
    }

    //勤務終了
    public function workFinish(Request $request)
    {
        $user = $request->user();
        $attendance = Attendance::where('user_id', $user->id)
            ->orderBy('work_start', 'desc')
            ->first(); // 最新の勤務情報を取得

        if ($attendance) {
            $attendance->work_finish = Carbon::now();
            $attendance->save();
        }

        // 各ボタンの状態を設定
        $request->session()->put('work_started', False); //active
        $request->session()->put('work_finished', False); //inactive
        $request->session()->put('rest_started', False); //inactive
        $request->session()->put('rest_finished', False); //inactive

        return redirect()->route('index');
    }

    //休憩開始
    public function restStart(Request $request)
    {
        $user = $request->user();
        $latestAttendance = Attendance::where('user_id', $user->id)->orderBy('work_start', 'desc')->first();

        $rest = new Rest();
        $rest->attendance_id = $latestAttendance->id;
        $rest->rest_start = Carbon::now();
        $rest->save();

        // 各ボタンの状態を設定
        $request->session()->put('work_started', True); //inactive
        $request->session()->put('work_finished', False); //inactive
        $request->session()->put('rest_started', False); //inactive
        $request->session()->put('rest_finished', True); //active

        return redirect()->route('index');
    }

    //休憩終了
    public function restFinish(Request $request)
    {
        $user = $request->user();
        $attendanceId = Attendance::where('user_id', $user->id)->orderBy('work_start', 'desc')->first();
        $latestRest = Rest::where('attendance_id', $attendanceId->id)->orderBy('rest_start', 'desc')->first();

        if ($latestRest) {
            $latestRest->rest_finish = Carbon::now();
            $latestRest->save();
        }

        // 各ボタンの状態を設定
        $request->session()->put('work_started', True); //inactive
        $request->session()->put('work_finished', True); //active
        $request->session()->put('rest_started', True); //active
        $request->session()->put('rest_finished', False); //inactive

        return redirect()->route('index');
    }

}
