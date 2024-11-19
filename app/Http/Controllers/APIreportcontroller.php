<?php

namespace App\Http\Controllers;
use App\Models\reportmodel;
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

        $reports = $query->get();

        // Format the response
        $data = $reports->map(function ($report) {
            return [
                'report_id' => $report->report_id,
                'activity_title' => $report->activity_title,
                'clock_in' => optional($report->absence)->clock_in,
                'clock_out' => optional($report->absence)->clock_out,
                'absence_date' => optional($report->absence)->absence_date,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
