<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    //indexページ表示
    public function index()
    {
        return view('index');
    }

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
