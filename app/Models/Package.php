<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'terms',
        'price_per_person',
        'min_person',
        'category',
        'status',
        'sort_order',
    ];

    protected $appends = ['cover_image'];

    public function images()
    {
        return $this->hasMany(PackageImage::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getCoverImageAttribute()
    {
        $cover = $this->images()->where('is_cover', true)->first();
        if (!$cover) {
            $cover = $this->images()->orderBy('sort_order')->first();
        }
        return $cover ? $cover->full_url : null;
    }
}
