<?php

namespace App\Http\Controllers;

use App\Models\TimeOffModel;
use Illuminate\Http\Request;

class APITimeOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil parameter limit dari request, default ke 5 jika tidak disediakan
        $limit = $request->input('limit', 5);
        
        // Ambil parameter sort_by dan sort_order dari request
        $sortBy = $request->input('sort_by', 'time_off_id'); // Kolom yang digunakan untuk sorting, default 'created_at'
        $sortOrder = $request->input('sort_order', 'asc'); // Urutan sorting, default 'desc'
        
        // Ambil data dengan pagination dan sorting
        $data = TimeOffModel::orderBy($sortBy, $sortOrder)->paginate($limit);
        
        // Return hasil pagination
        return response()->json($data);
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = TimeOffModel::find($id);
        
        if ($data) {
            return response()->json(['data' => $data]); // Bungkus dalam key 'data'
        }
        
        return response()->json(['message' => 'Data not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
