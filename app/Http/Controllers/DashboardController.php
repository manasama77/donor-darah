<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $registrants = Registrant::all();

        $data = [
            'registrants' => $registrants,
        ];

        return view('dashboard', $data);
    }
}
