<?php

namespace App\Http\Controllers;

use App\Models\AbsenceModel;
use Illuminate\Http\Request;

class APIAbsenceController extends Controller
{
    /**
     * Display a listing of the absences.
     */
    public function index()
    {
        // Get all absences
        $absence = AbsenceModel::all();

        return response()->json($absence);
    }

    /**
     * Store a newly created absence record in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'absence_date' => 'required|date',
            'clock_in' => 'nullable|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i',
            'location' => 'required|string',
            'status' => 'required|string',
            'created_at' => 'nullable|date',
        ]);

        // Create the absence record
        $absence = AbsenceModel::create($validatedData);

        // Return the created AbsenceModel record
        return response()->json($absence, 201);
    }

    /**
     * Display the specified absence record.
     */
    public function show(string $id)
    {
        // Find the absence by ID
        $absence = AbsenceModel::find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        return response()->json($absence);
    }

    /**
     * Update the specified absence record in storage.
     */
    public function update(Request $request, string $id)
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

    /**
     * Remove the specified absence record from storage.
     */
    public function destroy(string $id)
    {
        // Find the absence by ID
        $absence = AbsenceModel::find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        // Delete the absence record
        $absence->delete();

        return response()->json(['message' => 'Absence deleted successfully']);
    }
}
