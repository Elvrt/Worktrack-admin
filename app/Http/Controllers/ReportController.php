<?php

namespace App\Http\Controllers;

use App\Models\AbsenceModel;
use App\Models\ReportModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report List',
            'list' => ['Home', 'Report', 'List']
        ];

        $activeMenu = 'report';

        $reports = ReportModel::all();

        return view('report.index', compact('breadcrumb', 'reports', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Report Create',
            'list' => ['Home', 'Report', 'Create']
        ];

        $activeMenu = 'report';

        $employees = EmployeeModel::all();

        return view('report.create', compact('breadcrumb', 'employees', 'activeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'absence_date' => 'required|date',
                'clock_in' => 'required|date_format:H:i',
                'clock_out' => 'required|date_format:H:i|after_or_equal:clock_in',
                'activity_title' => 'required|string|max:50',
                'activity_description' => 'required|string|max:200',
                'employee_id' => 'required',
            ],
            [
                'absence_date.required' => 'The absence date field is required.',
                'absence_date.date' => 'The absence date must be a valid date.',

                'clock_in.required' => 'The clock in field is required.',
                'clock_in.date_format' => 'The clock in must be in the format HH:MM.',

                'clock_out.required' => 'The clock out field is required.',
                'clock_out.date_format' => 'The clock out must be in the format HH:MM.',
                'clock_out.after_or_equal' => 'The clock out must be a time after or equal to the clock in.',

                'activity_title.required' => 'The activity title field is required.',
                'activity_title.string' => 'The activity title must be a string.',
                'activity_title.max' => 'The activity title may not be greater than 50 characters.',

                'activity_description.required' => 'The activity description field is required.',
                'activity_description.string' => 'The activity description must be a string.',
                'activity_description.max' => 'The activity description may not be greater than 200 characters.',

                'employee_id.required' => 'The employee name field is required.',
            ]
        );

        if ($request->clock_in) {
            $clockInTime = \Carbon\Carbon::createFromFormat('H:i', $request->clock_in);
            $thresholdTime = \Carbon\Carbon::createFromTime(8, 0); // 08:00 AM

            $status = $clockInTime->lessThanOrEqualTo($thresholdTime) ? 'ontime' : 'late';
        }

        $absence = AbsenceModel::create([
            'absence_date' => $request->absence_date,
            'clock_in' => $request->clock_in ? $request->clock_in . ':00' : null,
            'clock_out' => $request->clock_out ? $request->clock_out . ':00' : null,
            'status' => $status,
            'employee_id' => $request->employee_id,
        ]);

        ReportModel::create([
            'activity_title' => $request->activity_title,
            'activity_description' => $request->activity_description,
            'absence_id' => $absence->absence_id,
        ]);

        return redirect('report')->with('success', 'Report data successfully saved');
    }

    public function show(string $id)
    {
        $report = ReportModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Report Detail',
            'list' => ['Home', 'Report', 'Detail']
        ];

        $activeMenu = 'report';

        $employees = EmployeeModel::all();

        return view('report.show', compact('breadcrumb', 'report', 'employees', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $report = ReportModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Report Edit',
            'list' => ['Home', 'Report', 'Edit']
        ];

        $activeMenu = 'report';

        $employees = EmployeeModel::all();

        return view('report.edit', compact('breadcrumb', 'report', 'employees', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'activity_title' => 'required|string|max:50',
                'activity_description' => 'required|string|max:200',
            ],
            [
                'activity_title.required' => 'The activity title field is required.',
                'activity_title.string' => 'The activity title must be a string.',
                'activity_title.max' => 'The activity title may not be greater than 50 characters.',

                'activity_description.required' => 'The activity description field is required.',
                'activity_description.string' => 'The activity description must be a string.',
                'activity_description.max' => 'The activity description may not be greater than 200 characters.',
            ]
        );

        $absence = AbsenceModel::find($id);

        ReportModel::where('absence_id', $id)->update([
            'activity_title' => $request->activity_title,
            'activity_description' => $request->activity_description,
        ]);

        return redirect('report')->with('success', 'Report data successfully changed');
    }

    public function destroy(string $id)
    {
        $absence = AbsenceModel::find($id);

        if (!$absence) {
            return redirect('report')->with('error', 'Absence data not found');
        }

        try {
            $report = ReportModel::where('absence_id', $absence->absence_id)->first();

            if ($report) {
                $report->delete();
            }

            $absence->delete();

            return redirect('report')->with('success', 'Report data successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('report')->with('error', 'Report data failed to be deleted due to existing associations with other tables');
        }
    }
}
