<?php

use App\Http\Controllers\reportcontroller;
use App\Http\Controllers\rolecontroller;
use App\Http\Controllers\TimeOffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('users/index');
});

Route::resource('absences', AbsenceController::class);
Route::resource('history', reportcontroller::class);
Route::resource('role', rolecontroller::class);
Route::get('/timeoff', [TimeOffController::class, 'index'])->name('timeoff.index');