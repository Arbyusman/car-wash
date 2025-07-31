<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Washer;
use App\Models\WashTransaction;
use App\Models\WashTransactionDetail;
use App\Traits\CurrencyTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class WashTransactionController extends Controller
{
    use CurrencyTrait;

    /**
     * Display a listing of the resource.
     */
    private $title = 'Transactions';

    private $description = 'Detail Transaksi';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $vehicles = Vehicle::get(['id', 'name', 'cost', 'washer_cost']);
        $washers = Washer::get(['id', 'name']);
        $washTransactions = WashTransaction::with(['washTransactionDetail', 'washer', 'washTransactionDetail.vehicle', 'createdBy', 'updatedBy'])->orderBy('created_at', 'desc')->paginate(10);

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
            'payment_amount' => 'required|string|max:255',
            'change_amount' => 'required|string|max:255',
        ]);
        $additionalCost = $this->convertToInteger($request->additional_cost);
        $paymentAmount = $this->convertToInteger($request->payment_amount);
        $changeAmount = $this->convertToInteger($request->change_amount);

        if ($additionalCost < 0) {
            Alert::toast('Biaya tambahan tidak boleh negatif', 'error');

            return back()->withErrors(['additional_cost' => 'Biaya tambahan tidak boleh negatif.']);
        }

        $vehicleCost = $this->convertToInteger(Vehicle::find($request->vehicle_id)->cost);
        $totalCost = $vehicleCost + $additionalCost;

        $washTransaction = WashTransaction::create([
            'washer_id' => $request->washer_id,
            'total_cost' => $totalCost,
            'payment_amount' => $paymentAmount,
            'change_amount' => $changeAmount,
            'transaction_number' => $this->generateTransactionNumber(),
            'created_by' => Auth::user()->id,
        ]);

        WashTransactionDetail::create([
            'wash_transaction_id' => $washTransaction->id,
            'vehicle_id' => $request->vehicle_id,
            'plate_number' => $request->plate_number,
            'additional_cost' => $additionalCost,
        ]);

        Alert::toast('Transaction created successfully', 'success');

        return redirect()->route('wash-transactions.index')->with('success', 'Wash Transaction created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WashTransaction $washTransaction)
    {

        if ($washTransaction->is_printed) {
            return back()->withErrors('Data transaksi sudah dicetak, tidak bisa diubah.');
        }

        $request->validate([
            'washer_id' => 'required|numeric|exists:washers,id',
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'plate_number' => 'required|string|max:255',
            'additional_cost' => 'required|string|max:255',
            'payment_amount' => 'required|string|max:255',
            'change_amount' => 'required|string|max:255',
        ]);
        $additionalCost = $this->convertToInteger($request->additional_cost);
        $paymentAmount = $this->convertToInteger($request->payment_amount);
        $changeAmount = $this->convertToInteger($request->change_amount);

        if ($additionalCost < 0) {
            Alert::toast('Biaya tambahan tidak boleh negatif', 'error');

            return back()->withErrors(['additional_cost' => 'Biaya tambahan tidak boleh negatif.']);
        }

        $vehicleCost = $this->convertToInteger(Vehicle::find($request->vehicle_id)->cost);
        $totalCost = $vehicleCost + $additionalCost;

        $washTransaction->update([
            'washer_id' => $request->washer_id,
            'total_cost' => $totalCost,
            'payment_amount' => $paymentAmount,
            'change_amount' => $changeAmount,
            'updated_by' => Auth::user()->id,
        ]);

        $washTransaction->washTransactionDetail->update([
            'wash_transaction_id' => $washTransaction->id,
            'vehicle_id' => $request->vehicle_id,
            'plate_number' => $request->plate_number,
            'additional_cost' => $additionalCost,
        ]);

        Alert::toast('Transaction updated successfully', 'success');

        return redirect()->route('wash-transactions.index')->with('success', 'Wash Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WashTransaction $washTransaction)
    {
        if ($washTransaction->is_printed) {
            Alert::toast('Data transaksi sudah dicetak, tidak bisa dihapus.', 'error');

            return back()->withErrors('Data transaksi sudah dicetak, tidak bisa dihapus.');
        }
        $washTransaction->delete();

        return redirect()->route('wash-transactions.index')->with('success', 'Wash Transaction deleted successfully');
    }

    public function generateInvoice($id)
    {
        $washTransaction = WashTransaction::with('washTransactionDetail', 'washer', 'washTransactionDetail.vehicle', 'createdBy', 'updatedBy')
            ->findOrFail(Crypt::decrypt($id));

        $washTransaction->is_printed = true;
        $washTransaction->deleted_by = Auth::user()->id;
        $washTransaction->save();

        $pdf = Pdf::loadView('admin.wash-transactions.invoice', compact('washTransaction'))
            ->setPaper([0, 0, 226, 550]);

        return $pdf->stream('invoice_' . $washTransaction->transaction_number . '.pdf');
    }

    public function charts(Request $request)
    {
        $type = $request->input('type');
        $value = $request->input('value');

        $data = WashTransaction::getNetProfitByFilter($type, $value);
        return response()->json($data);
    }
}
