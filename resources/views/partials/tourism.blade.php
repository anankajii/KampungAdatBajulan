{{-- 3. TOURISM PACKAGES --}}
<section id="tourism">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <p class="section-label">Paket Wisata</p>
            <h2 class="section-heading">Tourism Packages</h2>
            <p class="mt-3 mx-auto" style="max-width:520px;font-size:0.92rem;color:var(--text-muted)">
                Choose from our thoughtfully designed packages for an unforgettable expedition.
            </p>
        </div>
        <div class="row g-3 fade-up" style="min-height:420px">
            {{-- Featured Large Card --}}
            <div class="col-lg-6">
                <div class="package-card-featured" style="min-height:420px" onclick="window.location.href='{{ route('packages.show', 1) }}'">
                    <img src="/images/gallery1.png" alt="Cultural Immersion Week">
                    <div class="overlay"></div>
                    <div class="content">
                        <span class="package-tag">Featured</span>
                        <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;margin-bottom:0.5rem">Cultural Immersion Week</h3>
                        <p style="font-size:0.88rem;color:rgba(255,255,255,0.8);margin-bottom:1rem;line-height:1.6">
                            Live with locals, learn traditional crafts, join sacred rituals, and immerse in authentic Javanese village culture.
                        </p>
                        <a href="{{ route('packages.show', 1) }}" class="btn-hero-primary" style="font-size:0.85rem;padding:0.55rem 1.4rem">
                            Explore <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Two Small Cards --}}
            <div class="col-lg-6 d-flex flex-column gap-3">
                <a href="{{ route('packages.show', 6) }}" class="package-card-sm text-decoration-none">
                    <img src="/images/gallery2.png" alt="Batik Workshop">
                    <div class="info">
                        <span class="package-tag">Workshop</span>
                        <h6 style="font-family:'Playfair Display',serif;color:var(--green-dark);margin:0.4rem 0 0.25rem">Batik Workshop</h6>
                        <p class="package-price mb-1">Rp 300.000 / person</p>
                        <p style="font-size:0.8rem;color:var(--text-muted);margin:0;line-height:1.5">Belajar membatik tulis tradisional bersama pengrajin lokal.</p>
                    </div>
                </a>
                <a href="{{ route('packages.show', 3) }}" class="package-card-sm text-decoration-none">
                    <img src="/images/gallery3.png" alt="Forest Trekking">
                    <div class="info">
                        <span class="package-tag" style="background:rgba(200,134,10,0.12);color:var(--gold)">Adventure</span>
                        <h6 style="font-family:'Playfair Display',serif;color:var(--green-dark);margin:0.4rem 0 0.25rem">Forest Trekking</h6>
                        <p class="package-price mb-1">Rp 350.000 / person</p>
                        <p style="font-size:0.8rem;color:var(--text-muted);margin:0;line-height:1.5">Jelajahi hutan tropis Gunung Wilis dipandu ranger lokal.</p>
                    </div>
                </a>
                <div class="text-end mt-2">
                    <a href="{{ route('packages') }}" class="btn-explore text-decoration-none">
                        Lihat Semua Paket <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
