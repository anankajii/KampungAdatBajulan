<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['package', 'payment']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('visit_date', $request->date);
        }

        $bookings = $query->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data booking',
            'data' => $bookings,
        ]);
    }

    public function show($id)
    {
        $booking = Booking::with(['package', 'payment', 'waNotifications'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil detail booking',
            'data' => $booking,
        ]);
    }
}
