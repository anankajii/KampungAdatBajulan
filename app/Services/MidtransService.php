<?php

namespace App\Services;

class MidtransService
{
    protected $serverKey;
    protected $clientKey;
    protected $isProduction;
    protected $snapUrl;

    public function __construct()
    {
        $this->serverKey    = config('services.midtrans.server_key');
        $this->clientKey    = config('services.midtrans.client_key');
        $this->isProduction = config('services.midtrans.is_production', false);

        // Otomatis pilih URL sesuai mode
        $this->snapUrl = $this->isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        // Konfigurasi library midtrans
        \Midtrans\Config::$serverKey    = $this->serverKey;
        \Midtrans\Config::$isProduction = $this->isProduction;
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;
    }

    public function createTransaction($booking)
    {
        $customerDetails = [
            'first_name' => $booking->guest_name,
            'phone'      => $booking->guest_phone,
        ];

        $params = [
            'transaction_details' => [
                'order_id'     => $booking->booking_code,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => $customerDetails,
            // Simpan data penting di custom_field agar bisa dibaca saat callback
            'custom_field1' => (string) $booking->package_id,
            'custom_field2' => (string) $booking->total_person,
            'custom_field3' => (string) $booking->visit_date,
            // Set notification URL langsung di parameter transaksi
            'callbacks' => [
                'finish' => url('/booking/status?status=success&code=' . $booking->booking_code),
            ],
        ];

        // Set notification URL via header — hardcode untuk memastikan URL benar
        \Midtrans\Config::$appendNotifUrl = 'https://kampungadatbajulan.pbltifnganjuk.com/api/midtrans/callback';

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            \Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return null;
        }
    }

    public function verifySignature($payload)
    {
        $orderId = $payload['order_id'] ?? '';
        $statusCode = $payload['status_code'] ?? '';
        $grossAmount = $payload['gross_amount'] ?? '';
        $serverKey = $this->serverKey;
        
        $signatureKey = $payload['signature_key'] ?? '';
        
        $calculatedSignatureKey = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);
        
        return $signatureKey === $calculatedSignatureKey;
    }
}
