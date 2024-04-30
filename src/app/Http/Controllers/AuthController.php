<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //indexページ表示
    public function index(Request $request)
    {
        $user = $request->user();

        // データベースからユーザーのステータスを取得
        $workStatus = $user->work_status;

        // セッションにステータスを設定
        $request->session()->put('work_started', $workStatus === 'work_started');
        $request->session()->put('work_finished', $workStatus === 'work_finished');
        $request->session()->put('rest_started', $workStatus === 'rest_started');
        $request->session()->put('rest_finished', $workStatus === 'rest_finished');

        return view('index');
    }
}
