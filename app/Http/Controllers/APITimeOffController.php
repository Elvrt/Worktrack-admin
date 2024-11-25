<?php

namespace App\Http\Controllers;

use App\Models\TimeOffModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APITimeOffController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee data not found',
            ], 404);
        }

        $data = TimeOffModel::where('employee_id', $employee->employee_id)
                ->with('employee') // Include employee data
                ->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Time Off data found successfully',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'employee_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
            'letter' => 'nullable|string',
            'status' => 'required|string'
        ]);

        // Menyimpan data
        $timeOff = TimeOffModel::create($request->all());

        return response()->json([
            'message' => 'Berhasil Menyimpan Data', 
            'data' => $timeOff
        ]);
    }

    public function show($id)
    {
        $data = TimeOffModel::find($id);
        
        if ($data) {
            return response()->json(['data' => $data]); // Bungkus dalam key 'data'
        }
        
        return response()->json(['message' => 'Data not found'], 404);
    }

    public function edit(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'employee_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
            'letter' => 'nullable|string',
            'status' => 'required|string'
        ]);

        // Memperbarui data
        $timeOff = TimeOffModel::find($id);
        
        if ($timeOff) {
            $timeOff->update($request->all());
            return response()->json([
                'message' => 'Data updated successfully', 
                'data' => $timeOff
            ]);
        }

        return response()->json(['message' => 'Data not found'], 404);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'employee_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
            'letter' => 'nullable|string',
            'status' => 'required|string'
        ]);

        // Memperbarui data
        $timeOff = TimeOffModel::find($id);
        
        if ($timeOff) {
            $timeOff->update($request->all());
            return response()->json([
                'message' => 'Data updated successfully', 
                'data' => $timeOff
            ]);
        }

        return response()->json(['message' => 'Data not found'], 404);
    }

    public function destroy($id)
    {
        $timeOff = TimeOffModel::find($id);
        
        if ($timeOff) {
            $timeOff->delete();
            return response()->json(['message' => 'Data deleted successfully']);
        }
        
        return response()->json(['message' => 'Data not found'], 404);
    }
}
