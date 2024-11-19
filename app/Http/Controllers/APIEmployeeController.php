<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APIEmployeeController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();
        $role = RoleModel::where('role_id', $user->role_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        $data = [
            'employee' => [
                'employee_number' => $employee->employee_number,
                'name' => $employee->name,
                'date_of_birth' => $employee->date_of_birth,
                'phone_number' => $employee->phone_number,
                'address' => $employee->address,
                'profile' => $employee->profile,
            ],
            'role' => [
                'position' => $role ? $role->position : null, // Jika role ditemukan, sertakan posisi
            ],
            'username' => $user->username,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Employee data found successfully',
            'data' =>  $data,
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
