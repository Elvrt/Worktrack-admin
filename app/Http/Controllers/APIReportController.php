<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APIReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();
        
        // Get query parameters
        $date = $request->query('date'); // Specific date (YYYY-MM-DD)
        $month = $request->query('month'); // Month (YYYY-MM)

        // Query the data
        $query = ReportModel::with(['absence'])
            ->when($date, function ($query, $date) {
                return $query->whereHas('absence', function ($q) use ($date) {
                    $q->whereDate('absence_date', $date);
                });
            })
            ->when($month, function ($query, $month) {
                return $query->whereHas('absence', function ($q) use ($month) {
                    $q->where('absence_date', 'like', $month . '%');
                });
            });

        // Fetch and sort the reports
        $reports = $query->get()->sortBy(function ($report) {
            return optional($report->absence)->absence_date;
        });

        // Format the response
        $data = $reports->map(function ($report) {
            $clockIn = optional($report->absence)->clock_in;
            $clockOut = optional($report->absence)->clock_out;

            return [
                'report_id' => $report->report_id,
                'activity_title' => $report->activity_title 
                    ? substr($report->activity_title, 0, 10) // Limit to first 10 characters
                    : null,
                'clock_in' => $clockIn,
                'clock_out' => $clockOut,
                'absence_date' => optional($report->absence)->absence_date
                    ? date('d', strtotime($report->absence->absence_date)) // Only show day
                    : null,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data->values()->all(), // Ensure JSON uses indexed array
        ]);
    }
}
