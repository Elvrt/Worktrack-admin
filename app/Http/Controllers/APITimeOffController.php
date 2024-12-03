<?php

namespace App\Http\Controllers;

use App\Models\TimeOffModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APITimeOffController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $employee = EmployeeModel::where('employee_id', $user->employee_id)->first();

    if (!$employee) {
        return response()->json([
            'status' => 'error',
            'message' => 'Employee data not found',
        ], 404);
    }

    // Ambil limit dan page dari query parameter
    $limit = $request->query('limit', 4); // Default 4 data per halaman
    $page = $request->query('page', 1); // Default page 1

    // Hitung offset berdasarkan halaman
    $offset = ($page - 1) * $limit;

    // Ambil total data
    $totalData = TimeOffModel::where('employee_id', $employee->employee_id)->count();

    // Ambil data dengan limit dan offset
    $data = TimeOffModel::where('employee_id', $employee->employee_id)
                ->with('employee') // Include employee data
                ->skip($offset)
                ->take($limit)
                ->get();

    // Tentukan apakah ini halaman terakhir
    $isLastPage = $page * $limit >= $totalData;

    return response()->json([
        'status' => 'success',
        'message' => 'Time Off data found successfully',
        'data' => $data,
        'current_page' => $page,
        'total_data' => $totalData,
        'is_last_page' => $isLastPage,
    ], 200);
}
    
public function store(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'reason' => 'nullable|string',
        'letter' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Validasi file gambar
        'status' => 'pending', 
    ]);

    // Proses upload file menggunakan CloudinaryController
    $filePath = null;
    if ($request->hasFile('letter')) {
        $image = $request->file('letter');
        $filePath = CloudinaryController::upload($image->getRealPath(), 'worktrack/letters', 800, 800);

        if (!$filePath) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to upload letter file.',
            ], 500);
        }
    }

    $timeOff = TimeOffModel::create([
        'employee_id' => $user->employee_id, // Gunakan ID dari pengguna login
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'reason' => $request->reason,
        'letter' => $filePath,
        'status' => 'pending', 
    ]);

    return response()->json([
        'message' => 'Time Off successfully submitted',
        'data' => $timeOff,
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
