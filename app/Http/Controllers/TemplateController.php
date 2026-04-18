<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeFromTrip(Request $request, Trip $trip)
    {
        $this->authorize('view', $trip);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:beach,business,mountain,city,custom',
        ]);

        $template = Auth::user()->templates()->create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        foreach ($trip->packingItems as $item) {
            $template->items()->create([
                'name'     => $item->name,
                'category' => $item->category,
                'order'    => $item->order,
            ]);
        }

        return redirect()->route('trips.show', $trip)->with('success', 'Template "' . $template->name . '" salvato!');
    }

    public function destroy(Template $template)
    {
        $this->authorize('delete', $template);
        $template->delete();

        return back()->with('success', 'Template eliminato.');
    }
}
