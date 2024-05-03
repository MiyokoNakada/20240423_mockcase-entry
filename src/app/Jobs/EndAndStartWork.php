<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Illuminate\Support\Carbon;

class EndAndStartWork implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //現在勤務中のユーザーに対する処理
        $attendances = Attendance::whereNull('work_finish')
            ->where('work_start', '<', Carbon::now())
            ->get();

        foreach ($attendances as $attendance) {
            $user = $attendance->user;

            if ($user->work_status === 'work_started' || $user->work_status === 'rest_finished') {
                // 勤務終了処理
                $attendance->work_finish = Carbon::now();
                $attendance->save();
                // 新しい勤務開始処理
                $newAttendance = new Attendance();
                $newAttendance->user_id = $attendance->user_id;
                $newAttendance->work_start = Carbon::now();
                $newAttendance->save();
                // ユーザーのステータス更新
                $user->work_status = 'work_started';
                $user->save();
            }
        }


        // 現在休憩中のユーザーに対する処理
        $rests = Rest::whereNull('rest_finish')
            ->whereNotNull('rest_start')
            ->get();

        foreach ($rests as $rest) {
            $attendance = $rest->attendance;
            $user = $attendance->user;

            if ($user->work_status === 'rest_started') {
                // 休憩終了処理
                $rest->rest_finish = Carbon::now();
                $rest->save();
                // 勤務終了処理
                $attendance->work_finish = Carbon::now();
                $attendance->save();
                // 新しい勤務開始処理
                $newAttendance = new Attendance();
                $newAttendance->user_id = $attendance->user_id;
                $newAttendance->work_start = Carbon::now();
                $newAttendance->save();
                // 新しい休憩開始処理
                $newrest = new Rest();
                $newrest->attendance_id = $newAttendance->id;
                $newrest->rest_start = Carbon::now();
                $newrest->save();
                // ユーザーのステータス更新
                $user->work_status = 'rest_started';
                $user->save();
            }
        }
    }
}
