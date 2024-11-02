<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeOffData;

class TimeOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TimeOffData::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // Ensure employee_id exists in employees table
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'letter' => 'nullable|string', // Letter is optional
        ]);

        // Store new data
        $save = new TimeOffData;
        $save->employee_id = $request->employee_id;
        $save->start_date = $request->start_date;
        $save->end_date = $request->end_date;
        $save->reason = $request->reason;
        $save->letter = $request->letter;
        $save->created_at = now();
        $save->save();

        return response()->json(['message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = TimeOffData::find($id);
        if ($data) {
            return response()->json($data);
        }

        return response()->json(['message' => 'Data not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation rules
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'letter' => 'nullable|string',
        ]);

        $data = TimeOffData::find($id);
        if ($data) {
            $data->employee_id = $request->employee_id;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->reason = $request->reason;
            $data->letter = $request->letter;
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
        $data = TimeOffData::find($id);
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully']);
        }

        return response()->json(['message' => 'Data not found'], 404);
    }
}
