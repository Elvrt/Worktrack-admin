<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Event List',
            'list' => ['Home', 'Event', 'List']
        ];

        $activeMenu = 'event';

        $events = EventModel::all();

        return view('event.index', compact('breadcrumb', 'events', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Event Create',
            'list' => ['Home', 'Event', 'Create']
        ];

        $activeMenu = 'event';

        return view('event.create', compact('breadcrumb', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'event_date' => 'required|date',
                'event_time' => 'required|date_format:H:i',
                'information' => 'required|string|max:200',
            ],
            [
                'event_date.required' => 'The event date field is required.',
                'event_date.date' => 'The event date must be a valid date.',

                'event_time.required' => 'The event time field is required.',
                'event_time.date_format' => 'The event time must be in the format HH:MM.',

                'information.required' => 'The information field is required.',
                'information.string' => 'The information must be a valid string.',
                'information.max' => 'The information must not exceed 200 characters.',
            ]
        );

        EventModel::create([
            'event_date' => $request->event_date,
            'event_time' => $request->event_time ? $request->event_time . ':00' : null,
            'information' => $request->information,
        ]);

        return redirect('event')->with('success', 'Event data successfully saved');
    }

    public function show(string $id)
    {
        $event = EventModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Event Detail',
            'list' => ['Home', 'Event', 'Detail']
        ];

        $activeMenu = 'event';

        return view('event.show', compact('breadcrumb', 'event', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $event = EventModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Event Edit',
            'list' => ['Home', 'Event', 'Edit']
        ];

        $activeMenu = 'event';

        return view('event.edit', compact('breadcrumb', 'event', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'event_date' => 'required|date',
                'event_time' => [
                    'required',
                    'regex:/^([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$|^0?[1-9]|1[0-2]:[0-5][0-9] ?[ap]m$/'
                ],
                'information' => 'required|string|max:200',
            ],
            [
                'event_date.required' => 'The event date field is required.',
                'event_date.date' => 'The event date must be a valid date.',

                'event_time.required' => 'The event time field is required.',
                'event_time.date_format' => 'The event time must be in the format HH:MM.',

                'information.required' => 'The information field is required.',
                'information.string' => 'The information must be a valid string.',
                'information.max' => 'The information must not exceed 200 characters.',
            ]
        );

        EventModel::find($id)->update([
            'event_date' => $request->event_date,
            'event_time' => $request->event_time && !str_ends_with($request->event_time, ':00')
                ? $request->event_time . ':00'
                : $request->event_time,
            'information' => $request->information,
        ]);

        return redirect('event')->with('success', 'Event data successfully changed');
    }

    public function destroy(string $id)
    {
        $check = EventModel::find($id);
        if (!$check) {
            return redirect('event')->with('error', 'Event data not found');
        }

        try {
            EventModel::destroy($id);

            return redirect('event')->with('success', 'Event data successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('event')->with('error', 'Event data failed to be deleted because there are still other tables associated with this data');
        }
    }
}
