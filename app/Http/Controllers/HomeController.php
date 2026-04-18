<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $trips     = $user->trips()->orderBy('departure_date')->get();
        $templates = $user->templates()->orderBy('name')->get();

        $nextTrip = $user->trips()
            ->where('status', '!=', 'done')
            ->where('departure_date', '>=', now()->toDateString())
            ->orderBy('departure_date')
            ->first();

        $totalTrips     = $trips->count();
        $totalTemplates = $templates->count();

        return view('home', compact('trips', 'templates', 'nextTrip', 'totalTrips', 'totalTemplates'));
    }
}
