<?php

namespace App\Http\Controllers;

use App\Models\DonorDarahEvent;
use App\Models\Location;
use Illuminate\Http\Request;

class DonorDarahEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donor_darah_events = DonorDarahEvent::with([
            'location',
        ])->get();

        $data = [
            'donor_darah_events' => $donor_darah_events,
        ];

        return view('donor_darah_events', $data);
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

        return view('donor_darah_events_create', $data);
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

        $donor_darah_event                 = new DonorDarahEvent();
        $donor_darah_event->location_id    = $request->location_id;
        $donor_darah_event->event_datetime = $request->event_date . ' ' . $request->event_time;
        $donor_darah_event->pic_whatsapp   = $request->pic_whatsapp;
        $donor_darah_event->is_published   = $request->is_published;

        if ($donor_darah_event->is_published) {
            DonorDarahEvent::where('is_published', true)->update(['is_published' => false]);
        }

        $donor_darah_event->registrant_limit = $request->registrant_limit;
        $donor_darah_event->save();

        return redirect()->route('donor-darah-events')->with('success', 'Donor Darah Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DonorDarahEvent $donorDarahEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonorDarahEvent $donorDarahEvent)
    {
        $locations = Location::get();

        $data = [
            'locations'      => $locations,
            'donor_darah_event' => $donorDarahEvent,
        ];

        return view('donor_darah_events_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonorDarahEvent $donorDarahEvent)
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

        $donorDarahEvent->update($request->all());

        return redirect()->route('donor-darah-events')->with('success', 'Donor Darah Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonorDarahEvent $donorDarahEvent)
    {
        $donorDarahEvent->delete();

        return redirect()->route('donor-darah-events')->with('success', 'Donor Darah Event deleted successfully.');
    }
}
