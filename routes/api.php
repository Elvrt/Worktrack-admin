<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIEmployeeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'timeoff'], function () {
    Route::get('/', [APITimeOffController::class, 'index']);
    Route::post('/store', [APITimeOffController::class, 'store']);
    Route::get('/show/{id}', [APITimeOffController::class, 'show']);
    Route::post('/edit/{id}', [APITimeOffController::class, 'edit']);
    Route::put('/update/{id}', [APITimeOffController::class, 'update']);
    Route::delete('/delete/{id}', [APITimeOffController::class, 'destroy']);
});

// Route::post("create_data", [APITimeOffController::class, "store"]); 