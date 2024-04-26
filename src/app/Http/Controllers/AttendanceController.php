<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    //attendanceページ表示
    public function attendance()
    {
        return view('attendance');
    }
}
