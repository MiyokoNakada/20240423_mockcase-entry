<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AttendanceController::class, 'index']);
Route::post('/workstart', [AttendanceController::class, 'workStart']);
Route::post('/workfinish', [AttendanceController::class, 'workFinish']);
Route::post('/breakstart', [AttendanceController::class, 'breakStart']);
Route::post('/breakfinish', [AttendanceController::class, 'breakFinish']);

Route::get('/attendance', [AttendanceController::class, 'attendance']);
Route::post('/attendance/before', [AttendanceController::class, 'beforeDate']);
Route::post('/attendance/next', [AttendanceController::class, 'nextDate']);
