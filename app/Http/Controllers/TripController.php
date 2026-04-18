<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Trip;
use App\Services\DefaultPackingItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trips     = Auth::user()->trips()->orderBy('departure_date')->get();
        $templates = Auth::user()->templates()->orderBy('name')->get();
        return view('trips.index', compact('trips', 'templates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'destination'    => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date'    => 'nullable|date|after_or_equal:departure_date',
            'type'           => 'required|in:beach,business,mountain,city',
            'template_id'    => 'nullable|exists:templates,id',
        ]);

        $trip = Auth::user()->trips()->create($validated);

        if ($request->filled('template_id')) {
            $template = Template::findOrFail($request->template_id);
            foreach ($template->items as $item) {
                $trip->packingItems()->create([
                    'name'     => $item->name,
                    'category' => $item->category,
                    'order'    => $item->order,
                ]);
            }
        } else {
            foreach (DefaultPackingItems::forType($trip->type) as $item) {
                $trip->packingItems()->create($item);
            }
        }

        return redirect()->route('trips.show', $trip)->with('success', 'Viaggio creato!');
    }

    public function show(Trip $trip)
    {
        $this->authorize('view', $trip);
        return view('trips.show', compact('trip'));
    }

    public function update(Request $request, Trip $trip)
    {
        $this->authorize('update', $trip);

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'destination'    => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date'    => 'nullable|date|after_or_equal:departure_date',
            'type'           => 'required|in:beach,business,mountain,city',
            'status'         => 'required|in:preparing,traveling,done',
        ]);

        $trip->update($validated);

        return redirect()->route('trips.index')->with('success', 'Viaggio aggiornato!');
    }

    public function destroy(Trip $trip)
    {
        $this->authorize('delete', $trip);
        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Viaggio eliminato.');
    }
}
