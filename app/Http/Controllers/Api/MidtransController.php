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

    public function callback(Request $request)
    {
        $payload = $request->all();

        // Verify signature
        if (!$this->midtransService->verifySignature($payload)) {
            Log::error('Midtrans Callback Signature Verification Failed', $payload);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = $payload['order_id'];
        $transactionStatus = $payload['transaction_status'];
        $fraudStatus = $payload['fraud_status'] ?? null;

        $booking = Booking::with('payment')->where('booking_code', $orderId)->first();

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $paymentStatus = 'pending';
        $bookingStatus = 'pending';

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $paymentStatus = 'pending';
                $bookingStatus = 'pending';
            } else if ($fraudStatus == 'accept') {
                $paymentStatus = 'paid';
                $bookingStatus = 'paid';
            }
        } else if ($transactionStatus == 'settlement') {
            $paymentStatus = 'paid';
            $bookingStatus = 'paid';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $paymentStatus = $transactionStatus == 'expire' ? 'expired' : 'failed';
            $bookingStatus = $transactionStatus == 'expire' ? 'expired' : 'cancelled';
        } else if ($transactionStatus == 'pending') {
            $paymentStatus = 'pending';
            $bookingStatus = 'pending';
        }

        $booking->update(['status' => $bookingStatus]);
        
        $paymentData = [
            'status' => $paymentStatus,
            'midtrans_payload' => $payload,
            'payment_method' => $payload['payment_type'] ?? null,
            'midtrans_transaction_id' => $payload['transaction_id'] ?? null,
        ];

        if ($paymentStatus == 'paid') {
            $paymentData['paid_at'] = now();
        } else if ($paymentStatus == 'expired') {
            $paymentData['expired_at'] = now();
        }

        if ($booking->payment) {
            $booking->payment->update($paymentData);
        }

        // Trigger WaNotification if paid
        if ($paymentStatus == 'paid') {
            $this->waService->sendBookingConfirmation($booking);
        }

        return response()->json(['message' => 'Notification handled successfully']);
    }
}
