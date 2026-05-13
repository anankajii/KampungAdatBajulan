<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $events = \App\Models\Event::with('package')
            ->orderBy('event_date', 'asc')
            ->take(6)
            ->get();

        // Ambil paket untuk landing page
        $featuredPackage = \App\Models\Package::with('images')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->first();

        $sidePackages = \App\Models\Package::with('images')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->skip(1)
            ->take(2)
            ->get();

        // Ambil galeri untuk landing page (max 6, prioritaskan featured)
        $galleries = \App\Models\Gallery::orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('landing', compact('events', 'featuredPackage', 'sidePackages', 'galleries'));
    }
}