<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\AbsenceModel;
use App\Models\EventModel;
use App\Models\TimeOffModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class APIHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();
        $absence = AbsenceModel::where('employee_id', $employee->employee_id)
            ->where('absence_date', '=', Carbon::today())
            ->first();
        $event = EventModel::whereDate('event_date', '>=', Carbon::today())
            ->limit(3)
            ->get();
        $timeoff = TimeOffModel::where('employee_id', $employee->employee_id)
            ->where('status', 'approved')
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Employee data found successfully',
            'employee' => $employee,
            'absence' => $absence,
            'event' => $event,
            'timeoff' => $timeoff,
        ], 200);
    }
}
