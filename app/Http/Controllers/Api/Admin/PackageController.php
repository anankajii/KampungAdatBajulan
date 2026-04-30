<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('images')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil semua paket',
            'data' => $packages,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price_per_person' => 'required|numeric',
            'min_person' => 'required|integer',
            'category' => 'required|in:kampung_adat,budaya_seni,edukasi_durian,pendakian,trabas',
            'status' => 'required|in:active,inactive',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $package = Package::create($request->except('cover_image'));

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('packages', 'public');
            $package->images()->create([
                'image_path' => $path,
                'is_cover' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan paket',
            'data' => $package->load('images'),
        ], 201);
    }

    public function show($id)
    {
        $package = Package::with('images')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil paket',
            'data' => $package,
        ]);
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price_per_person' => 'required|numeric',
            'min_person' => 'required|integer',
            'category' => 'required|in:kampung_adat,budaya_seni,edukasi_durian,pendakian,trabas',
            'status' => 'required|in:active,inactive',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $package->update($request->except('cover_image'));

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('packages', 'public');
            
            // Remove old cover
            $oldCover = $package->images()->where('is_cover', true)->first();
            if ($oldCover) {
                Storage::disk('public')->delete($oldCover->image_path);
                $oldCover->delete();
            }

            $package->images()->create([
                'image_path' => $path,
                'is_cover' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengubah paket',
            'data' => $package->load('images'),
        ]);
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus paket',
        ]);
    }
}
