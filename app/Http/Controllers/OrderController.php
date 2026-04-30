<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function create(Request $request)
    {
        $packageId = $request->query('package', 1);
        $pkg       = Package::with('images')->where('status', 'active')->find($packageId);

        if (! $pkg) abort(404);

        // Bangun array yang dipakai view (sama seperti PackageController)
        $package = app(PackageController::class)->buildPackageArray($pkg);

        return view('orders.create', compact('package'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id'   => 'required|exists:packages,id',
            'name'         => 'required|string|max:255',
            'whatsapp'     => 'required|string|max:20',
            'date'         => 'required|date|after_or_equal:today',
            'people'       => 'required|integer|min:1|max:100',
        ]);

        $pkg = Package::findOrFail($request->package_id);

        if ($request->people < $pkg->min_person) {
            return back()->withInput()->withErrors([
                'people' => "Minimal pemesanan untuk paket ini adalah {$pkg->min_person} orang.",
            ]);
        }

        DB::beginTransaction();
        try {
            $totalPrice = $pkg->price_per_person * $request->people;

            $booking = Booking::create([
                'package_id'      => $pkg->id,
                'guest_name'      => $request->name,
                'guest_phone'     => $request->whatsapp,
                'visit_date'      => $request->date,
                'total_person'    => $request->people,
                'price_per_person'=> $pkg->price_per_person,
                'total_price'     => $totalPrice,
                'status'          => 'pending',
            ]);

            $snapToken = $this->midtransService->createTransaction($booking);

            if (! $snapToken) {
                throw new \Exception('Gagal membuat transaksi pembayaran.');
            }

            $booking->payment()->create([
                'midtrans_order_id' => $booking->booking_code,
                'midtrans_token'    => $snapToken,
                'amount'            => $totalPrice,
                'status'            => 'pending',
            ]);

            DB::commit();

            $pkgData = app(PackageController::class)->buildPackageArray($pkg->load('images'));

            return view('orders.payment', [
                'snapToken'   => $snapToken,
                'bookingCode' => $booking->booking_code,
                'pkgData'     => $pkgData,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors([
                'general' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    public function status(Request $request)
    {
        $code   = $request->query('code');
        $status = $request->query('status', 'pending');

        $booking = null;
        if ($code) {
            $booking = Booking::with(['package', 'payment'])
                ->where('booking_code', $code)
                ->first();
        }

        return view('orders.status', compact('booking', 'status', 'code'));
    }
}
