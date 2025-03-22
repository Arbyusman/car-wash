<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use App\Models\Vehicle;
use App\Models\WashingPoint;

class LandingPageController extends Controller
{
    public function index()
    {
        $washingPoints = WashingPoint::orderBy('created_at', 'desc')->get(['address', 'phone']);
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get(['name', 'cost']);
        $testimonis = Testimoni::orderBy('created_at', 'desc')->get(['name', 'email', 'description']);

        return view('landing-page.index', compact('washingPoints', 'vehicles', 'testimonis'));
    }
}
