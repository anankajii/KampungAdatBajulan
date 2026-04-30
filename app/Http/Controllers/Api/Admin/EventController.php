<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('package')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil semua event',
            'data' => $events,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string',
            'status' => 'required|in:upcoming,ongoing,done,cancelled',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $event = new Event($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $event->image_path = $path;
        }

        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan event',
            'data' => $event,
        ], 201);
    }

    public function show($id)
    {
        $event = Event::with('package')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil event',
            'data' => $event,
        ]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string',
            'status' => 'required|in:upcoming,ongoing,done,cancelled',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $event->fill($request->except('image'));

        if ($request->hasFile('image')) {
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $path = $request->file('image')->store('events', 'public');
            $event->image_path = $path;
        }

        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengubah event',
            'data' => $event,
        ]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus event',
        ]);
    }
}
