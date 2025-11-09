<?php

namespace App\Http\Controllers;

use App\Models\Lick;
use Illuminate\Http\Request;

class LickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $licks = Lick::orderBy('created_at', 'desc')->paginate(10);

        return view("licks.index", compact("licks"));
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
        //
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
}
