<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:20',
            'visit_date' => 'required|date|after_or_equal:today',
            'total_person' => 'required|integer|min:1',
        ]);

        $package = Package::findOrFail($request->package_id);

        if ($request->total_person < $package->min_person) {
            return response()->json([
                'success' => false,
                'message' => "Minimal pemesanan untuk paket ini adalah {$package->min_person} orang.",
                'data' => null,
            ], 400);
        }

        DB::beginTransaction();
        try {
            $totalPrice = $package->price_per_person * $request->total_person;

            $booking = Booking::create([
                'package_id' => $package->id,
                'guest_name' => $request->guest_name,
                'guest_phone' => $request->guest_phone,
                'guest_email' => $request->guest_email,
                'guest_address' => $request->guest_address,
                'visit_date' => $request->visit_date,
                'total_person' => $request->total_person,
                'price_per_person' => $package->price_per_person,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            // Create midtrans payment
            $snapToken = $this->midtransService->createTransaction($booking);

            if (!$snapToken) {
                throw new \Exception('Gagal membuat transaksi pembayaran.');
            }

            $booking->payment()->create([
                'midtrans_order_id' => $booking->booking_code,
                'midtrans_token' => $snapToken,
                'amount' => $totalPrice,
                'status' => 'pending',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil membuat pemesanan',
                'data' => [
                    'booking_code' => $booking->booking_code,
                    'snap_token' => $snapToken,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function show($code)
    {
        $booking = Booking::with(['package', 'payment'])->where('booking_code', $code)->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data booking',
            'data' => $booking,
        ]);
    }
}
