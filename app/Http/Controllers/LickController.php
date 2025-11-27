<?php

namespace App\Http\Controllers;

use App\LickImageTrait;
use App\Models\Lick;
use App\Models\LickImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LickController extends Controller
{
    use LickImageTrait;

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
        $spitRevenue = DB::table('spits')
            ->join('licks', 'spits.lick_id', '=', 'licks.id')
            ->where('licks.user_id', auth()->id())
            ->sum('spits.revenue');
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


    public function create()
    {
        return view("licks.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:500',

            // Optional Spit field
            'spit_revenue' => 'nullable|numeric|min:0',
            'spit_date' => 'nullable|date',
        ]);

        if (!is_null($validated['notes']) && trim($validated['notes']) == '') {
            $validated['notes'] = null;
        }

        $lick = Lick::create([
            'name' => $validated['name'],
            'cost' => $validated['cost'],
            'profit' => $request->filled('spit_revenue') ? $validated['spit_revenue'] - $validated['cost'] : $validated['cost'] * -1,
            'date' => $validated['date'],
            'notes' => $validated['notes'],
            'user_id' => auth()->id()
        ]);

        if ($request->filled('spit_revenue')) {
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

    public function show(Lick $lick)
    {
        return view('licks.show', compact('lick'));
    }

    public function edit(Lick $lick)
    {
        return view('licks.edit', compact('lick'));
    }

    public function update(Request $request, int $id)
    {
        $lick = Lick::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:500',

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

        if (!is_null($validated['notes']) && trim($validated['notes']) == '') {
            $validated['notes'] = null;
        }

        $lick->update([
            'name' => $validated['name'],
            'cost' => $validated['cost'],
            'profit' => $profit,
            'date' => $validated['date'],
            'notes' => $validated['notes']
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

    public function destroy(Lick $lick)
    {
        foreach ($lick->images as $lickImage) {
            $this->deleteLickImage($lickImage);
        }

        $lick->delete();
        return redirect()->route('licks.index')->with('success', 'Lick deleted');
    }
}
