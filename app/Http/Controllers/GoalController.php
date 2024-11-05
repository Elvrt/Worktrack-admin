<?php

namespace App\Http\Controllers;

use App\Models\GoalModel;
use App\Models\AssignmentModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Goal List',
            'list' => ['Home', 'Goal', 'List']
        ];

        $activeMenu = 'goal';

        $goals = GoalModel::all();

        return view('goal.index', compact('breadcrumb', 'goals', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Goal Create',
            'list' => ['Home', 'Goal', 'Create']
        ];

        $activeMenu = 'goal';

        $employees = EmployeeModel::all();

        return view('goal.create', compact('breadcrumb', 'employees', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'goal_date' => 'required|date',
                'project_title' => 'required|string|max:50',
                'project_description' => 'required|string|max:200',
                'employee_id' => 'required|array|min:1', // Ensures at least one employee is selected
                'employee_id.*' => 'exists:employee,employee_id' // Validates each ID
            ],
            [
                'goal_date.required' => 'The goal date field is required.',
                'goal_date.date' => 'The goal date must be a valid date.',

                'project_title.required' => 'The project title field is required.',
                'project_title.string' => 'The project title must be a string.',
                'project_title.max' => 'The project title may not be greater than 50 characters.',

                'project_description.required' => 'The project description field is required.',
                'project_description.string' => 'The project description must be a string.',
                'project_description.max' => 'The project description may not be greater than 200 characters.',

                'employee_id.required' => 'The employee name field is required.',
                'employee_id.array' => 'The employee name field must be an array.',
                'employee_id.*.exists' => 'One or more selected employees do not exist.'
            ]
        );

        $goal = GoalModel::create([
            'goal_date' => $request->goal_date,
            'project_title' => $request->project_title,
            'project_description' => $request->project_description,
        ]);

        foreach ($request->employee_id as $employee_id) {
            AssignmentModel::create([
                'employee_id' => $employee_id,
                'goal_id' => $goal->goal_id,
            ]);
        }

        return redirect('goal')->with('success', 'Goal data successfully saved');
    }

    public function show(string $id)
    {
        $goal = GoalModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Goal Detail',
            'list' => ['Home', 'Goal', 'Detail']
        ];

        $activeMenu = 'goal';

        $employees = EmployeeModel::all();

        return view('goal.show', compact('breadcrumb', 'goal', 'employees', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $goal = GoalModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Goal Edit',
            'list' => ['Home', 'Goal', 'Edit']
        ];

        $activeMenu = 'goal';

        $employees = EmployeeModel::all();

        return view('goal.edit', compact('breadcrumb', 'goal', 'employees', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'goal_date' => 'required|date',
                'project_title' => 'required|string|max:50',
                'project_description' => 'required|string|max:200',
                'employee_id' => 'required|array|min:1',
                'employee_id.*' => 'exists:employee,employee_id'
            ],
            [
                'goal_date.required' => 'The goal date field is required.',
                'goal_date.date' => 'The goal date must be a valid date.',

                'project_title.required' => 'The project title field is required.',
                'project_title.string' => 'The project title must be a string.',
                'project_title.max' => 'The project title may not be greater than 50 characters.',

                'project_description.required' => 'The project description field is required.',
                'project_description.string' => 'The project description must be a string.',
                'project_description.max' => 'The project description may not be greater than 200 characters.',

                'employee_id.required' => 'The employee name field is required.',
                'employee_id.array' => 'The employee name field must be an array.',
                'employee_id.*.exists' => 'One or more selected employees do not exist.'
            ]
        );

        $goal = GoalModel::findOrFail($id);
        $goal->update([
            'goal_date' => $request->goal_date,
            'project_title' => $request->project_title,
            'project_description' => $request->project_description,
        ]);

        $existingAssignments = AssignmentModel::where('goal_id', $goal->goal_id)->pluck('employee_id')->toArray();

        $newAssignments = array_diff($request->employee_id, $existingAssignments);
        foreach ($newAssignments as $employee_id) {
            AssignmentModel::create([
                'employee_id' => $employee_id,
                'goal_id' => $goal->goal_id,
            ]);
        }

        $removedAssignments = array_diff($existingAssignments, $request->employee_id);
        AssignmentModel::where('goal_id', $goal->goal_id)
            ->whereIn('employee_id', $removedAssignments)
            ->delete();

        return redirect('goal')->with('success', 'Goal data successfully changed');
    }

    public function destroy(string $id)
    {
        $goal = GoalModel::find($id);

        if (!$goal) {
            return redirect('goal')->with('error', 'Goal data not found');
        }

        try {
            AssignmentModel::where('goal_id', $id)->delete();

            $goal->delete();

            return redirect('goal')->with('success', 'Goal data successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('goal')->with('error', 'Goal data failed to be deleted due to existing associations with other tables');
        }
    }
}
