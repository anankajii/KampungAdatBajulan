<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="description" content="Kampung Adat Bajulan – Wisata budaya, alam, dan tradisi di kaki Gunung Wilis, Jawa Timur.">
    <title>@yield('title', 'Kampung Adat Bajulan')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('head')
</head>
<body>

    <!-- ══ NAVBAR ══ -->
    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <span style="width:30px;height:30px;background:var(--green-dark);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                    <i class="bi bi-tree-fill text-white" style="font-size:0.9rem"></i>
                </span>
                Bajulan
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4" style="color:var(--green-dark)"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/#events') }}">Acara</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('packages') ? 'active' : '' }}" href="{{ route('packages') }}">Paket Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/#gallery') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('homestay') ? 'active' : '' }}" href="{{ route('homestay') }}">Homestay</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link btn-book" style="color:#fff !important" href="{{ route('packages') }}">Pesan Sekarang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ══ PAGE CONTENT ══ -->
    @yield('content')

    <!-- ══ FOOTER ══ -->
    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span style="width:32px;height:32px;background:var(--gold);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                            <i class="bi bi-tree-fill text-white" style="font-size:0.9rem"></i>
                        </span>
                        <span class="footer-heading mb-0">Bajulan</span>
                    </div>
                    <p style="font-size:0.88rem;line-height:1.7">
                        Desa wisata budaya dan alam di kaki Gunung Wilis, Kabupaten Nganjuk, Jawa Timur. Pengalaman autentik yang tak terlupakan.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <p class="footer-heading">Jelajahi</p>
                    <ul class="list-unstyled" style="font-size:0.88rem">
                        <li class="mb-2"><a href="#home">Beranda</a></li>
                        <li class="mb-2"><a href="#about">Tentang</a></li>
                        <li class="mb-2"><a href="#tourism">Paket Wisata</a></li>
                        <li class="mb-2"><a href="#events">Acara</a></li>
                        <li class="mb-2"><a href="#gallery">Galeri</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <p class="footer-heading">Tradisi Budaya</p>
                    <ul class="list-unstyled" style="font-size:0.88rem">
                        <li class="mb-2"><a href="#tourism">Kampung Adat</a></li>
                        <li class="mb-2"><a href="#tourism">Budaya & Seni</a></li>
                        <li class="mb-2"><a href="#tourism">Edukasi Durian</a></li>
                        <li class="mb-2"><a href="#tourism">Pendakian</a></li>
                        <li class="mb-2"><a href="#tourism">Trabas Wilis</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <p class="footer-heading">Kontak</p>
                    <ul class="list-unstyled" style="font-size:0.88rem">
                        <li class="mb-2 d-flex gap-2">
                            <i class="bi bi-geo-alt-fill mt-1" style="color:var(--gold);min-width:14px"></i>
                            <span>Bajulan, Loceret, Nganjuk, Jawa Timur 64471</span>
                        </li>
                        <li class="mb-2 d-flex gap-2">
                            <i class="bi bi-telephone-fill mt-1" style="color:var(--gold);min-width:14px"></i>
                            <a href="tel:+6281234567890">+62 812-3456-7890</a>
                        </li>
                        <li class="mb-2 d-flex gap-2">
                            <i class="bi bi-envelope-fill mt-1" style="color:var(--gold);min-width:14px"></i>
                            <a href="mailto:info@bajulan.id">info@bajulan.id</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,0.12);margin-top:2.5rem">

            {{-- Logo Partner --}}
            <div class="d-flex flex-wrap align-items-center justify-content-center gap-4 py-3">
                <p class="mb-0 me-2" style="font-size:0.75rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.1em">
                    Didukung oleh
                </p>
                <img src="{{ asset('images/dispora.png') }}"
                     alt="Dinas Pemuda dan Olahraga"
                     style="height:72px;object-fit:contain;filter:brightness(0) invert(1);opacity:0.7;transition:opacity 0.2s"
                     onmouseover="this.style.opacity='1'"
                     onmouseout="this.style.opacity='0.7'">
                <img src="{{ asset('images/polije.png') }}"
                     alt="Politeknik Negeri Jember"
                     style="height:72px;object-fit:contain;filter:brightness(0) invert(1);opacity:0.7;transition:opacity 0.2s"
                     onmouseover="this.style.opacity='1'"
                     onmouseout="this.style.opacity='0.7'">
            </div>

            <hr style="border-color:rgba(255,255,255,0.12);margin:0">
            <p class="text-center mb-0 pt-3" style="font-size:0.8rem;color:rgba(255,255,255,0.45)">
                &copy; {{ date('Y') }} Kampung Adat Bajulan. Hak cipta dilindungi.
            </p>
        </div>
    </footer>

    <!-- ══ WHATSAPP FLOAT ══ -->
    <a href="https://wa.me/6281234567890?text=Halo%2C+saya+ingin+info+wisata+Kampung+Adat+Bajulan" class="whatsapp-float" target="_blank" aria-label="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span class="wa-tooltip">Chat dengan kami!</span>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- iOS Safari: blokir overscroll bounce & horizontal pan --}}
    <script>
    (function () {
        var lastY = 0;

        document.addEventListener('touchstart', function (e) {
            lastY = e.touches[0].clientY;
        }, { passive: true });

        document.addEventListener('touchmove', function (e) {
            // Izinkan multi-touch (pinch) agar tidak crash, tapi blokir zoom
            if (e.touches.length > 1) {
                e.preventDefault();
                return;
            }

            var currentY  = e.touches[0].clientY;
            var currentX  = e.touches[0].clientX;
            var startX    = e.touches[0].clientX;
            var dy        = currentY - lastY;
            var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            var maxScroll = document.documentElement.scrollHeight - window.innerHeight;

            // Blokir bounce di ujung atas
            if (dy > 0 && scrollTop <= 0) {
                e.preventDefault();
                return;
            }
            // Blokir bounce di ujung bawah
            if (dy < 0 && scrollTop >= maxScroll) {
                e.preventDefault();
                return;
            }

        }, { passive: false });

        // Blokir gesturestart (pinch-zoom iOS Safari)
        document.addEventListener('gesturestart', function (e) {
            e.preventDefault();
        }, { passive: false });

        document.addEventListener('gesturechange', function (e) {
            e.preventDefault();
        }, { passive: false });

        document.addEventListener('gestureend', function (e) {
            e.preventDefault();
        }, { passive: false });
    })();
    </script>

    <script>
        const nav = document.getElementById('mainNav');
        // Halaman non-landing: langsung pakai style scrolled (teks gelap)
        const isLanding = document.getElementById('home') !== null;
        if (!isLanding) {
            nav.classList.add('scrolled');
        }
        window.addEventListener('scroll', () => {
            if (isLanding) {
                nav.classList.toggle('scrolled', window.scrollY > 60);
            }
        });
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const target = document.querySelector(a.getAttribute('href'));
                if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
            });
        });
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('#navMenu .nav-link');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    const active = document.querySelector(`#navMenu a[href="#${entry.target.id}"]`);
                    if (active) active.classList.add('active');
                }
            });
        }, { threshold: 0.4 });
        sections.forEach(s => observer.observe(s));
    </script>

    @yield('scripts')
</body>
</html>
