<?php

namespace App\Http\Controllers;

use App\Models\WashingPoint;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WashingPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $title = 'Washing Points';

    private $description = 'Detail Titik Lokasi Pencucian';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $washingPoints = WashingPoint::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.washing-point.index', compact('title', 'washingPoints', 'description'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);

        WashingPoint::create($request->all());

        Alert::toast('Washing point created successfully', 'success');

        return redirect()->route('washing-points.index')->with('success', 'Washing point created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WashingPoint $washingPoint)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);

        $washingPoint->update($request->all());

        Alert::toast('Washing point updated successfully', 'success');

        return redirect()->route('washing-points.index')->with('success', 'Washing point updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WashingPoint $washingPoint)
    {
        $washingPoint->delete();

        Alert::toast('Washing point deleted successfully', 'success');

        return redirect()->route('washing-points.index')->with('success', 'Washing point deleted successfully');
    }
}
