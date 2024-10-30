<?php

// app/Http/Controllers/AssignmentController.php

namespace App\Http\Controllers;

use App\Models\AssigmentModel;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    // Get all assignments
    public function index()
    {
        return AssigmentModel::all();
    }

    // Get assignment by ID
    public function show($id)
    {
        $assignment = AssigmentModel::find($id);
        if ($assignment) {
            return response()->json($assignment);
        }
        return response()->json(['message' => 'Assignment not found'], 404);
    }

    // Create a new assignment
    public function store(Request $request)
    {
        $assignment = AssigmentModel::create($request->all());
        return response()->json($assignment, 201);
    }

    // Update an assignment by ID
    public function update(Request $request, $id)
    {
        $assignment = AssigmentModel::find($id);
        if ($assignment) {
            $assignment->update($request->all());
            return response()->json($assignment);
        }
        return response()->json(['message' => 'Assignment not found'], 404);
    }

    // Delete an assignment by ID
    public function destroy($id)
    {
        $assignment = AssigmentModel::find($id);
        if ($assignment) {
            $assignment->delete();
            return response()->json(['message' => 'Assignment deleted']);
        }
        return response()->json(['message' => 'Assignment not found'], 404);
    }
}
