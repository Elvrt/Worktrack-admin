<?php

// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventModel;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Get all events
    public function index()
    {
        return EventModel::all();
    }

    // Get event by ID
    public function show($id)
    {
        $event = EventModel::find($id);
        if ($event) {
            return response()->json($event);
        }
        return response()->json(['message' => 'Event not found'], 404);
    }

    // Create a new event
    public function store(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date',
            'event_time' => 'required',
            'information' => 'required|string|max:200',
        ]);

        $event = EventModel::create($request->all());
        return response()->json($event, 201);
    }

    // Update an event by ID
    public function update(Request $request, $id)
    {
        $event = EventModel::find($id);
        if ($event) {
            $request->validate([
                'event_date' => 'sometimes|date',
                'event_time' => 'sometimes',
                'information' => 'sometimes|string|max:200',
            ]);

            $event->update($request->all());
            return response()->json($event);
        }
        return response()->json(['message' => 'Event not found'], 404);
    }

    // Delete an event by ID
    public function destroy($id)
    {
        $event = EventModel::find($id);
        if ($event) {
            $event->delete();
            return response()->json(['message' => 'Event deleted']);
        }
        return response()->json(['message' => 'Event not found'], 404);
    }
}
