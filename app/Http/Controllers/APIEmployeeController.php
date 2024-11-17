<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APIEmployeeController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        $user->employee = $employee;

        return response()->json([
            'status' => 'success',
            'message' => 'Employee data found successfully',
            'data' => $user,
        ], 200);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        $request->validate(
            [
                'name' => 'required|string|max:100',
                'date_of_birth' => 'required|date',
                'phone_number' => 'required|string|max:15|unique:employee,phone_number,' . $employee->employee_id . ',employee_id',
                'address' => 'required|string|max:100',
                'profile' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
                'username' => 'required|string|max:50|unique:user,username,' . $user->user_id . ',user_id',
            ]
        );

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $result = CloudinaryController::replace($employee->profile, $image->getRealPath(), 'worktrack/profile', 300, 300);
        } else {
            $result = $employee->profile;
        }

        $employee->update([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'profile' => $result,
        ]);

        $user->update([
            'username' => $request->username,
        ]);

        $user->employee = $employee;

        return response()->json([
            'status' => 'success',
            'message' => 'Employee data successfully updated',
            'data' => $user,
        ], 200);
    }
}
