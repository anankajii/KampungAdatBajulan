<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageImageController extends Controller
{
    public function store(Request $request, $packageId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('packages', 'public');

        $packageImage = PackageImage::create([
            'package_id' => $packageId,
            'image_path' => $path,
            'is_cover' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan foto paket',
            'data' => $packageImage,
        ], 201);
    }

    public function destroy($id)
    {
        $packageImage = PackageImage::findOrFail($id);
        
        Storage::disk('public')->delete($packageImage->image_path);
        $packageImage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus foto paket',
        ]);
    }
}
