<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TimeOffController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('welcome');
});

// route login
Route::group(['prefix' => 'login'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/', [AuthController::class, 'authenticate'])->name('login');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    // route goal
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    // route goal & assignment
    Route::group(['prefix' => 'goal'], function () {
        Route::get('/', [GoalController::class, 'index'])->name('goal.index');
        Route::get('/create', [GoalController::class, 'create'])->name('goal.create');
        Route::post('/', [GoalController::class, 'store'])->name('goal.store');
        Route::get('/{id}', [GoalController::class, 'show'])->name('goal.show');
        Route::get('/{id}/edit', [GoalController::class, 'edit'])->name('goal.edit');
        Route::put('/{id}', [GoalController::class, 'update'])->name('goal.update');
        Route::delete('/{id}', [GoalController::class, 'destroy'])->name('goal.destroy');
    });

    // route event
    Route::group(['prefix' => 'event'], function () {
        Route::get('/', [EventController::class, 'index'])->name('event.index');
        Route::get('/create', [EventController::class, 'create'])->name('event.create');
        Route::post('/', [EventController::class, 'store'])->name('event.store');
        Route::get('/{id}', [EventController::class, 'show'])->name('event.show');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
        Route::put('/{id}', [EventController::class, 'update'])->name('event.update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('event.destroy');
    });

    // route role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('role.show');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    // route employee & user
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/{id}', [EmployeeController::class, 'show'])->name('employee.show');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });

    // route permision
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('/', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/{id}', [PermissionController::class, 'show'])->name('permission.show');
        Route::put('/{id}', [PermissionController::class, 'update'])->name('permission.update');
    });

    // route time off
    Route::group(['prefix' => 'time-off'], function () {
        Route::get('/', [TimeOffController::class, 'index'])->name('time-off.index');
        Route::get('/{id}', [TimeOffController::class, 'show'])->name('time-off.show');
        Route::delete('/{id}', [TimeOffController::class, 'destroy'])->name('time-off.destroy');
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', [ReportController::class, 'index'])->name('report.index');
        Route::get('/create', [ReportController::class, 'create'])->name('report.create');
        Route::post('/', [ReportController::class, 'store'])->name('report.store');
        Route::get('/{id}', [ReportController::class, 'show'])->name('report.show');
        Route::get('/{id}/edit', [ReportController::class, 'edit'])->name('report.edit');
        Route::put('/{id}', [ReportController::class, 'update'])->name('report.update');
        Route::delete('/{id}', [ReportController::class, 'destroy'])->name('report.destroy');
    });
});

