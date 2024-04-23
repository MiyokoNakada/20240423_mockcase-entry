<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //indexページ表示
    public function index(){
        return view ('index');
    }
}
