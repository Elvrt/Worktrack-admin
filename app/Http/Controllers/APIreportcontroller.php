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

        // Ambil employee ID dari user yang login
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        // Ambil parameter query
        $date = $request->query('date'); // Tanggal spesifik (YYYY-MM-DD)
        $month = $request->query('month'); // Bulan spesifik (YYYY-MM)

        // Query laporan dengan filter berdasarkan tabel absence
        $reports = ReportModel::with(['absence'])
            ->whereHas('absence', function ($query) use ($employee, $date, $month) {
                $query->where('employee_id', $employee->employee_id)
                    ->when($date, function ($q) use ($date) {
                        $q->whereDate('absence_date', $date);
                    })
                    ->when($month, function ($q) use ($month) {
                        $q->where('absence_date', 'like', $month . '%');
                    });
            })
            ->get()
            ->map(function ($report) {
                return [
                    'report_id' => $report->report_id,
                    'activity_title' => $report->activity_title
                        ? substr($report->activity_title, 0, 10)
                        : null,
                    'clock_in' => optional($report->absence)->clock_in,
                    'clock_out' => optional($report->absence)->clock_out,
                    'absence_date' => optional($report->absence)->absence_date
                        ? date('d', strtotime($report->absence->absence_date))
                        : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $reports->values()->all(),
        ]);
    }
}
