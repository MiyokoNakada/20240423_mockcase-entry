<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    //attendanceページ表示
    public function attendance(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $attendanceLists = Attendance::with('user', 'rests')
            ->whereDate('work_start', $date)
            ->paginate(5);

        foreach ($attendanceLists as $attendance) {
            $calculatedData = $this->attendanceCalculate($attendance);
            $attendance->work_start = $calculatedData['work_start'];
            $attendance->work_finish = $calculatedData['work_finish'];
            $attendance->rest_duration = $calculatedData['rest_duration'];
            $attendance->work_duration = $calculatedData['work_duration'];
        }

        return view('attendance', compact('attendanceLists', 'date'));
    }

    //employeeページ表示
    public function employee(){
        $users = User::paginate(5);
        return view('employee', compact('users'));
    }

    //employee詳細一覧ページ表示
    public function employeeAttendance(Request $request)
    {
        $user = User::find($request->user_id);
        $attendanceLists = Attendance::with('rests')
            ->where('user_id', $request->user_id)
            ->paginate(5);

        foreach ($attendanceLists as $attendance) {
            $calculatedData = $this->attendanceCalculate($attendance);
            $attendance->work_day = $calculatedData['work_day'];
            $attendance->work_start = $calculatedData['work_start'];
            $attendance->work_finish = $calculatedData['work_finish'];
            $attendance->rest_duration = $calculatedData['rest_duration'];
            $attendance->work_duration = $calculatedData['work_duration'];
        }
        return view('employee_attendance', compact('attendanceLists', 'user'));
    }


    //勤務時間の計算
    public function attendanceCalculate(Attendance $attendance)
    {
        // 勤務開始時間と勤務終了時間をDateTimeオブジェクトに変換
        $workStart = new \DateTime($attendance->work_start);
        $workDay = $workStart->format('Y-m-d');
        if (!empty($attendance->work_finish)) {
            $workFinish = new \DateTime($attendance->work_finish);
            // 全体の勤務時間を計算
            $totalWorkDuration = $workFinish->diff($workStart);
            $totalWorkSeconds = ($totalWorkDuration->h * 3600) + ($totalWorkDuration->i * 60) + $totalWorkDuration->s;
        } else {
            $totalWorkSeconds = 0;
        }

        // 休憩時間を取得
        $totalRestDuration = 0;
        foreach ($attendance->rests as $rest) {
            $restStart = new \DateTime($rest->rest_start);
            $restFinish = new \DateTime($rest->rest_finish);
            $restDuration = $restFinish->diff($restStart);
            $totalRestDuration += ($restDuration->h * 3600) + ($restDuration->i * 60) + $restDuration->s;
        }

        // 勤務開始、終了10秒単位で切り捨て
        $workStartTimestamp = floor($workStart->getTimestamp() / 10) * 10;
        $workStartObj = new \DateTime('@' . $workStartTimestamp);
        $workStartObj->setTimezone(new \DateTimeZone('Asia/Tokyo'));
        $attendance->work_start = $workStartObj->format('H:i:s');
        if (!empty($attendance->work_finish)) {
            $workFinishTimestamp = floor($workFinish->getTimestamp() / 10) * 10;
            $workFinishObj = new \DateTime('@' . $workFinishTimestamp);
            $workFinishObj->setTimezone(new \DateTimeZone('Asia/Tokyo'));
            $attendance->work_finish = $workFinishObj->format('H:i:s');
        }

        // 休憩時間10秒単位で切り捨て
        $truncatedRestDuration = floor($totalRestDuration / 10) * 10;
        $hours = floor($truncatedRestDuration / 3600);
        $minutes = floor(($truncatedRestDuration % 3600) / 60);
        $seconds = $truncatedRestDuration % 60;
        $formattedRestDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        $attendance->rest_duration = $formattedRestDuration;

        // 全体の勤務時間ー休憩時間
        $effectiveWorkSeconds = $totalWorkSeconds - $totalRestDuration;
        $effectiveWorkSeconds = floor($effectiveWorkSeconds / 10) * 10;
        if ($effectiveWorkSeconds > 0) {
            $hours = floor($effectiveWorkSeconds / 3600);
            $minutes = floor(($effectiveWorkSeconds % 3600) / 60);
            $seconds = $effectiveWorkSeconds % 60;
            $effectiveWorkDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            $attendance->work_duration = $effectiveWorkDuration;
        } else {
            $attendance->work_duration =
                '00:00:00';
        }

        return [
            'work_day' => $workDay,
            'work_start' => $attendance->work_start,
            'work_finish' => $attendance->work_finish,
            'rest_duration' => $attendance->rest_duration,
            'work_duration' => $attendance->work_duration,
        ];
    }    
}
