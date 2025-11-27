<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Lick;

class LickStatsController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);

        $periods = [
            'Daily',
            'Weekly',
            'Monthly',
        ];

        $graphTypes = [
            'Profit',
            'Cumulative Profit'
        ];

        $filters = [
            'All Time',
            'This Year',
            'This Month',
            'This Week',
        ];
        $filter = $request->get('filter', 'This Month');

        $range = $this->getRange($filter);

        $userID = auth()->id();
        $mostProfitableQuery = Lick::where('user_id', $userID)->orderBy('profit', 'desc')->limit($limit);
        $biggestLossQuery = Lick::where('user_id', $userID)->orderBy('profit', 'asc')->limit($limit);

        if (!is_null($range)) {
            $mostProfitableQuery->whereBetween('date', $range);
            $biggestLossQuery->whereBetween('date', $range);
        }

        $mostProfitable = $mostProfitableQuery->get();
        $biggestLoss = $biggestLossQuery->get();

        return view('licks.stats', compact(
            'limit',
            'filter',
            'mostProfitable',
            'biggestLoss',
            'filters',
            'graphTypes',
            'periods'
        ));
    }

    public function graph(Request $request)
    {
        $filter = $request->get('filter', 'This Month');
        $period = $request->get('period', 'Daily');
        $graphType = $request->get('graphType', 'Profit');

        $range = $this->getRange($filter);

        $dailyProfitsRaw = Lick::where('user_id', auth()->id())
            ->when($range, fn($q) => $q->whereBetween('date', $range))
            ->selectRaw(
                match ($period) {
                    'Weekly' => "strftime('%Y', date) || '-' || strftime('%W', date) as period, MIN(date) as sort_date, SUM(profit) as total_profit",
                    'Monthly' => "strftime('%Y-%m', date) as period, MIN(date) as sort_date, SUM(profit) as total_profit",
                    default => "DATE(date) as period, DATE(date) as sort_date, SUM(profit) as total_profit"
                }
            )
            ->groupBy('period')
            ->orderBy('sort_date')
            ->get();

        $start = $dailyProfitsRaw->first()?->sort_date;
        $end = $dailyProfitsRaw->last()?->sort_date;

        switch ($period) {
            case 'Weekly':
                $periodNoGaps = Carbon::parse($start)->weeksUntil(Carbon::parse($end));
                break;
            case 'Monthly':
                $periodNoGaps = Carbon::parse($start)->monthsUntil(Carbon::parse($end));
                break;
            default:
                $periodNoGaps = Carbon::parse($start)->daysUntil(Carbon::parse($end));
                break;
        }

        $profitByPeriod = $dailyProfitsRaw->pluck('total_profit', 'period');

        $graphData = [
            'labels' => [],
            'series' => [],
        ];

        $cumulative = 0;

        foreach ($periodNoGaps as $date) {
            $key = match ($period) {
                'Weekly' => $date->format('o') . '-' . $date->format('W'),
                'Monthly' => $date->format('Y-m'),
                default => $date->toDateString()
            };

            $val = $profitByPeriod[$key] ?? 0;

            if ($graphType === 'Cumulative Profit') {
                $cumulative += $val;
                $val = $cumulative;
            }

            $graphData['labels'][] = $key;
            $graphData['series'][] = $val;
        }

        return response()->json([
            'success' => true,
            'graphData' => $graphData
        ]);
    }

    private function getRange(string $filter)
    {
        $range = null;
        switch ($filter) {
            case 'All Time':
                break;

            case 'This Year':
                $range = [
                    now()->startOfYear(),
                    now()->endOfYear()
                ];
                break;

            case 'This Month':
                $range = [
                    now()->startOfMonth(),
                    now()->endOfMonth()
                ];
                break;

            case 'This Week':
                $range = [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ];
                break;
        }

        return $range;
    }
}
