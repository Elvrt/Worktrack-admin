<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsenceModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Validator;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all absence records with associated employee data
        $absences = AbsenceModel::with('employee')->get();
        return response()->json($absences);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return view for creating a new absence record
        return view('absence.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,employee_id',
            'absence_date' => 'required|date',
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i|after:clock_in',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:present,absent,leave',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create and save the new absence record
        $absence = AbsenceModel::create($request->all());
        return response()->json($absence, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the absence record by ID and return it
        $absence = AbsenceModel::with('employee')->find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        return response()->json($absence);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the absence record by ID and return the edit view
        $absence = AbsenceModel::find($id);

        if (!$absence) {
            return redirect()->back()->withErrors(['message' => 'Absence not found']);
        }

        return view('absence.edit', compact('absence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the absence record by ID
        $absence = AbsenceModel::find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,employee_id',
            'absence_date' => 'required|date',
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i|after:clock_in',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:present,absent,leave',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update the absence record with validated data
        $absence->update($request->all());
        return response()->json($absence);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the absence record by ID and delete it
        $absence = AbsenceModel::find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        $absence->delete();
        return response()->json(['message' => 'Absence deleted successfully']);
    }
}
