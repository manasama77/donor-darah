<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::get();

        $data = [
            'locations' => $locations,
        ];

        return view('locations', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'address'        => 'required',
            'gmap_embed_url' => 'required',
        ], [
            'name.required'           => 'Name is required.',
            'address.required'        => 'Address is required.',
            'gmap_embed_url.required' => 'Google Map Embed URL is required.',
        ]);

        $location                 = new Location();
        $location->name           = $request->name;
        $location->address        = $request->address;
        $location->gmap_embed_url = $this->cleanGoogleMapEmbedUrl($request->gmap_embed_url);
        $location->save();

        return redirect()->route('locations')->with('success', 'Location created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        $data = [
            'location' => $location,
        ];

        return view('locations_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name'           => 'required',
            'address'        => 'required',
            'gmap_embed_url' => 'required',
        ],  [
            'name.required'           => 'Name is required.',
            'address.required'        => 'Address is required.',
            'gmap_embed_url.required' => 'Google Map Embed URL is required.',
        ]);

        $location->name           = $request->name;
        $location->address        = $request->address;
        $location->gmap_embed_url = $this->cleanGoogleMapEmbedUrl($request->gmap_embed_url);
        $location->save();

        return redirect()->route('locations')->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        if ($location->registrants) {
            $location->registrants()->delete();
        }

        if ($location->donor_darah_events) {
            $location->donor_darah_events()->delete();
        }

        $location->delete();

        return redirect()->route('locations')->with('success', 'Location deleted successfully.');
    }

    protected function cleanGoogleMapEmbedUrl($url)
    {
        return str_replace('width="600" height="450"', 'width="100%" height="400"', $url);
    }
}
