<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\MidtransService;
use App\Services\WaNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    protected $midtransService;
    protected $waService;

    public function __construct(MidtransService $midtransService, WaNotificationService $waService)
    {
        $this->midtransService = $midtransService;
        $this->waService = $waService;
    }

    /**
     * IP resmi Midtrans (sandbox & production)
     * Referensi: https://docs.midtrans.com/docs/ip-address-whitelist
     */
    private function isMidtransIp(string $ip): bool
    {
        $allowedIps = [
            '103.208.23.0/24',
            '103.208.23.6',
            '103.208.23.7',
            '103.127.221.120',
            '103.127.221.121',
            '103.127.221.122',
            // Sandbox IPs
            '103.208.23.0',
        ];

        foreach ($allowedIps as $allowed) {
            if (str_contains($allowed, '/')) {
                // CIDR check
                [$subnet, $bits] = explode('/', $allowed);
                $ip_long     = ip2long($ip);
                $subnet_long = ip2long($subnet);
                $mask        = -1 << (32 - (int) $bits);
                if (($ip_long & $mask) === ($subnet_long & $mask)) {
                    return true;
                }
            } elseif ($ip === $allowed) {
                return true;
            }
        }
        return false;
    }

    public function callback(Request $request)
    {
        $payload = $request->all();
        $orderId = $payload['order_id'] ?? null;
        $clientIp = $request->ip();

        Log::info('Midtrans Callback received', ['order_id' => $orderId, 'ip' => $clientIp]);

        // 0. Cek IP whitelist Midtrans
        // Skip jika masih sandbox (MIDTRANS_IS_PRODUCTION=false)
        $isProduction = config('services.midtrans.is_production', false);
        if ($isProduction && !$this->isMidtransIp($clientIp)) {
            Log::warning('Midtrans Callback: IP not whitelisted', ['ip' => $clientIp, 'order_id' => $orderId]);
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // 1. Pastikan order_id ada
        if (!$orderId) {
            Log::warning('Midtrans Callback: missing order_id', ['ip' => $request->ip()]);
            return response()->json(['message' => 'Invalid request'], 400);
        }

        // 2. Pastikan booking sudah ada di DB — JANGAN buat booking baru dari callback
        $booking = Booking::with('payment')->where('booking_code', $orderId)->first();

        if (!$booking) {
            Log::warning('Midtrans Callback: booking not found in DB', [
                'order_id' => $orderId,
                'ip'       => $request->ip(),
            ]);
            // Kembalikan 200 agar Midtrans tidak retry, tapi tidak lakukan apa-apa
            return response()->json(['message' => 'Order not found, ignored']);
        }

        // 3. Verifikasi signature
        if (!$this->midtransService->verifySignature($payload)) {
            Log::error('Midtrans Callback: signature verification FAILED', [
                'order_id'      => $orderId,
                'ip'            => $request->ip(),
                'signature_key' => $payload['signature_key'] ?? 'missing',
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        Log::info('Midtrans Callback: signature OK', ['order_id' => $orderId]);

        $transactionStatus = $payload['transaction_status'];
        $fraudStatus       = $payload['fraud_status'] ?? null;

        // 4. Tentukan status
        $paymentStatus = 'pending';
        $bookingStatus = 'pending';

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $paymentStatus = 'pending';
                $bookingStatus = 'pending';
            } elseif ($fraudStatus == 'accept') {
                $paymentStatus = 'paid';
                $bookingStatus = 'paid';
            }
        } elseif ($transactionStatus == 'settlement') {
            $paymentStatus = 'paid';
            $bookingStatus = 'paid';
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $paymentStatus = $transactionStatus == 'expire' ? 'expired' : 'failed';
            $bookingStatus = $transactionStatus == 'expire' ? 'expired' : 'cancelled';
        }

        // 5. Update status booking & payment
        $booking->update(['status' => $bookingStatus]);

        $paymentData = [
            'status'                  => $paymentStatus,
            'midtrans_payload'        => $payload,
            'payment_method'          => $payload['payment_type'] ?? null,
            'midtrans_transaction_id' => $payload['transaction_id'] ?? null,
        ];

        if ($paymentStatus === 'paid') {
            $paymentData['paid_at'] = now();
        } elseif ($paymentStatus === 'expired') {
            $paymentData['expired_at'] = now();
        }

        if ($booking->payment) {
            $booking->payment->update($paymentData);
        }

        // 6. Kirim notifikasi WA hanya jika BARU pertama kali paid
        // Cek paid_at sebelum update — kalau sudah ada berarti WA sudah pernah dikirim
        if ($paymentStatus === 'paid') {
            $alreadyPaid = $booking->payment && $booking->payment->paid_at !== null;

            if (!$alreadyPaid) {
                $booking->load('package');
                $this->waService->sendBookingConfirmation($booking);
                Log::info('Midtrans Callback: booking marked paid, WA sent', ['order_id' => $orderId]);
            } else {
                Log::info('Midtrans Callback: booking already paid, WA skipped (duplicate callback)', ['order_id' => $orderId]);
            }
        }

        return response()->json(['message' => 'Notification handled successfully']);
    }
}

