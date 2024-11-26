<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\APIHomeController;
use App\Http\Controllers\APIAbsenceController;
use App\Http\Controllers\APIEmployeeController;
use App\Http\Controllers\APIReportController;
use App\Http\Controllers\APITimeOffController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [APIAuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [APIAuthController::class, 'logout']);

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', [APIHomeController::class, 'index']);
    });

    Route::group(['prefix' => 'absence'], function () {
        Route::get('/goal', [APIAbsenceController::class, 'goal']);
        Route::post('/clockin', [APIAbsenceController::class, 'clockIn']);
        Route::post('/clockout', [APIAbsenceController::class, 'clockOut']);
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/show', [APIEmployeeController::class, 'show']);
        Route::post('/update', [APIEmployeeController::class, 'update']);
    });

    Route::group(['prefix' => 'timeoff'], function () {
        Route::get('/', [APITimeOffController::class, 'index']);
        Route::post('/store', [APITimeOffController::class, 'store']);
        Route::get('/show/{id}', [APITimeOffController::class, 'show']);
        Route::post('/edit/{id}', [APITimeOffController::class, 'edit']);
        Route::put('/update/{id}', [APITimeOffController::class, 'update']);
        Route::delete('/delete/{id}', [APITimeOffController::class, 'destroy']);
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', [APIReportController::class, 'index']);
        Route::get('/show/{id}', [APIReportController::class, 'show']);
    });
});
