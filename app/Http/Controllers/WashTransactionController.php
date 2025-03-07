<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Washer;
use App\Models\WashTransaction;
use App\Models\WashTransactionDetail;
use App\Traits\CurrencyTrait;
use Illuminate\Http\Request;

class WashTransactionController extends Controller
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
        $vehicles = Vehicle::get(['id', 'name', 'cost', 'washer_cost']);
        $washers = Washer::get(['id', 'name']);
        $washTransactions = WashTransaction::with(['washTransactionDetail', 'washer', 'washTransactionDetail.vehicle'])->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.wash-transactions.index', compact('title', 'vehicles', 'washers', 'washTransactions', 'description'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'washer_id' => 'required|numeric|exists:washers,id',
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'plate_number' => 'required|string|max:255',
            'additional_cost' => 'required|string|max:255',
        ]);
        $additionalCost = $this->convertToInteger($request->additional_cost);

        if ($additionalCost < 0) {
            return back()->withErrors(['additional_cost' => 'Biaya tambahan tidak boleh negatif.']);
        }

        $vehicleCost = $this->convertToInteger(Vehicle::find($request->vehicle_id)->cost);
        $totalCost = $vehicleCost + $additionalCost;

        $washTransaction = WashTransaction::create([
            'washer_id' => $request->washer_id,
            'total_cost' => $totalCost,
            'transaction_number' => $this->generateTransactionNumber(),
        ]);

        WashTransactionDetail::create([
            'wash_transaction_id' => $washTransaction->id,
            'vehicle_id' => $request->vehicle_id,
            'plate_number' => $request->plate_number,
            'additional_cost' => $additionalCost,
        ]);

        return redirect()->route('wash-transactions.index')->with('success', 'Wash Transaction created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WashTransaction $washTransaction)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required|numeric|exists:vehicle_types,id',
            'cost' => 'required|string|max:255',
            'washer_cost' => 'required|string|max:255',
        ]);
        $request->merge(['cost' => $this->convertToInteger($request->cost)]);
        $request->merge(['washer_cost' => $this->convertToInteger($request->washer_cost)]);

        $washTransaction->update($request->all());

        return redirect()->route('wash-transactions.index')->with('success', 'Wash Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WashTransaction $washTransaction)
    {
        $washTransaction->delete();

        return redirect()->route('wash-transactions.index')->with('success', 'Wash Transaction deleted successfully');
    }
}
