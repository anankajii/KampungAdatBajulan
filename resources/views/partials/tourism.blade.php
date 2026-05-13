{{-- 3. TOURISM PACKAGES --}}
@php
$categoryLabels = [
    'kampung_adat'   => 'Budaya',
    'budaya_seni'    => 'Ritual',
    'edukasi_durian' => 'Kuliner',
    'pendakian'      => 'Alam',
    'trabas'         => 'Petualangan',
];
$categoryColors = [
    'kampung_adat'   => '#c8860a',
    'budaya_seni'    => '#1e3a1e',
    'edukasi_durian' => '#c8860a',
    'pendakian'      => '#2d5a27',
    'trabas'         => '#5a2d27',
];
@endphp

<section id="tourism">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <p class="section-label">Paket Wisata</p>
            <h2 class="section-heading">Tourism Packages</h2>
            <p class="mt-3 mx-auto" style="max-width:520px;font-size:0.92rem;color:var(--text-muted)">
                Choose from our thoughtfully designed packages for an unforgettable expedition.
            </p>
        </div>

        @if($featuredPackage)
        <div class="row g-3 fade-up" style="min-height:420px">

            {{-- Featured Large Card --}}
            <div class="col-lg-6">
                <div class="package-card-featured" style="min-height:420px"
                     onclick="window.location.href='{{ route('packages.show', $featuredPackage->id) }}'">
                    <img src="{{ $featuredPackage->cover_image ?? '/images/gallery1.png' }}"
                         alt="{{ $featuredPackage->name }}">
                    <div class="overlay"></div>
                    <div class="content">
                        {{-- Tampilkan kategori, bukan "Featured" --}}
                        <span class="package-tag" style="
                            background: {{ $categoryColors[$featuredPackage->category] ?? '#888' }};
                            color: #fff;
                            border-radius: 50px;
                            padding: 0.25rem 0.85rem;
                            font-size: 0.7rem;
                            font-weight: 700;
                            letter-spacing: 0.08em;
                            text-transform: uppercase;
                            display: inline-block;
                            margin-bottom: 0.75rem;
                        ">
                            {{ $categoryLabels[$featuredPackage->category] ?? ucfirst(str_replace('_', ' ', $featuredPackage->category)) }}
                        </span>
                        <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;margin-bottom:0.5rem">
                            {{ $featuredPackage->name }}
                        </h3>
                        <p style="font-size:0.88rem;color:rgba(255,255,255,0.8);margin-bottom:1rem;line-height:1.6">
                            {{ Str::limit($featuredPackage->description, 120) }}
                        </p>
                        <a href="{{ route('packages.show', $featuredPackage->id) }}"
                           class="btn-hero-primary" style="font-size:0.85rem;padding:0.55rem 1.4rem">
                            Explore <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Two Small Cards --}}
            <div class="col-lg-6 d-flex flex-column gap-3">
                @foreach($sidePackages as $pkg)
                <a href="{{ route('packages.show', $pkg->id) }}" class="package-card-sm text-decoration-none">
                    <img src="{{ $pkg->cover_image ?? '/images/gallery2.png' }}" alt="{{ $pkg->name }}">
                    <div class="info">
                        {{-- Badge kategori dengan warna solid agar terlihat di background putih --}}
                        <span style="
                            display: inline-block;
                            background: {{ $categoryColors[$pkg->category] ?? '#888' }};
                            color: #fff;
                            border-radius: 50px;
                            padding: 0.2rem 0.75rem;
                            font-size: 0.65rem;
                            font-weight: 700;
                            letter-spacing: 0.08em;
                            text-transform: uppercase;
                            margin-bottom: 0.4rem;
                        ">
                            {{ $categoryLabels[$pkg->category] ?? ucfirst(str_replace('_', ' ', $pkg->category)) }}
                        </span>
                        <h6 style="font-family:'Playfair Display',serif;color:var(--green-dark);margin:0.3rem 0 0.25rem">
                            {{ $pkg->name }}
                        </h6>
                        <p class="package-price mb-1">Rp {{ number_format($pkg->price_per_person, 0, ',', '.') }} / person</p>
                        <p style="font-size:0.8rem;color:var(--text-muted);margin:0;line-height:1.5">
                            {{ Str::limit($pkg->description, 80) }}
                        </p>
                    </div>
                </a>
                @endforeach

                <div class="text-end mt-2">
                    <a href="{{ route('packages') }}" class="btn-explore text-decoration-none">
                        Lihat Semua Paket <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5 fade-up" style="color:var(--text-muted)">
            <i class="bi bi-bag-x" style="font-size:2.5rem;display:block;margin-bottom:1rem;opacity:0.4"></i>
            <p>Belum ada paket wisata tersedia.</p>
        </div>
        @endif
    </div>
</section>
