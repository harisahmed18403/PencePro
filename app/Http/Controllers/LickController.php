<?php

namespace App\Http\Controllers;

use App\Models\Lick;
use App\Models\Spit;
use Illuminate\Http\Request;

class LickController extends Controller
{
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
        $lickRevenue = Lick::sum('revenue') * -1;
        $spitRevenue = Spit::sum('revenue');
        $totalRevenue = $spitRevenue + $lickRevenue;

        $licksQuery = Lick::withCount('spit')->orderBy('created_at', 'desc');

        if ($search) {
            $licksQuery->where('name', 'LIKE', "%{$search}%");
        }

        if ($filter === 'noSpits') {
            $licksQuery->has('spit', '=', 0);
        } elseif ($filter === 'hasSpits') {
            $licksQuery->has('spit', '>', 0);
        } elseif (in_array($filter, ['profit', 'loss'])) {
            $licksQuery->whereHas('spit', function ($query) use ($filter) {
                if ($filter === 'profit') {
                    $query->whereRaw('spits.revenue - licks.revenue >= 0');
                } else {
                    $query->whereRaw('spits.revenue - licks.revenue < 0');
                }
            });
        }

        $licks = $licksQuery->paginate(20)->onEachSide(1);

        $totalPages = $licks->lastPage();

        return view("licks.index", compact(
            "licks",
            "page",
            "search",
            "filter",
            "lickRevenue",
            "spitRevenue",
            "totalRevenue",
            "totalPages"
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
            'revenue' => 'required|numeric|min:0',

            // Optional Spit field
            'spit_revenue' => 'nullable|numeric|min:0',
        ]);

        $lick = Lick::create($validated);

        if ($request->filled('spit_revenue')) {
            $lick->spit()->create([
                'revenue' => $validated['spit_revenue'] ?? 0,
            ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lick $lick)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lick $lick)
    {
        //
    }

    public function stats()
    {
        return view('licks.stats');
    }
}
