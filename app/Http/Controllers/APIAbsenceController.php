<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\AbsenceModel;
use App\Models\GoalModel;
use App\Models\AssignmentModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class APIAbsenceController extends Controller
{
    public function clockIn(Request $request)
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();
        $goal = AssignmentModel::whereHas('goal', function ($query) use ($employee) {
            $query->where('goal_date', '=', Carbon::now());
        })
            ->with('goal')
            ->where('employee_id', $employee->employee_id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee data found successfully',
            'goal' => $goal,
        ], 200);
    }

    public function clockOut(Request $request, string $id)
    {
        // Find the absence by ID
        $absence = AbsenceModel::find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        // Validate the incoming data
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'absence_date' => 'required|date',
            'clock_in' => 'nullable|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i',
            'location' => 'required|string',
            'status' => 'required|string',
            'created_at' => 'nullable|date',
        ]);

        // Update the absence record
        $absence->update($validatedData);

        // Return the updated absence record
        return response()->json($absence);
    }
}
