<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with(['images' => function ($query) {
            $query->where('is_cover', true)->orWhere('sort_order', 0);
        }])->where('status', 'active')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data paket wisata',
            'data' => $packages,
        ]);
    }

    public function show($id)
    {
        $package = Package::with('images')->where('status', 'active')->find($id);

        if (!$package) {
            return response()->json([
                'success' => false,
                'message' => 'Paket wisata tidak ditemukan',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil detail paket wisata',
            'data' => $package,
        ]);
    }
}
