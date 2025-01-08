<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Exception;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('scan');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Registrant $registrant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registrant $registrant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registrant $registrant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registrant $registrant)
    {
        //
    }

    public function cek(Request $request)
    {
        try {
            $request->validate([
                'barcode' => ['required', 'min:4'],
            ]);

            $check = Registrant::where('barcode', $request->barcode)->first();

            if ($check) {
                $check->update([
                    'are_attending' => true
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Check in berhasil',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Check in gagal, data tidak ditemukan',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
