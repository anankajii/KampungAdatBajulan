<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kampung Adat Bajulan – Wisata budaya, alam, dan tradisi di kaki Gunung Wilis, Jawa Timur.">
    <title>@yield('title', 'Kampung Adat Bajulan')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-dark:  #1b4332;
            --green-mid:   #2d6a4f;
            --green-light: #52b788;
            --gold:        #d4a017;
            --cream:       #fdf8f0;
            --text-dark:   #1a1a2e;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background: #fff;
        }

        h1, h2, h3, .brand-font { font-family: 'Playfair Display', serif; }

        /* ── NAVBAR ── */
        #mainNav {
            background: transparent;
            transition: background .35s ease, padding .35s ease, box-shadow .35s ease;
            padding: 1.2rem 0;
        }
        #mainNav.scrolled {
            background: var(--green-dark) !important;
            padding: .6rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,.3);
        }
        #mainNav .navbar-brand { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: #fff !important; }
        #mainNav .nav-link { color: rgba(255,255,255,.88) !important; font-weight: 500; letter-spacing: .03em; transition: color .2s; }
        #mainNav .nav-link:hover { color: var(--gold) !important; }
        #mainNav .nav-link.active { color: var(--gold) !important; }
        .btn-book {
            background: var(--gold);
            color: #fff !important;
            border-radius: 50px;
            padding: .4rem 1.2rem;
            font-weight: 600;
            transition: background .2s, transform .15s;
        }
        .btn-book:hover { background: #b8860b; transform: translateY(-1px); }

        /* ── SECTION HELPERS ── */
        .section-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            color: var(--green-dark);
            position: relative;
            display: inline-block;
            margin-bottom: 0;
        }
        .section-heading::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--gold);
            border-radius: 2px;
            margin: .5rem auto 0;
        }
        .section-label {
            text-transform: uppercase;
            letter-spacing: .15em;
            font-size: .8rem;
            font-weight: 600;
            color: var(--green-light);
        }

        /* ── CARDS ── */
        .card-hover {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 20px 45px rgba(0,0,0,.13); }

        /* ── FOOTER ── */
        footer {
            background: var(--green-dark);
            color: rgba(255,255,255,.75);
        }
        footer a { color: rgba(255,255,255,.65); text-decoration: none; transition: color .2s; }
        footer a:hover { color: var(--gold); }
        footer .footer-heading { color: #fff; font-family: 'Playfair Display', serif; font-size: 1.1rem; margin-bottom: 1rem; }

        /* ── WHATSAPP FLOAT ── */
        .whatsapp-float {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 9999;
            background: #25D366;
            color: #fff;
            width: 58px; height: 58px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 6px 20px rgba(37,211,102,.45);
            transition: transform .25s, box-shadow .25s;
        }
        .whatsapp-float:hover { transform: scale(1.1); box-shadow: 0 10px 30px rgba(37,211,102,.6); color: #fff; }
        .whatsapp-float .wa-tooltip {
            position: absolute;
            right: 70px;
            background: #fff;
            color: #333;
            font-size: .8rem;
            font-weight: 600;
            padding: .35rem .75rem;
            border-radius: 20px;
            white-space: nowrap;
            box-shadow: 0 2px 10px rgba(0,0,0,.12);
            opacity: 0; pointer-events: none;
            transition: opacity .2s;
        }
        .whatsapp-float:hover .wa-tooltip { opacity: 1; }

        @yield('styles')
    </style>
    @yield('head')
</head>
<body>

    <!-- ══ NAVBAR ══ -->
    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-tree-fill me-2" style="color:var(--gold)"></i>Kampung Adat Bajulan
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list text-white fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tourism">Tourism</a></li>
                    <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-lg-2"><a class="nav-link btn-book" href="#booking">Book Visit</a></li>
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
                    <p class="footer-heading"><i class="bi bi-tree-fill me-2" style="color:var(--gold)"></i>Kampung Adat Bajulan</p>
                    <p style="font-size:.9rem">Desa wisata budaya dan alam di kaki Gunung Wilis, Kabupaten Nganjuk, Jawa Timur.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube fs-5"></i></a>
                        <a href="#" aria-label="TikTok"><i class="bi bi-tiktok fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <p class="footer-heading">Menu</p>
                    <ul class="list-unstyled" style="font-size:.9rem">
                        <li class="mb-1"><a href="#home">Home</a></li>
                        <li class="mb-1"><a href="#about">About</a></li>
                        <li class="mb-1"><a href="#tourism">Tourism</a></li>
                        <li class="mb-1"><a href="#events">Events</a></li>
                        <li class="mb-1"><a href="#gallery">Gallery</a></li>
                        <li class="mb-1"><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <p class="footer-heading">Wisata</p>
                    <ul class="list-unstyled" style="font-size:.9rem">
                        <li class="mb-1"><a href="#tourism">Kampung Adat</a></li>
                        <li class="mb-1"><a href="#tourism">Budaya &amp; Seni</a></li>
                        <li class="mb-1"><a href="#tourism">Edukasi Durian</a></li>
                        <li class="mb-1"><a href="#tourism">Pendakian</a></li>
                        <li class="mb-1"><a href="#tourism">Trabas Lingkar Wilis</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <p class="footer-heading">Kontak</p>
                    <ul class="list-unstyled" style="font-size:.9rem">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2" style="color:var(--gold)"></i>Bajulan, Loceret, Nganjuk, Jawa Timur</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill me-2" style="color:var(--gold)"></i>+62 812-3456-7890</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2" style="color:var(--gold)"></i>info@bajulan.id</li>
                    </ul>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,.15);margin-top:2rem">
            <p class="text-center mb-0" style="font-size:.82rem">&copy; {{ date('Y') }} Kampung Adat Bajulan. All rights reserved.</p>
        </div>
    </footer>

    <!-- ══ WHATSAPP FLOAT ══ -->
    <a href="https://wa.me/6281234567890?text=Halo%2C+saya%20ingin%20info%20wisata%20Kampung%20Adat%20Bajulan" class="whatsapp-float" target="_blank" aria-label="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span class="wa-tooltip">Chat with us!</span>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar scroll effect -->
    <script>
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        });

        // Smooth scroll + active link highlight
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const target = document.querySelector(a.getAttribute('href'));
                if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
            });
        });

        // Intersection observer for active nav link
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
