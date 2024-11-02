<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserData;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UserData::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Ensure role_id exists in roles table
            'employee_id' => 'required|exists:employees,id', // Ensure employee_id exists in employees table
            'username' => 'required|string|unique:user_data,username', // Username must be unique in the user_data table
            'password' => 'required|string|min:8' // Password with minimum length
        ]);

        // Store new data
        $save = new UserData;
        $save->role_id = $request->role_id;
        $save->employee_id = $request->employee_id;
        $save->username = $request->username;
        $save->password = Hash::make($request->password); // Hash password
        $save->save();

        return response()->json(['message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = UserData::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation rules
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'employee_id' => 'required|exists:employees,id',
            'username' => 'required|string|unique:user_data,username,' . $id, // Unique but ignore current user
            'password' => 'nullable|string|min:8' // Password optional on update
        ]);

        $data = UserData::find($id);
        if ($data) {
            $data->role_id = $request->role_id;
            $data->employee_id = $request->employee_id;
            $data->username = $request->username;

            // Only hash and update password if a new one is provided
            if ($request->filled('password')) {
                $data->password = Hash::make($request->password);
            }

            $data->save();
            return response()->json(['message' => 'Data updated successfully']);
        }

        return response()->json(['message' => 'Data not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = UserData::find($id);
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => 'Data not found'], 404);
    }
}
