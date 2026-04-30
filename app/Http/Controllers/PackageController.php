<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Mapping kategori ke label & warna tag untuk tampilan frontend.
     */
    private function categoryMeta(string $category): array
    {
        return match ($category) {
            'kampung_adat'  => ['tag' => 'Culture',   'tag_label' => 'Cultural Immersion', 'tag_color' => '#c8860a'],
            'budaya_seni'   => ['tag' => 'Culture',   'tag_label' => 'Budaya & Seni',       'tag_color' => '#1e3a1e'],
            'edukasi_durian'=> ['tag' => 'Culinary',  'tag_label' => 'Culinary',            'tag_color' => '#c8860a'],
            'pendakian'     => ['tag' => 'Nature',    'tag_label' => 'Nature',              'tag_color' => '#2d5a27'],
            'trabas'        => ['tag' => 'Adventure', 'tag_label' => 'Adventure',           'tag_color' => '#5a2d27'],
            default         => ['tag' => 'Wisata',    'tag_label' => 'Wisata',              'tag_color' => '#888'],
        };
    }

    /**
     * Konversi model Package ke array yang dipakai view.
     * Public agar bisa dipakai OrderController.
     */
    public function buildPackageArray(Package $pkg): array
    {
        $meta       = $this->categoryMeta($pkg->category);
        $coverImage = $pkg->cover_image ?? '/images/gallery1.png';

        // Ambil semua gambar untuk detail page
        $images = $pkg->images->pluck('full_url')->filter()->values()->toArray();
        $img2   = $images[1] ?? '/images/gallery2.png';
        $img3   = $images[2] ?? '/images/gallery3.png';

        return [
            'id'           => $pkg->id,
            'tag'          => $meta['tag'],
            'tag_label'    => $meta['tag_label'],
            'tag_color'    => $meta['tag_color'],
            'title'        => $pkg->name,
            'subtitle'     => $pkg->name,
            'hero_caption' => $pkg->description,
            'location'     => 'Kampung Adat Bajulan, Nganjuk',
            'price'        => (float) $pkg->price_per_person,
            'price_label'  => 'Rp ' . number_format($pkg->price_per_person, 0, ',', '.'),
            'img'          => $coverImage,
            'img2'         => $img2,
            'img3'         => $img3,
            'desc'         => $pkg->description,
            'desc2'        => $pkg->terms ?? '',
            'duration'     => '—',
            'group'        => 'Min. ' . $pkg->min_person . ' orang',
            'language'     => 'Indonesia, Jawa',
            'includes'     => [],
            'requirements' => [
                "Minimal pemesanan {$pkg->min_person} orang.",
                'Harap tiba 15 menit sebelum jadwal.',
                'Kenakan pakaian yang sopan dan nyaman.',
            ],
            'min_person'   => $pkg->min_person,
            'category'     => $pkg->category,
        ];
    }

    public function index(Request $request)
    {
        $packages = Package::with('images')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn($pkg) => $this->buildPackageArray($pkg))
            ->toArray();

        return view('packages.index', compact('packages'));
    }

    public function show($id)
    {
        $pkg = Package::with('images')
            ->where('status', 'active')
            ->find($id);

        if (! $pkg) abort(404);

        $package = $this->buildPackageArray($pkg);

        return view('packages.show', compact('package'));
    }
}
