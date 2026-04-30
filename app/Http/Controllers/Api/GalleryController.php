<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->orderBy('sort_order')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data galeri',
            'data' => $galleries,
        ]);
    }
}
