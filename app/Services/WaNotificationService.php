<?php

namespace App\Services;

use App\Models\WaNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WaNotificationService
{
    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN');
        $this->url = env('FONNTE_URL', 'https://api.fonnte.com/send');
    }

    public function sendBookingConfirmation($booking)
    {
        $paketName = $booking->package ? $booking->package->name : 'Paket Wisata';
        $tanggal = \Carbon\Carbon::parse($booking->visit_date)->format('d-m-Y');
        $total = number_format($booking->total_price, 0, ',', '.');
        
        $message = "Halo {$booking->guest_name}, booking Anda berhasil! Kode: {$booking->booking_code}, Paket: {$paketName}, Tanggal: {$tanggal}, Total: Rp{$total}. Terima kasih telah memilih Kampung Adat Bajulan.";

        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post($this->url, [
            'target' => $booking->guest_phone,
            'message' => $message,
            'countryCode' => '62',
        ]);

        $status = 'failed';
        if ($response->successful()) {
            $status = 'sent';
        }

        WaNotification::create([
            'booking_id' => $booking->id,
            'recipient_phone' => $booking->guest_phone,
            'template' => 'booking_confirmation',
            'message' => $message,
            'status' => $status,
            'gateway' => 'fonnte',
            'gateway_response' => $response->body(),
            'sent_at' => $status === 'sent' ? now() : null,
        ]);

        if ($status === 'failed') {
            Log::error('Fonnte WaNotification failed: ' . $response->body());
        }

        return $status === 'sent';
    }
}
