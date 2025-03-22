<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Traits\CurrencyTrait;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VehicleController extends Controller
{
    use CurrencyTrait;

    /**
     * Display a listing of the resource.
     */
    private $title = 'Vehicles';

    private $description = 'Detail Kendaraan';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $vehicleTypes = VehicleType::get(['id', 'name', 'size']);
        $vehicles = Vehicle::with('vehicleType')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.vehicles.index', compact('title', 'vehicles', 'vehicleTypes', 'description'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required|numeric|exists:vehicle_types,id',
            'cost' => 'required|string|max:255',
            'washer_cost' => 'required|string|max:255',
        ]);
        $request->merge(['cost' => $this->convertToInteger($request->cost)]);
        $request->merge(['washer_cost' => $this->convertToInteger($request->washer_cost)]);

        Vehicle::create($request->all());

        Alert::toast('Vehicle created successfully', 'success');

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required|numeric|exists:vehicle_types,id',
            'cost' => 'required|string|max:255',
            'washer_cost' => 'required|string|max:255',
        ]);
        $request->merge(['cost' => $this->convertToInteger($request->cost)]);
        $request->merge(['washer_cost' => $this->convertToInteger($request->washer_cost)]);

        $vehicle->update($request->all());

        Alert::toast('Vehicle updated successfully', 'success');

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        Alert::toast('Vehicle deleted successfully', 'success');

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully');
    }
}
