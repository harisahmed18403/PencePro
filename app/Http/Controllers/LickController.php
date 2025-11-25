<?php

namespace App\Http\Controllers;

use App\LickImageTrait;
use App\Models\Lick;
use App\Models\Spit;
use App\Models\LickImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LickController extends Controller
{
    use LickImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Only update session if input is present
        if ($request->has('search')) {
            session(['licks_index_search' => $request->input('search')]);
        }

        if ($request->has('filter')) {
            session(['licks_index_filter' => $request->input('filter')]);
        }

        if ($request->has('page')) {
            session(['licks_index_page' => $request->get('page')]);
        }

        // Retrieve from session if not in request
        $search = $request->input('search', session('licks_index_search'));
        $filter = $request->input('filter', session('licks_index_filter'));
        $page = $request->get('page', session('licks_index_page', 1));

        //Total revenue before filtering
        $lickRevenue = Lick::where('user_id', auth()->id())->sum('cost') * -1;
        $spitRevenue = Spit::where('user_id', auth()->id())->sum('revenue');
        $totalRevenue = Lick::where('user_id', auth()->id())->sum('profit');


        $licksQuery = Lick::withCount('spit', 'images')
            ->where('user_id', auth()->id())
            ->orderBy('date', 'desc');


        if ($search) {
            $licksQuery->where('name', 'LIKE', "%{$search}%");
        }

        if ($filter === 'noSpits') {
            $licksQuery->has('spit', '=', 0);
        } elseif ($filter === 'hasSpits') {
            $licksQuery->has('spit', '>', 0);
        } elseif (in_array($filter, ['profit', 'loss'])) {
            if ($filter === 'profit') {
                $licksQuery->where('profit', '>=', "0");
            } else {
                $licksQuery->has('spit', '>', 0)
                    ->where('profit', '<', "0");
            }
        }

        $licks = $licksQuery->paginate(20)->onEachSide(1);

        return view("licks.index", compact(
            "licks",
            "page",
            "search",
            "filter",
            "lickRevenue",
            "spitRevenue",
            "totalRevenue",
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("licks.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'date' => 'required|date',
            // Optional Spit field
            'spit_revenue' => 'nullable|numeric|min:0',
            'spit_date' => 'nullable|date',
        ]);

        $lick = Lick::create([
            'name' => $validated['name'],
            'cost' => $validated['cost'],
            'profit' => $validated['cost'] * -1,
            'date' => $validated['date'],
            'user_id' => auth()->id()
        ]);

        if ($request->filled('spit_revenue')) {
            $profit = $validated['spit_revenue'] - $validated['cost'];
            $lick->update(['profit' => $profit]);
            $lick->spit()->create([
                'revenue' => $validated['spit_revenue'],
                'date' => $validated['spit_date']
            ]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $this->storeLickImage($image, $lick->id);
            }
        }

        return redirect()->route('licks.index')->with('success', 'Devious lick!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lick $lick)
    {
        return view('licks.show', compact('lick'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lick $lick)
    {
        return view('licks.edit', compact('lick'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $lick = Lick::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'date' => 'required|date',
            // Optional Spit field
            'spit_revenue' => 'nullable|numeric|min:0',
            'spit_date' => 'nullable|date',
        ]);

        $profit = $validated['cost'] * -1;

        if ($request->filled('spit_revenue') && $request->filled('spit_date')) {
            $lick->spit->update([
                'revenue' => $validated['spit_revenue'],
                'date' => $validated['spit_date']
            ]);

            $profit += $validated['spit_revenue'];
        }

        $lick->update([
            'name' => $validated['name'],
            'cost' => $validated['cost'],
            'profit' => $profit,
            'date' => $validated['date']
        ]);

        if ($request->filled('deleteImages')) {
            $deleteImages = $request->get('deleteImages', []);
            foreach ($deleteImages as $i => $imageID) {
                $lickImage = LickImage::find($imageID);
                if ($lickImage) {
                    $this->deleteLickImage($lickImage);
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $this->storeLickImage($image, $lick->id);
            }
        }

        return view('licks.show', compact('lick'))->with('success', 'Lick updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lick $lick)
    {
        foreach ($lick->images as $lickImage) {
            $this->deleteLickImage($lickImage);
        }

        $lick->delete();
        return redirect()->route('licks.index')->with('success', 'Lick deleted');
    }

    public function stats(Request $request)
    {
        $filters = [
            'All Time',
            'This Year',
            'This Month',
            'This Week',
        ];

        $graphTypes = [
            'Daily Profits',
            'Daily Cumulative'
        ];

        $limit = $request->get('limit', 50);
        $filter = $request->get('filter', 'This Month');
        $graphType = $request->get('graphType', 'Daily Profits');


        $mostProfitableQuery = Lick::orderBy('profit', 'desc')->limit($limit);
        $biggestLossQuery = Lick::orderBy('profit', 'asc')->limit($limit);

        $dailyProfitsQuery = Lick::query();

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
            $dailyProfits['series'][] = $val; // fill missing days with 0
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
