<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class CleanPendingBookings extends Command
{
    protected $signature   = 'bookings:clean-pending';
    protected $description = 'Hapus booking pending yang sudah lebih dari 24 jam (Midtrans Snap token expired)';

    public function handle()
    {
        // Snap token Midtrans berlaku 24 jam.
        // Hapus booking pending yang dibuat lebih dari 24 jam lalu
        // dan belum ada pembayaran (status payment masih pending / tidak ada paid_at).
        $bookings = Booking::where('status', 'pending')
            ->where('created_at', '<', now()->subHours(24))
            ->whereHas('payment', function ($q) {
                $q->whereNull('paid_at')->whereNull('expired_at');
            })
            ->orWhere(function ($q) {
                // Booking pending yang tidak punya payment sama sekali (edge case)
                $q->where('status', 'pending')
                  ->where('created_at', '<', now()->subHours(24))
                  ->doesntHave('payment');
            })
            ->get();

        $count = 0;
        foreach ($bookings as $booking) {
            $booking->payment()->delete();
            $booking->delete();
            $count++;
        }

        $this->info("Deleted {$count} pending bookings older than 24 hours.");
        return Command::SUCCESS;
    }
}
