<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    //attendanceページ表示
    public function attendance(Request $request)
    {
        
        $date = $request->input('date', now()->toDateString());
        $attendanceLists = Attendance::with('user', 'rests')->whereDate('work_start', $date)->paginate(5);

        foreach ($attendanceLists as $attendanceList) {
            // 勤務開始時間と勤務終了時間をDateTimeオブジェクトに変換
            $workStart = new \DateTime($attendanceList['work_start']);

            if (!empty($attendanceList['work_finish'])) {
                $workFinish = new \DateTime($attendanceList['work_finish']);

                // 全体の勤務時間を計算
                $totalWorkDuration = $workFinish->diff($workStart);
                $totalWorkSeconds = ($totalWorkDuration->h * 3600) + ($totalWorkDuration->i * 60) + $totalWorkDuration->s;
            } else {
                $totalWorkSeconds = 0;
            }

            // 休憩時間を取得
            $totalRestDuration = 0;
            foreach ($attendanceList->rests as $rest) {
                $restStart = new \DateTime($rest->rest_start);
                $restFinish = new \DateTime($rest->rest_finish);
                $restDuration = $restFinish->diff($restStart);
                $totalRestDuration += ($restDuration->h * 3600) + ($restDuration->i * 60) + $restDuration->s;
            }

            // 勤務開始、終了10秒単位で切り捨て
            $workStartTimestamp = floor($workStart->getTimestamp() / 10) * 10;
            $workStartObj = new \DateTime('@' . $workStartTimestamp);
            $workStartObj->setTimezone(new \DateTimeZone('Asia/Tokyo'));
            $attendanceList['work_start'] = $workStartObj->format('H:i:s');
            if (!empty($attendanceList['work_finish'])) {
                $workFinishTimestamp = floor($workFinish->getTimestamp() / 10) * 10;
                $workFinishObj = new \DateTime('@' . $workFinishTimestamp);
                $workFinishObj->setTimezone(new \DateTimeZone('Asia/Tokyo'));
                $attendanceList['work_finish'] = $workFinishObj->format('H:i:s');
            }

            // 休憩時間10秒単位で切り捨て
            $truncatedRestDuration = floor($totalRestDuration / 10) * 10;
            $hours = floor($truncatedRestDuration / 3600);
            $minutes = floor(($truncatedRestDuration % 3600) / 60);
            $seconds = $truncatedRestDuration % 60;
            $formattedRestDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            $attendanceList->rest_duration = $formattedRestDuration;

            // 全体の勤務時間ー休憩時間
            $effectiveWorkSeconds = $totalWorkSeconds - $totalRestDuration;
            $effectiveWorkSeconds = floor($effectiveWorkSeconds / 10) * 10;
            if ($effectiveWorkSeconds > 0) {
                $hours = floor($effectiveWorkSeconds / 3600);
                $minutes = floor(($effectiveWorkSeconds % 3600) / 60);
                $seconds = $effectiveWorkSeconds % 60;
                $effectiveWorkDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                $attendanceList->work_duration = $effectiveWorkDuration;
            } else {
                $attendanceList->work_duration =
                    '00:00:00';
            }
        }
        return view('attendance', compact('attendanceLists', 'date'));
    }
}
