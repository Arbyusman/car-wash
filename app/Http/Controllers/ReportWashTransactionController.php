<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Washer;
use App\Models\WashTransaction;
use App\Traits\CurrencyTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportWashTransactionController extends Controller
{
    use CurrencyTrait;

    /**
     * Display a listing of the resource.
     */
    private $title = 'Reports';

    private $description = 'Detail Report Transaksi';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $vehicles = Vehicle::get(['id', 'name', 'cost', 'washer_cost']);
        $washers = Washer::get(['id', 'name']);
        $cashiers = User::where('role_id', 2)->get(['id', 'name']);
        $washTransactions = WashTransaction::with(['washTransactionDetail', 'washer', 'washTransactionDetail.vehicle', 'createdBy', 'updatedBy'])->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.wash-transactions.reports.index', compact('title', 'vehicles', 'washers', 'washTransactions', 'cashiers', 'description'));
    }

    public function generateReport(Request $request)
    {
        $title = $this->title;
        $description = $this->description;

        $vehicleId = $request->vehicle_id;
        $washerId = $request->washer_id;
        $cashierId = $request->cashier_id;
        $dateRange = $request->input('date-range');

        if ($dateRange) {
            [$startDate, $endDate] = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', trim($startDate))->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', trim($endDate))->endOfDay();
        }

        $washTransactions = WashTransaction::with(['washTransactionDetail', 'washer', 'washTransactionDetail.vehicle', 'createdBy', 'updatedBy'])
            ->when($vehicleId, function ($query) use ($vehicleId) {
                return $query->whereHas('washTransactionDetail.vehicle', function ($q) use ($vehicleId) {
                    $q->where('id', $vehicleId);
                });
            })
            ->when($washerId, function ($query) use ($washerId) {
                return $query->where('washer_id', $washerId);
            })
            ->when($dateRange, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->when($dateRange, function ($query) use ($cashierId) {
                return $query->where('created_by', $cashierId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.wash-transactions.reports.report', compact('title', 'washTransactions', 'description'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('Report_'.now()->format('d-m-Y').'.pdf');
    }
}
