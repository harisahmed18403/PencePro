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
        $limit = $request->get('limit', 50);

        $filters = [
            'All Time',
            'This Year',
            'This Month',
            'This Week',
        ];
        $filter = $request->get('filter', 'This Month');

        $graphTypes = [
            'Daily Profits',
            'Daily Cumulative'
        ];
        $graphType = $request->get('graphType', 'Daily Profits');

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

        $userID = auth()->id();
        $mostProfitableQuery = Lick::where('user_id', $userID)->orderBy('profit', 'desc')->limit($limit);
        $biggestLossQuery = Lick::where('user_id', $userID)->orderBy('profit', 'asc')->limit($limit);
        $dailyProfitsQuery = Lick::where('user_id', $userID);

        if (!is_null($range)) {
            $mostProfitableQuery->whereBetween('date', $range);
            $biggestLossQuery->whereBetween('date', $range);
            $dailyProfitsQuery->whereBetween('date', $range);
        }

        $mostProfitable = $mostProfitableQuery->get();
        $biggestLoss = $biggestLossQuery->get();

        $dailyProfitsRaw = $dailyProfitsQuery
            ->select(
                DB::raw('DATE(date) as day'),
                DB::raw('SUM(profit) as total_profit')
            )
            ->groupBy('day')
            ->orderBy('day')
            ->get();


        $start = optional($dailyProfitsRaw->first())->day;
        $end = optional($dailyProfitsRaw->last())->day;

        $period = Carbon::parse($start)->daysUntil(Carbon::parse($end));

        $profitsByDay = $dailyProfitsRaw->pluck('total_profit', 'day');

        $dailyProfits = [
            'labels' => [],
            'series' => [],
        ];

        $cumulative = 0;
        foreach ($period as $date) {
            $day = $date->toDateString();

            if ($graphType == 'Daily Profits') {
                $val = $profitsByDay[$day] ?? 0;
            } elseif ($graphType == 'Daily Cumulative') {
                $cumulative += $profitsByDay[$day] ?? 0;
                $val = $cumulative;
            }
            $dailyProfits['labels'][] = $day;
            $dailyProfits['series'][] = $val;
        }

        return view('licks.stats', compact(
            'limit',
            'filters',
            'filter',
            'graphTypes',
            'graphType',
            'mostProfitable',
            'biggestLoss',
            'dailyProfits'
        ));
    }
}
