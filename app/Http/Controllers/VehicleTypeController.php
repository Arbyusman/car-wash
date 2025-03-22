<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $title = 'Vehicle Types';

    private $description = 'Detail Tipe Kendaraan';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $vehicleTypes = VehicleType::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.vehicle-types.index', compact('title', 'vehicleTypes', 'description'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:255',
        ]);

        VehicleType::create($request->all());

        Alert::toast('Vehicle Type created successfully', 'success');

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle Type created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:255',
        ]);

        $vehicleType->update($request->all());

        Alert::toast('Vehicle Type updated successfully', 'success');

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();

        Alert::toast('Vehicle Type deleted successfully', 'success');

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle Type deleted successfully');
    }
}
