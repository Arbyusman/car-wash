<?php

namespace App\Http\Controllers;

use App\Models\WashingPoint;

class LandingPageController extends Controller
{
    public function index()
    {
        $washingPoints = WashingPoint::orderBy('created_at', 'desc')->get(['address', 'phone']);

        return view('landing-page.index', compact('washingPoints'));
    }
}
