<?php

namespace App\Http\Controllers;

use App\Models\ReportModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APIReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        $month = $request->get('month', now()->format('Y-m'));

        $data = ReportModel::whereHas('absence', function ($query) use ($employee, $month) {
            $query->where('employee_id', $employee->employee_id)
                ->where('absence_date', 'like', $month . '%');
        })
            ->with('absence')
            ->get()
            ->sortBy(function ($report) {
                return $report->absence->absence_date;
            })
            ->values();

        return response()->json([
            'status' => 'success',
            'message' => 'Report data found successfully',
            'data' => $data,
        ], 200);
    }

    public function show($id)
    {
        $data = ReportModel::with('absence')->where('report_id', $id)->first();
        
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Report data not found',
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Report data found successfully',
            'data' =>  $data,
        ], 200);
    }
}
