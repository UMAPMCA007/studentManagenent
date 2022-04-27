<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::middleware([
    'auth'
])-> group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/status', [DashBoardController::class, 'status'])->name('status');
    Route::get('/course', [DashBoardController::class, 'course'])->name('course');
    Route::post('/student_course', [DashBoardController::class, 'student_course'])->name('student_course');
    Route::post('/save_course', [DashBoardController::class, 'save_course'])->name('save_course');
    Route::get('/application', [DashBoardController::class, 'application'])->name('application');
    Route::get('/application_edit/{id}', [DashBoardController::class, 'application_edit'])->name('application_edit');
    Route::post('/application_update/{id}', [DashBoardController::class, 'application_update'])->name('application_update');
});
