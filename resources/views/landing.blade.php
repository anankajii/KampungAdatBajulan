@extends('layouts.app')

@section('title', 'Kampung Adat Bajulan – Wisata Budaya, Alam & Tradisi')



@section('content')


<section id="home">

    <div class="container">
        <div class="row align-items-center min-vh-100 py-5">

            <div class="col-lg-7 hero-content py-5 mt-5">

                <div class="hero-badge">
                    <i class="bi bi-geo-alt-fill me-1"></i>
                    Nganjuk, Jawa Timur
                </div>

                <h1 class="hero-title">
                    Kampung Adat <br>
                    <span style="color:#f5d27a">Bajulan</span>
                </h1>

                <p class="hero-subtitle mt-3">
                    Experience Culture, Tradition, and Nature
                </p>

                <p class="mt-2 text-light" style="max-width:480px">
                    Selamat datang di desa wisata budaya yang memadukan
                    kearifan lokal, alam pegunungan, dan tradisi leluhur
                    yang masih terjaga di kaki Gunung Wilis.
                </p>

                
                <div class="d-flex flex-wrap gap-3 mt-4">

                    <a href="#tourism" class="btn btn-warning px-4 py-2">
                        <i class="bi bi-compass-fill me-2"></i>
                        Explore Tourism
                    </a>

                    <a href="#booking" class="btn btn-outline-light px-4 py-2">
                        <i class="bi bi-calendar-check me-2"></i>
                        Book Visit
                    </a>

                </div>

            </div>

            <!-- <div class="col-lg-4 offset-lg-1 hero-content d-none d-lg-block">
                <div class="hero-stats p-4 rounded" style="background:rgba(0,0,0,0.45);">

                    <div class="row g-3 text-center">

                        <div class="col-4">
                            <div class="stat-number">5+</div>
                            <div class="stat-label">Destinasi</div>
                        </div>

                        <div class="col-4">
                            <div class="stat-number">3K+</div>
                            <div class="stat-label">Pengunjung</div>
                        </div>

                        <div class="col-4">
                            <div class="stat-number">12+</div>
                            <div class="stat-label">Event / Tahun</div>
                        </div>

                    </div>

                </div>
            </div> -->

        </div>
    </div>

</section>

{{-- ══════════════════════════════════════
     2. ABOUT
════════════════════════════════════════ --}}
<section id="about" class="py-6" style="padding: 6rem 0">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 fade-up">
                <div class="about-img-wrap">
                    <img src="/images/about.png" alt="Kampung Adat Bajulan">
                    <div class="about-badge-float">
                        <strong>1985</strong>
                        <span style="font-size:.75rem;opacity:.8">Berdiri sejak</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 fade-up">
                <p class="section-label">Tentang Kami</p>
                <h2 class="section-heading text-start mb-4" style="font-size:2rem">
                    Mengenal Kampung Adat Bajulan
                </h2>
                <p class="text-muted lh-lg mt-4">
                    Kampung Adat Bajulan adalah sebuah desa wisata yang terletak di lereng Gunung Wilis, Kecamatan Loceret, Kabupaten Nganjuk, Jawa Timur. Desa ini menjadi surga tersembunyi yang mewarisi tradisi adat Jawa yang kaya — mulai dari rumah joglo berukir, seni pertunjukan tradisional, hingga upacara adat yang masih rutin digelar hingga kini.
                </p>
                <p class="text-muted lh-lg">
                    Bukan hanya budaya, Bajulan juga menawarkan keindahan alam yang memukau: hutan tropis, kebun durian lokal, jalur pendakian, dan petualangan trabas yang tak terlupakan.
                </p>
                <div class="mt-4">
                    <div class="about-feature-item">
                        <div class="about-icon"><i class="bi bi-house-heart-fill"></i></div>
                        <div>
                            <strong style="color:var(--green-dark)">Warisan Budaya Leluhur</strong>
                            <p class="mb-0 text-muted" style="font-size:.88rem">Rumah adat, tradisi, dan seni pertunjukan Jawa yang autentik.</p>
                        </div>
                    </div>
                    <div class="about-feature-item">
                        <div class="about-icon"><i class="bi bi-tree-fill"></i></div>
                        <div>
                            <strong style="color:var(--green-dark)">Alam Pegunungan Wilis</strong>
                            <p class="mb-0 text-muted" style="font-size:.88rem">Udara segar, pemandangan hijau, dan jalur alam yang eksotis.</p>
                        </div>
                    </div>
                    <div class="about-feature-item">
                        <div class="about-icon"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <strong style="color:var(--green-dark)">Komunitas Ramah & Hangat</strong>
                            <p class="mb-0 text-muted" style="font-size:.88rem">Masyarakat lokal yang terbuka menyambut setiap wisatawan.</p>
                        </div>
                    </div>
                </div>
                <a href="#tourism" class="btn-explore text-decoration-none d-inline-block mt-2">
                    Jelajahi Wisata <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     3. TOURISM HIGHLIGHTS
════════════════════════════════════════ --}}
<section id="tourism" class="py-5" style="padding: 5rem 0 !important; background:#fff">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <p class="section-label">Destinasi Wisata</p>
            <h2 class="section-heading">Tourism Highlights</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width:560px;font-size:.95rem">
                Temukan beragam pengalaman wisata unik yang hanya bisa kamu rasakan di Kampung Adat Bajulan.
            </p>
        </div>
        <div class="row g-4">
            @php
            $tourisms = [
                [
                    'icon'  => 'bi-house-door-fill',
                    'color' => '#2d6a4f',
                    'title' => 'Kampung Adat',
                    'img'   => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=600&q=80',
                    'desc'  => 'Nikmati kehidupan autentik kampung adat dengan rumah joglo, ritual adat, dan kearifan lokal yang terjaga selama generasi.',
                ],
                [
                    'icon'  => 'bi-music-note-beamed',
                    'color' => '#8b5e3c',
                    'title' => 'Budaya & Seni',
                    'img'   => '/images/gallery1.png',
                    'desc'  => 'Saksikan pertunjukan seni tari Jawa, wayang kulit, gamelan, dan berbagai kesenian tradisional yang memukau.',
                ],
                [
                    'icon'  => 'bi-flower1',
                    'color' => '#d4a017',
                    'title' => 'Edukasi Durian',
                    'img'   => '/images/gallery2.png',
                    'desc'  => 'Belajar budidaya durian lokal unggul langsung di kebun, petik buah, dan icip durian segar langsung dari pohonnya.',
                ],
                [
                    'icon'  => 'bi-geo-alt-fill',
                    'color' => '#1b4332',
                    'title' => 'Pendakian',
                    'img'   => '/images/gallery3.png',
                    'desc'  => 'Taklukkan jalur pendakian Gunung Wilis yang melegenda dengan pemandangan sunrise dan lautan awan yang memukau.',
                ],
                [
                    'icon'  => 'bi-bicycle',
                    'color' => '#c0392b',
                    'title' => 'Trabas Lingkar Wilis',
                    'img'   => '/images/gallery4.png',
                    'desc'  => 'Rasakan sensasi trabas off-road mengelilingi kaki Gunung Wilis menembus jalur berlumpur, sungai, dan hutan tropis.',
                ],
            ];
            @endphp

            @foreach($tourisms as $t)
            <div class="col-lg col-md-6 fade-up">
                <div class="tourism-card card">
                    <img src="{{ $t['img'] }}" class="card-img-top" alt="{{ $t['title'] }}" loading="lazy">
                    <div class="card-body">
                       <div class="tourism-icon-badge"
     style="--color: {{ $t['color'] }};">
                            <i class="bi {{ $t['icon'] }}"></i>
                        </div>
                        <h5 class="card-title">{{ $t['title'] }}</h5>
                        <p class="card-text">{{ $t['desc'] }}</p>
                        <a href="#booking" class="btn-explore text-decoration-none d-inline-block mt-1">
                            Explore <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     4. CULTURAL EVENTS
════════════════════════════════════════ --}}
<section id="events" style="padding: 5rem 0;background:var(--cream)">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <p class="section-label">Agenda</p>
            <h2 class="section-heading">Cultural Events</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width:540px;font-size:.95rem">
                Jadwal event budaya dan ritual adat di Kampung Adat Bajulan yang bisa kamu saksikan langsung.
            </p>
        </div>
        <div class="row g-4">
            @php
            $events = [
                [
                    'day'   => '15',
                    'month' => 'Mar',
                    'year'  => '2026',
                    'tag'   => 'Upacara Adat',
                    'title' => 'Sedekah Bumi Bajulan',
                    'desc'  => 'Ritual tahunan ungkapan syukur masyarakat atas hasil bumi yang melimpah, diiringi pertunjukan wayang dan gamelan live.',
                    'img'   => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&q=80',
                    'time'  => '08.00 – Selesai',
                    'loc'   => 'Lapangan Desa Bajulan',
                ],
                [
                    'day'   => '05',
                    'month' => 'Apr',
                    'year'  => '2026',
                    'tag'   => 'Festival',
                    'title' => 'Festival Durian Wilis',
                    'desc'  => 'Pesta durian lokal terbesar di Nganjuk dengan lomba makan durian, pameran kuliner, dan konser musik tradisional.',
                    'img'   => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&q=80',
                    'time'  => '09.00 – 17.00',
                    'loc'   => 'Kebun Durian Desa Bajulan',
                ],
                [
                    'day'   => '21',
                    'month' => 'Apr',
                    'year'  => '2026',
                    'tag'   => 'Seni Pertunjukan',
                    'title' => 'Pagelaran Wayang Kulit',
                    'desc'  => 'Malam kesenian wayang kulit semalam suntuk oleh dalang ternama dengan lakon pilihan masyarakat desa Bajulan.',
                    'img'   => 'https://images.unsplash.com/photo-1526314114033-349ef6f72220?w=600&q=80',
                    'time'  => '20.00 – Fajar',
                    'loc'   => 'Pendopo Desa Bajulan',
                ],
                [
                    'day'   => '10',
                    'month' => 'Mei',
                    'year'  => '2026',
                    'tag'   => 'Petualangan',
                    'title' => 'Trabas Open Lingkar Wilis',
                    'desc'  => 'Event trabas off-road terbuka mengelilingi lereng Gunung Wilis, terbuka untuk semua pecinta motor trail.',
                    'img'   => '/images/gallery4.png',
                    'time'  => '06.00 – 15.00',
                    'loc'   => 'Start: Balai Desa Bajulan',
                ],
            ];
            @endphp

            @foreach($events as $ev)
            <div class="col-lg-3 col-md-6 fade-up">
                <div class="event-card card">
                    <img src="{{ $ev['img'] }}" class="event-img" alt="{{ $ev['title'] }}" loading="lazy">
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-stretch flex-grow-1">
                            <div class="event-date-badge">
                                <div class="month">{{ $ev['month'] }}</div>
                                <div class="day">{{ $ev['day'] }}</div>
                                <div class="month">{{ $ev['year'] }}</div>
                            </div>
                            <div class="p-3 flex-grow-1">
                                <span class="event-tag">{{ $ev['tag'] }}</span>
                                <h6 class="mt-2 mb-1" style="font-family:'Playfair Display',serif;color:var(--green-dark);font-size:1rem">{{ $ev['title'] }}</h6>
                                <p class="text-muted mb-2" style="font-size:.82rem;line-height:1.5">{{ $ev['desc'] }}</p>
                                <div class="d-flex flex-column gap-1" style="font-size:.78rem;color:#555">
                                    <span><i class="bi bi-clock me-1" style="color:var(--green-mid)"></i>{{ $ev['time'] }}</span>
                                    <span><i class="bi bi-geo-alt me-1" style="color:var(--green-mid)"></i>{{ $ev['loc'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     5. GALLERY
════════════════════════════════════════ --}}
<section id="gallery" style="padding: 5rem 0">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <p class="section-label">Foto</p>
            <h2 class="section-heading" style="color:#fff">Our Gallery</h2>
            <p style="color:rgba(255,255,255,.65);margin-top:.75rem;font-size:.95rem;max-width:500px;margin-left:auto;margin-right:auto">
                Sekilas keindahan dan suasana Kampung Adat Bajulan melalui lensa.
            </p>
        </div>
        <div class="gallery-grid fade-up">
            <div class="gallery-item">
                <img src="/images/hero.png" alt="Panorama Bajulan" loading="lazy">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="/images/gallery1.png" alt="Tari Tradisional" loading="lazy">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="/images/about.png" alt="Rumah Adat" loading="lazy">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="/images/gallery2.png" alt="Edukasi Durian" loading="lazy">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="/images/gallery3.png" alt="Pendakian Wilis" loading="lazy">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="/images/gallery4.png" alt="Trabas Wilis" loading="lazy">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     6. BOOKING CTA
════════════════════════════════════════ --}}
<section id="booking" style="padding: 6rem 0">
    <div class="booking-pattern"></div>
    <div class="container" style="position:relative;z-index:2">
        <div class="row justify-content-center text-center text-white fade-up">
            <div class="col-lg-8">
                <p class="section-label" style="color:var(--gold)">Reservasi Wisata</p>
                <h2 class="section-heading" style="color:#fff;font-size:2.5rem">
                    Siap Berpetualang di Bajulan?
                </h2>
                <p style="color:rgba(255,255,255,.7);margin-top:1rem;font-size:1rem;max-width:560px;margin-left:auto;margin-right:auto;line-height:1.7">
                    Rencanakan kunjunganmu sekarang! Kami menyediakan paket wisata lengkap, pemandu lokal berpengalaman, dan akomodasi yang nyaman untuk pengalaman tak terlupakan.
                </p>
                <div class="d-flex justify-content-center flex-wrap gap-3 mt-2 mb-4" style="font-size:.85rem">
                    <div class="booking-feature"><i class="bi bi-check-circle-fill" style="color:var(--green-light)"></i> Pemandu Lokal Tersertifikasi</div>
                    <div class="booking-feature"><i class="bi bi-check-circle-fill" style="color:var(--green-light)"></i> Akomodasi Nyaman</div>
                    <div class="booking-feature"><i class="bi bi-check-circle-fill" style="color:var(--green-light)"></i> Paket Fleksibel</div>
                    <div class="booking-feature"><i class="bi bi-check-circle-fill" style="color:var(--green-light)"></i> Harga Terjangkau</div>
                </div>
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <a href="https://wa.me/6281234567890?text=Halo%2C+saya+ingin+booking+wisata+Kampung+Adat+Bajulan"
                       class="btn-cta-book text-decoration-none" target="_blank">
                        <i class="bi bi-calendar-check me-2"></i>Book Visit Sekarang
                    </a>
                    <a href="#contact" class="btn-cta-outline text-decoration-none">
                        <i class="bi bi-headset me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     7. CONTACT
════════════════════════════════════════ --}}
<section id="contact" style="padding: 5rem 0;background:#fff">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <p class="section-label">Hubungi Kami</p>
            <h2 class="section-heading">Contact & Location</h2>
        </div>
        <div class="row g-4 fade-up">
            {{-- Map --}}
            <div class="col-lg-7">
                <div class="map-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.063!2d111.8823!3d-7.7234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5c3b2f0e1d59%3A0x11b1a6f5a52bc7b7!2sBajulan%2C%20Loceret%2C%20Nganjuk%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1610000000000!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Kampung Adat Bajulan">
                    </iframe>
                </div>
            </div>
            {{-- Contact Info --}}
            <div class="col-lg-5">
                <div class="contact-info-card">
                    <h5 style="font-family:'Playfair Display',serif;color:var(--green-dark);margin-bottom:1.5rem">Informasi Kontak</h5>
                    <div class="mb-4">
                        <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <strong style="color:var(--green-dark);font-size:.9rem">Alamat</strong>
                        <p class="text-muted mb-0" style="font-size:.88rem;margin-top:.3rem">
                            Dusun Bajulan, Desa Bajulan<br>
                            Kec. Loceret, Kab. Nganjuk<br>
                            Jawa Timur 64471
                        </p>
                    </div>
                    <div class="mb-4">
                        <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                        <strong style="color:var(--green-dark);font-size:.9rem">Telepon / WhatsApp</strong>
                        <p class="text-muted mb-0" style="font-size:.88rem;margin-top:.3rem">
                            <a href="tel:+6281234567890" style="color:inherit;text-decoration:none">+62 812-3456-7890</a><br>
                            <a href="tel:+6285678901234" style="color:inherit;text-decoration:none">+62 856-7890-1234</a>
                        </p>
                    </div>
                    <div class="mb-4">
                        <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                        <strong style="color:var(--green-dark);font-size:.9rem">Email</strong>
                        <p class="text-muted mb-0" style="font-size:.88rem;margin-top:.3rem">
                            <a href="mailto:info@bajulan.id" style="color:inherit;text-decoration:none">info@bajulan.id</a>
                        </p>
                    </div>
                    <div>
                        <strong style="color:var(--green-dark);font-size:.9rem">Ikuti Kami</strong>
                        <div class="d-flex gap-2 mt-2">
                            <a href="#" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                            <a href="#" class="social-link" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                            <a href="https://wa.me/6281234567890" class="social-link" aria-label="WhatsApp" target="_blank"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
// Scroll-reveal: add hidden class after first paint so elements render first
requestAnimationFrame(() => {
    document.body.classList.add('no-js-fade');
    const fadeEls = document.querySelectorAll('.fade-up');
    const io = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.10 });
    fadeEls.forEach(el => io.observe(el));
});
</script>
@endsection
