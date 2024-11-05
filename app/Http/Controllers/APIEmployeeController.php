<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $employees = EmployeeModel::with('user')->get();

        return response([
            'employees' => EmployeeModel::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = EmployeeModel::with('user')->where('employee_id', $id)->first();

        if (!$employee) {
            return response([
                'message' => 'Employee not found'
            ], 404);
        }

        return response([
            'employee' => $employee
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = EmployeeModel::find($id);
        if (!$employee) {
            return response([
                'message' => 'employee not found.'
            ], 403);
        }

        $attrs = $request->validate([
            'employee_number' => 'required|string|max:20|unique:employee,employee_number,' . $id . ',employee_id',
            'name' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:15|unique:employee,phone_number,' . $id . ',employee_id',
            'address' => 'required|string|max:100',
            // 'profile' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'username' => 'required|string|max:50|unique:user,username,' . $id . ',user_id',
            'password' => 'nullable|string|min:8',
            'password_confirm' => 'nullable|string|min:8|same:password',
            'role_id' => 'required|integer',
        ]);

        $employee->update([
            'employee_number' => $request->employee_number,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            // 'profile' => $request->profile,
        ]);

        $user = User::where('employee_id', $id)->update([
            'username' => $request->username,
            'role_id' => $request->role_id,
            'password' => $request->password ? bcrypt($request->password) : User::find($id)->password,
        ]);

        return response([
            'message' => 'employee updated.',
            'employee' => $employee,
            'user' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
