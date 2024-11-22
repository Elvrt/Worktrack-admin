<?php

namespace App\Http\Controllers;

use App\Models\ReportModel;
use Illuminate\Http\Request;

class APIreportcontroller extends Controller
{
    public function index(Request $request)
    {
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
                'clock_in_color' => $clockIn && strtotime($clockIn) > strtotime('09:00:00') 
                    ? 'red' 
                    : 'green', // Red if clock_in is after 09:00
                'clock_out' => $clockOut,
                'clock_out_color' => $clockOut && strtotime($clockOut) < strtotime('17:00:00') 
                    ? 'red' 
                    : 'green', // Red if clock_out is before 17:00
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
