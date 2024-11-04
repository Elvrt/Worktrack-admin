<?php

namespace App\Http\Controllers;

use App\Models\TimeOffModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Permission List',
            'list' => ['Home', 'Permission', 'List']
        ];

        $activeMenu = 'permission';

        $permissions = TimeOffModel::where('status', 'pending')->get();

        return view('permission.index', compact('breadcrumb', 'permissions', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Permission Create',
            'list' => ['Home', 'Permission', 'Create']
        ];

        $activeMenu = 'permission';

        $employees = EmployeeModel::all();

        return view('permission.create', compact('breadcrumb', 'employees', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required|string|max:200',
                // 'letter' => 'required|file|mimes:pdf|max:2048',
                'employee_id' => 'required',
            ],
            [
                'start_date.required' => 'The start date field is required.',
                'start_date.date' => 'The start date must be a valid date.',

                'end_date.required' => 'The end date field is required.',
                'end_date.date' => 'The end date must be a valid date.',
                'end_date.after_or_equal' => 'The end date must be a date after or equal to the start date.',

                'reason.required' => 'The reason field is required.',
                'reason.string' => 'The reason must be a valid string.',
                'reason.max' => 'The reason must not exceed 200 characters.',

                // 'letter.required' => 'The letter field is required.',
                // 'letter.file' => 'The letter must be a file.',
                // 'letter.mimes' => 'The letter must be a file of type: pdf.',
                // 'letter.max' => 'The letter file may not be larger than 2MB.',

                'employee_id.required' => 'The employee name field is required.',
            ]
        );

        TimeOffModel::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'letter' => $request->letter,
            'status' => 'pending',
            'employee_id'=> $request->employee_id,
        ]);

        return redirect('permission')->with('success', 'Permission data successfully saved');
    }

    public function show(string $id)
    {
        $permission = TimeOffModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Permission Detail',
            'list' => ['Home', 'Permission', 'Detail']
        ];

        $activeMenu = 'permission';

        $employees = EmployeeModel::all();

        return view('permission.show', compact('breadcrumb', 'permission', 'employees', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'status' => 'required',
            ]
        );

        TimeOffModel::find($id)->update([
            'status' => $request->status,
        ]);

        return redirect('permission')->with('success', 'Permission data successfully changed');
    }
}
