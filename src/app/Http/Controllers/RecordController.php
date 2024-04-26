<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    //勤務開始
    public function workStart(Request $request)
    {
        $record = $request->only(['user_id']);
        $work_start = now();
        $record['work_start'] = $work_start;
        // dd($work_start);
        // Attendance::create($record); 

        redirect()->route('index');
    }
}
