<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\AbsenceModel;
use App\Models\EventModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class APIHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();
        $absence = AbsenceModel::where('employee_id', $employee->employee_id)
            ->where('absence_date', '=', Carbon::now())
            ->get();
        $event = EventModel::whereDate('event_date', '>=', Carbon::today())
            ->limit(3)
            ->get();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Time Off data found successfully',
            'employee' => $employee,
            'absence' => $absence,
            'event' => $event,
        ], 200);
    }
}
