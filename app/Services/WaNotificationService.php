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
        $this->token = config('services.fonnte.token');
        $this->url   = config('services.fonnte.url', 'https://api.fonnte.com/send');
    }

    public function sendBookingConfirmation($booking)
    {
        $paketName = $booking->package ? $booking->package->name : 'Paket Wisata';
        $tanggal = \Carbon\Carbon::parse($booking->visit_date)->format('d-m-Y');
        $total = number_format($booking->total_price, 0, ',', '.');
        
        $message = "Halo {$booking->guest_name}, booking Anda berhasil! Kode: {$booking->booking_code}, Paket: {$paketName}, Tanggal: {$tanggal}, Total: Rp{$total}. Terima kasih telah memilih Kampung Adat Bajulan.";

        // Normalisasi nomor: 08xxx → 628xxx, +628xxx → 628xxx
        $phone = preg_replace('/\D/', '', $booking->guest_phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        }

        $status          = 'failed';
        $gatewayResponse = null;

        try {
            // Cek token tersedia
            if (empty($this->token)) {
                throw new \Exception('Fonnte token tidak dikonfigurasi.');
            }

            $response = Http::timeout(10)
                ->withHeaders(['Authorization' => $this->token])
                ->post($this->url, [
                    'target'      => $phone,
                    'message'     => $message,
                    'countryCode' => '62',
                ]);

            $gatewayResponse = $response->body();

            if ($response->successful()) {
                // Fonnte kadang return success HTTP tapi body berisi error
                $body = $response->json();
                if (isset($body['status']) && $body['status'] === false) {
                    throw new \Exception('Fonnte error: ' . ($body['reason'] ?? $gatewayResponse));
                }
                $status = 'sent';
            } else {
                throw new \Exception("Fonnte HTTP {$response->status()}: {$gatewayResponse}");
            }

        } catch (\Exception $e) {
            // Catat error tapi JANGAN lempar exception ke caller
            // agar proses booking/callback tidak terganggu
            Log::error('WaNotification gagal dikirim', [
                'booking_code' => $booking->booking_code,
                'phone'        => $phone,
                'error'        => $e->getMessage(),
            ]);
            $gatewayResponse = $gatewayResponse ?? $e->getMessage();
        }

        // Selalu catat ke tabel wa_notifications (berhasil maupun gagal)
        try {
            WaNotification::create([
                'booking_id'       => $booking->id,
                'recipient_phone'  => $booking->guest_phone,
                'template'         => 'booking_confirmation',
                'message'          => $message,
                'status'           => $status,
                'gateway'          => 'fonnte',
                'gateway_response' => $gatewayResponse,
                'sent_at'          => $status === 'sent' ? now() : null,
            ]);
        } catch (\Exception $e) {
            Log::error('WaNotification: gagal simpan ke DB', [
                'booking_code' => $booking->booking_code,
                'error'        => $e->getMessage(),
            ]);
        }

        return $status === 'sent';
    }
}
