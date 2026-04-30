<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'recipient_phone',
        'template',
        'message',
        'status',
        'gateway',
        'gateway_response',
        'sent_at',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
