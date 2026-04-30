<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('package')->whereIn('status', ['upcoming', 'ongoing'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data event',
            'data' => $events,
        ]);
    }
}
