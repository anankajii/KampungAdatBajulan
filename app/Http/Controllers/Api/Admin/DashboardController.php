<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        $currentMonth = now()->format('m');
        $currentYear = now()->format('Y');

        $totalBookingHariIni = Booking::whereDate('created_at', $today)->count();
        
        $totalPendapatanBulanIni = Booking::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'paid')
            ->sum('total_price');

        $bookingTerbaru = Booking::with('package')->latest()->take(5)->get();

        $jumlahPaketAktif = Package::where('status', 'active')->count();

        return response()->json([
            'success' => true,
            'message' => 'Data dashboard',
            'data' => [
                'total_booking_hari_ini' => $totalBookingHariIni,
                'total_pendapatan_bulan_ini' => $totalPendapatanBulanIni,
                'jumlah_paket_aktif' => $jumlahPaketAktif,
                'booking_terbaru' => $bookingTerbaru,
            ],
        ]);
    }
}
