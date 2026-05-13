<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'package_id',
        'name',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'image_path',
        'status',
    ];

    protected $appends = ['full_url'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getFullUrlAttribute()
    {
        if ($this->image_path) {
            // Kembalikan URL absolut agar bisa diakses dari mobile
            return rtrim(config('app.url'), '/') . '/uploads/' . ltrim($this->image_path, '/');
        }
        return null;
    }
}
