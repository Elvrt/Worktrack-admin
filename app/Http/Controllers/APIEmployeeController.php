<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIEmployeeController extends Controller
{
    public function index()
    {
        $employees = EmployeeModel::all();

        return response()->json([
            'message' => 'Employee list retrieved successfully',
            'data' => $employees,
        ]);
    }

    public function show($id)
    {
        $employee = EmployeeModel::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Employee details retrieved successfully',
            'data' => $employee,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_number' => 'required|string|max:20|unique:employee,employee_number',
            'name' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:15|unique:employee,phone_number',
            'address' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = EmployeeModel::create($request->only([
            'employee_number',
            'name',
            'date_of_birth',
            'phone_number',
            'address',
        ]));

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'employee_id' => $employee->id,
        ]);

        return response()->json([
            'message' => 'Employee created successfully',
            'data' => $employee,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $employee = EmployeeModel::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'employee_number' => 'sometimes|string|max:20|unique:employee,employee_number,' . $id,
            'name' => 'sometimes|string|max:100',
            'date_of_birth' => 'sometimes|date',
            'phone_number' => 'sometimes|string|max:15|unique:employee,phone_number,' . $id,
            'address' => 'sometimes|string|max:100',
            'username' => 'sometimes|string|max:50|unique:user,username,' . $employee->user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'sometimes|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee->update($request->only([
            'employee_number',
            'name',
            'date_of_birth',
            'phone_number',
            'address',
        ]));

        $employee->user->update([
            'username' => $request->username ?? $employee->user->username,
            'role_id' => $request->role_id ?? $employee->user->role_id,
            'password' => $request->password ? Hash::make($request->password) : $employee->user->password,
        ]);

        return response()->json([
            'message' => 'Employee updated successfully',
            'data' => $employee,
        ]);
    }

    public function destroy($id)
    {
        $employee = EmployeeModel::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found',
            ], 404);
        }

        try {
            $employee->user->delete();
            $employee->delete();

            return response()->json([
                'message' => 'Employee deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete employee',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
