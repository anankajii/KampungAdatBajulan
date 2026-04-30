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
        $this->snapUrl      = config('services.midtrans.snap_url', 'https://app.sandbox.midtrans.com/snap/v1/transactions');
        
        // Konfigurasi library midtrans
        \Midtrans\Config::$serverKey    = $this->serverKey;
        \Midtrans\Config::$isProduction = $this->isProduction;
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;
    }

    public function createTransaction($booking)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->guest_name,
                'email' => $booking->guest_email ?? '',
                'phone' => $booking->guest_phone,
            ],
        ];

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
