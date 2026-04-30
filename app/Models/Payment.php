<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'midtrans_order_id',
        'midtrans_token',
        'midtrans_transaction_id',
        'amount',
        'payment_method',
        'status',
        'midtrans_payload',
        'paid_at',
        'expired_at',
    ];

    protected $casts = [
        'midtrans_payload' => 'array',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
