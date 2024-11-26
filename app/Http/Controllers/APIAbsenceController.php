<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\AbsenceModel;
use App\Models\ReportModel;
use App\Models\AssignmentModel;
use App\Models\TimeOffModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class APIAbsenceController extends Controller
{
    public function goal()
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();
        $goal = AssignmentModel::whereHas('goal', function ($query) use ($employee) {
            $query->where('goal_date', '=', Carbon::now());
        })
            ->with('goal')
            ->where('employee_id', $employee->employee_id)
            ->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Goal data found successfully',
            'goal' => $goal,
        ], 200);
    }
    public function clockIn()
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        $isOnLeave = TimeOffModel::where('employee_id', $employee->employee_id)
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->where('status', 'approved')
            ->exists();

        if ($isOnLeave) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are currently on leave and cannot clock in.',
            ], 403);
        }

        $absence = AbsenceModel::where('employee_id', $employee->employee_id)
            ->whereDate('absence_date', '=', Carbon::today())
            ->first();

        if ($absence) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clock-in record not found for today',
            ], 404);
        }

        $clock_in = Carbon::now()->format('H:i');

        if ($clock_in) {
            $clockInTime = Carbon::createFromFormat('H:i', $clock_in);
            $thresholdTime = Carbon::createFromTime(8, 0); // 08:00 AM

            $status = $clockInTime->lessThanOrEqualTo($thresholdTime) ? 'ontime' : 'late';
        }

        $absence = AbsenceModel::create([
            'absence_date' => Carbon::today(),
            'clock_in' => $clock_in,
            'clock_out' => null,
            'status' => $status,
            'employee_id' => $employee->employee_id,
        ]);

        ReportModel::create([
            'activity_title' => null,
            'activity_description' => null,
            'absence_id' => $absence->absence_id,
        ]);

        $data = [
            'employee' => [
                'employee_number' => $employee->employee_number,
                'name' => $employee->name,
            ],
            'absence' => [
                'absence_date' => $absence->absence_date,
                'clock_in' => $absence->clock_in,
                'clock_out' => $absence->clock_out,
                'status' => $absence->status,
            ],
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Clock-in successfully recorded',
            'data' => $data,
        ], 200);
    }

    public function clockOut(Request $request)
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        $request->validate([
            'activity_title' => 'required|string|max:50',
            'activity_description' => 'required|string|max:200',
        ]);

        $absence = AbsenceModel::where('employee_id', $employee->employee_id)
            ->whereDate('absence_date', '=', Carbon::today())
            ->first();

        if (!$absence) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clock-in record not found for today',
            ], 404);
        }

        $absence->update([
            'clock_out' => Carbon::now()->format('H:i'),
        ]);

        ReportModel::where('absence_id', $absence->absence_id)->update([
            'activity_title' => $request->activity_title,
            'activity_description' => $request->activity_description,
        ]);

        $report = ReportModel::where('absence_id', $absence->absence_id)->first();

        $data = [
            'employee' => [
                'employee_number' => $employee->employee_number,
                'name' => $employee->name,
            ],
            'absence' => [
                'absence_date' => $absence->absence_date,
                'clock_in' => $absence->clock_in,
                'clock_out' => $absence->clock_out,
                'status' => $absence->status,
            ],
            'report' => [
                'activity_title' => $report->activity_title,
                'activity_description' => $report->activity_description,
            ]
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Clock-out successfully recorded',
            'data' => $data,
        ], 200);
    }
}
