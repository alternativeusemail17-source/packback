<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request): View
    {
        $user = $request->user();
        $activeDresses = $user->dresses()->latest()->get();

        return view('profile.show', [
            'user' => $user,
            'totalDresses' => $activeDresses->count(),
            'locationCount' => $activeDresses->pluck('location')->filter()->unique()->count(),
            'categoryCount' => $activeDresses->pluck('category')->filter()->unique()->count(),
            'recentDresses' => $activeDresses->take(4),
        ]);
    }
}
