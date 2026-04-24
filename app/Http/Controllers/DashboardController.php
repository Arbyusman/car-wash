<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use App\Models\Washer;
use App\Models\WashTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        $roleId = (int) Auth::user()->role_id;
        $isAdministrator = $roleId === 1;
        $isCashier = $roleId === 2;
        $canSeeOperationalCards = in_array($roleId, [1, 2], true);

        $currentMonthRevenue = WashTransaction::query()
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('total_cost');

        $totalTransactions = WashTransaction::query()->count();

        $totalTransactionsToday = WashTransaction::query()
            ->whereDate('created_at', now()->toDateString())
            ->count();

        $totalWashers = Washer::query()->count();

        $washedVehicleByType = VehicleType::query()
            ->select([
                'vehicle_types.id',
                'vehicle_types.name',
                'vehicle_types.size',
                DB::raw('COUNT(wash_transactions.id) as total_washed'),
            ])
            ->leftJoin('vehicles', function ($join) {
                $join->on('vehicles.vehicle_type_id', '=', 'vehicle_types.id')
                    ->whereNull('vehicles.deleted_at');
            })
            ->leftJoin('wash_transaction_details', function ($join) {
                $join->on('wash_transaction_details.vehicle_id', '=', 'vehicles.id')
                    ->whereNull('wash_transaction_details.deleted_at');
            })
            ->leftJoin('wash_transactions', function ($join) {
                $join->on('wash_transactions.id', '=', 'wash_transaction_details.wash_transaction_id')
                    ->whereNull('wash_transactions.deleted_at');
            })
            ->groupBy('vehicle_types.id', 'vehicle_types.name', 'vehicle_types.size')
            ->orderBy('vehicle_types.id')
            ->get();

        return view('pages.dashboards.index', compact(
            'isAdministrator',
            'isCashier',
            'canSeeOperationalCards',
            'currentMonthRevenue',
            'totalTransactions',
            'totalTransactionsToday',
            'totalWashers',
            'washedVehicleByType'
        ));
    }
}
