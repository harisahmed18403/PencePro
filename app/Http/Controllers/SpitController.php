<?php

namespace App\Http\Controllers;

use App\Models\Lick;
use App\Models\Spit;
use Illuminate\Http\Request;

class SpitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Lick $lick)
    {
        return view("spits.create", compact('lick'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Lick $lick)
    {
        $validated = $request->validate([
            'revenue' => 'required|numeric|min:0',
        ]);

        $lick->spit()->create([
            'lick_id' => $lick->id,
            'revenue' => $validated['revenue'],
        ]);

        return redirect()->route('licks.show', $lick)->with('success', 'Spit created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Spit $spit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spit $spit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spit $spit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spit $spit)
    {
        //
    }
}
