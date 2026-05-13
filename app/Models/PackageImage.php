<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'image_path',
        'is_cover',
        'sort_order',
    ];

    protected $appends = ['full_url'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getFullUrlAttribute()
    {
        if ($this->image_path) {
            // Cek apakah path sudah berupa URL lengkap
            if (str_starts_with($this->image_path, 'http')) {
                return $this->image_path;
            }
            // Gunakan disk uploads (public_html/uploads/) agar tidak perlu symlink
            return rtrim(config('app.url'), '/') . '/uploads/' . ltrim($this->image_path, '/');
        }
        return null;
    }
}
