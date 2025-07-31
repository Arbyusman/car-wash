<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class WashTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function washer(): BelongsTo
    {
        return $this->belongsTo(Washer::class);
    }

    public function washTransactionDetail(): HasOne
    {
        return $this->hasOne(WashTransactionDetail::class);
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function getNetProfitByFilter($type, $value = null)
    {
        switch ($type) {
            case 'year':
                return self::getYearlyNetProfit($value);
            case 'month':
                return self::getMonthlyNetProfit($value);
            case 'last_7_days':
                return self::getLast7DaysNetProfit();
            default:
                return [];
        }
    }

    private static function getYearlyNetProfit($year = null)
    {
        $year = $year ?? now()->year;
        $dateRange = self::getYearDateRange($year);
        $emptyPeriods = self::generateMonthlyPeriods($year);

        $data = self::getAggregatedData(
            $dateRange['start'],
            $dateRange['end'],
            "DATE_FORMAT(created_at, '%m-%b')",
            "DATE_FORMAT(created_at, '%m-%b')"
        );

        $mergedResult = array_merge($emptyPeriods, $data);
        ksort($mergedResult);

        return self::formatYearlyResult($mergedResult);
    }

    private static function getMonthlyNetProfit($month = null)
    {
        $monthDate = Carbon::parse($month ?? now());
        $dateRange = self::getMonthDateRange($monthDate);
        $emptyPeriods = self::generateDailyPeriods($dateRange['start'], $dateRange['end']);

        $data = self::getAggregatedData(
            $dateRange['start'],
            $dateRange['end'],
            "DATE(created_at)",
            "DATE(created_at)"
        );

        $result = array_merge($emptyPeriods, $data);
        ksort($result);

        return $result;
    }

    private static function getLast7DaysNetProfit()
    {
        $dateRange = self::getLast7DaysDateRange();
        $emptyPeriods = self::generateDailyPeriods($dateRange['start'], $dateRange['end']);

        $data = self::getAggregatedData(
            $dateRange['start'],
            $dateRange['end'],
            "DATE(created_at)",
            "DATE(created_at)"
        );

        $result = array_replace($emptyPeriods, $data);
        ksort($result);

        return $result;
    }

    private static function getYearDateRange($year)
    {
        return [
            'start' => Carbon::createFromDate($year, 1, 1)->startOfDay(),
            'end' => now()->endOfDay()
        ];
    }

    private static function getMonthDateRange($monthDate)
    {
        return [
            'start' => $monthDate->startOfMonth(),
            'end' => now()->endOfDay()
        ];
    }

    private static function getLast7DaysDateRange()
    {
        return [
            'start' => now()->subDays(6)->startOfDay(),
            'end' => now()->endOfDay()
        ];
    }

    private static function generateMonthlyPeriods($year)
    {
        $periods = [];
        for ($m = 1; $m <= now()->month; $m++) {
            $key = str_pad($m, 2, '0', STR_PAD_LEFT) . '-' . Carbon::createFromDate($year, $m, 1)->format('M');
            $periods[$key] = 0;
        }
        return $periods;
    }

    private static function generateDailyPeriods($start, $end)
    {
        $periods = [];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $periods[$date->format('Y-m-d')] = 0;
        }
        return $periods;
    }

    private static function getAggregatedData($start, $end, $selectFormat, $groupFormat)
    {
        return self::query()
            ->select(
                DB::raw("{$selectFormat} as label"),
                DB::raw("ROUND(SUM(total_cost), 2) as total")
            )
            ->whereBetween('created_at', [$start, $end])
            ->groupBy(DB::raw($groupFormat))
            ->pluck('total', 'label')
            ->toArray();
    }

    private static function formatYearlyResult($result)
    {
        $formatted = [];
        foreach ($result as $key => $value) {
            [, $month] = explode('-', $key);
            $formatted[$month] = $value;
        }
        return $formatted;
    }
}
