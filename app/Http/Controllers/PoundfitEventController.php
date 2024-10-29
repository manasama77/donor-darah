<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PoundfitEvent;
use Illuminate\Http\Request;

class PoundfitEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poundfit_events = PoundfitEvent::with([
            'location',
        ])->get();

        $data = [
            'poundfit_events' => $poundfit_events,
        ];

        return view('poundfit_events', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::get();

        $data = [
            'locations' => $locations,
        ];

        return view('poundfit_events_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_id'      => ['required', 'integer', 'exists:locations,id'],
            'event_date'       => ['required', 'date', 'date_format:Y-m-d'],
            'event_time'       => ['required', 'date_format:H:i'],
            'pic_whatsapp'     => ['required', 'string'],
            'is_published'     => ['required', 'boolean'],
            'registrant_limit' => ['required', 'integer'],
        ], [
            'location_id.required'      => 'Location is required.',
            'event_date.required'       => 'Event date is required.',
            'event_date.date'           => 'Event date is invalid.',
            'event_date.date_format'    => 'Event date is invalid.',
            'event_time.required'       => 'Event time is required.',
            'event_time.date_format'    => 'Event time is invalid.',
            'pic_whatsapp.required'     => 'PIC WhatsApp is required.',
            'pic_whatsapp.string'       => 'PIC WhatsApp is invalid.',
            'is_published.required'     => 'Event status is required.',
            'is_published.boolean'      => 'Event status is invalid.',
            'registrant_limit.required' => 'Registrant limit is required.',
            'registrant_limit.integer'  => 'Registrant limit is invalid.',
        ]);

        $poundfit_event                 = new PoundfitEvent();
        $poundfit_event->location_id    = $request->location_id;
        $poundfit_event->event_datetime = $request->event_date . ' ' . $request->event_time;
        $poundfit_event->pic_whatsapp   = $request->pic_whatsapp;
        $poundfit_event->is_published   = $request->is_published;

        if ($poundfit_event->is_published) {
            PoundfitEvent::where('is_published', true)->update(['is_published' => false]);
        }

        $poundfit_event->registrant_limit = $request->registrant_limit;
        $poundfit_event->save();

        return redirect()->route('poundfit-events')->with('success', 'Poundfit Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PoundfitEvent $poundfitEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PoundfitEvent $poundfitEvent)
    {
        $locations = Location::get();

        $data = [
            'locations'      => $locations,
            'poundfit_event' => $poundfitEvent,
        ];

        return view('poundfit_events_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PoundfitEvent $poundfitEvent)
    {
        $request->validate([
            'location_id'      => ['required', 'integer', 'exists:locations,id'],
            'event_date'       => ['required', 'date', 'date_format:Y-m-d'],
            'event_time'       => ['required', 'date_format:H:i'],
            'pic_whatsapp'     => ['required', 'string'],
            'is_published'     => ['required', 'boolean'],
            'registrant_limit' => ['required', 'integer'],
        ], [
            'location_id.required'      => 'Location is required.',
            'event_date.required'       => 'Event date is required.',
            'event_date.date'           => 'Event date is invalid.',
            'event_date.date_format'    => 'Event date is invalid.',
            'event_time.required'       => 'Event time is required.',
            'event_time.date_format'    => 'Event time is invalid.',
            'pic_whatsapp.required'     => 'PIC WhatsApp is required.',
            'pic_whatsapp.string'       => 'PIC WhatsApp is invalid.',
            'is_published.required'     => 'Event status is required.',
            'is_published.boolean'      => 'Event status is invalid.',
            'registrant_limit.required' => 'Registrant limit is required.',
            'registrant_limit.integer'  => 'Registrant limit is invalid.',
        ]);

        $poundfitEvent->update($request->all());

        return redirect()->route('poundfit-events')->with('success', 'Poundfit Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoundfitEvent $poundfitEvent)
    {
        $poundfitEvent->delete();

        return redirect()->route('poundfit-events')->with('success', 'Poundfit Event deleted successfully.');
    }
}
