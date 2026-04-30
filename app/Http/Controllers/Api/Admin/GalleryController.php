<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data galeri',
            'data' => $galleries,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'caption' => 'nullable|string',
            'category' => 'required|in:kampung,budaya,alam,kuliner,event,lainnya',
            'is_featured' => 'boolean',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gallery = new Gallery($request->except('image'));

        $path = $request->file('image')->store('galleries', 'public');
        $gallery->image_path = $path;
        $gallery->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan galeri',
            'data' => $gallery,
        ], 201);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus galeri',
        ]);
    }
}
