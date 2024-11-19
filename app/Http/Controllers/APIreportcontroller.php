<?php

namespace App\Http\Controllers;
use App\Models\reportmodel;
use Illuminate\Http\Request;

class APIReportController extends Controller
{
    public function getReports($month)
    {
        // Retrieve reports based on the month
        $reports = reportmodel::whereMonth('created_at', $month) // Assumes `created_at` stores the date
            ->get(['created_at', 'clock_in', 'clock_out', 'activity_title']); // Adjust fields based on your database

        // Check if any reports are found
        if ($reports->isEmpty()) {
            return response()->json(['message' => 'No reports found for this month'], 404);
        }

        return response()->json($reports, 200);
    }
}
