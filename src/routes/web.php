<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\AuthController;
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


Route::middleware('verified')->group(
    function () {
        Route::get('/', [AuthController::class, 'index'])->name('index');
        Route::post('/workstart', [RecordController::class, 'workStart']);
        Route::post('/workfinish', [RecordController::class, 'workFinish']);
        Route::post('/reststart', [RecordController::class, 'restStart']);
        Route::post('/restfinish', [RecordController::class, 'restFinish']);
        Route::get('/attendance', [AttendanceController::class, 'attendance']);
    }
);
