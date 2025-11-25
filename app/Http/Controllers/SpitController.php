<?php

namespace App\Http\Controllers;

use App\Models\Lick;
use App\Models\Spit;
use Illuminate\Http\Request;

class SpitController extends Controller
{
    public function create(Lick $lick)
    {
        return view("spits.create", compact('lick'));
    }

    public function store(Request $request, $id)
    {
        $lick = Lick::findOrFail($id);

        $validated = $request->validate([
            'revenue' => 'required|numeric|min:0',
            'date' => 'required|date'
        ]);

        Spit::create([
            'lick_id' => $lick->id,
            'revenue' => $validated['revenue'],
            'date' => $validated['date']
        ]);

        $lick->update(['profit' => $validated['revenue'] - $lick->cost]);

        return redirect()->route('licks.show', $lick)->with('success', 'Spit created successfully!');
    }
}
