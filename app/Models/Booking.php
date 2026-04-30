<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'package_id',
        'event_id',
        'guest_name',
        'guest_phone',
        'guest_email',
        'guest_address',
        'visit_date',
        'total_person',
        'price_per_person',
        'total_price',
        'status',
        'notes',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                $date = now()->format('Ymd');
                $random = strtoupper(Str::random(4));
                $booking->booking_code = "KAB-{$date}-{$random}";
            }
        });
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function waNotifications()
    {
        return $this->hasMany(WaNotification::class);
    }
}
