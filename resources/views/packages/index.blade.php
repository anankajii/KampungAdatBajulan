@extends('layouts.app')

@section('title', 'Paket Wisata – Kampung Adat Bajulan')

@section('head')
<style>
    /* Override navbar active state for packages page */
    body { background: #f5f0e6; }

    /* Hero packages */
    .pkg-hero {
        padding: 8rem 0 4rem;
        background: #f5f0e6;
    }
    .pkg-badge {
        display: inline-block;
        background: #d4e6a0;
        color: #3a5a1a;
        border-radius: 50px;
        padding: 0.3rem 1rem;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }
    .pkg-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 3.2rem);
        color: var(--green-dark);
        line-height: 1.15;
        margin-bottom: 1rem;
    }
    .pkg-hero p {
        color: var(--text-muted);
        font-size: 0.95rem;
        max-width: 520px;
        line-height: 1.7;
    }

    /* Filter tabs */
    .filter-tabs { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 2rem; }
    .filter-tab {
        background: #fff;
        color: var(--text-dark);
        border: 1.5px solid rgba(0,0,0,0.1);
        border-radius: 50px;
        padding: 0.4rem 1.1rem;
        font-size: 0.82rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .filter-tab:hover,
    .filter-tab.active {
        background: var(--green-dark);
        color: #fff;
        border-color: var(--green-dark);
    }

    /* Package cards */
    .packages-section { padding: 3rem 0 5rem; background: #f5f0e6; }
    .pkg-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 3px 15px rgba(0,0,0,0.07);
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .pkg-card:hover { transform: translateY(-6px); box-shadow: 0 15px 40px rgba(0,0,0,0.12); }
    .pkg-card-img {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .pkg-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .pkg-card:hover .pkg-card-img img { transform: scale(1.05); }
    .pkg-card-tag {
        position: absolute;
        top: 1rem;
        left: 1rem;
        border-radius: 50px;
        padding: 0.2rem 0.8rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #fff;
    }
    .pkg-card-body { padding: 1.4rem; flex: 1; display: flex; flex-direction: column; }
    .pkg-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }
    .pkg-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.08rem;
        color: var(--green-dark);
        margin: 0;
        line-height: 1.3;
    }
    .pkg-price {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--green-dark);
        white-space: nowrap;
        margin-left: 0.5rem;
    }
    .pkg-price span { font-size: 0.72rem; font-weight: 400; color: var(--text-muted); }
    .pkg-desc {
        font-size: 0.83rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;

        /* Clamp to 2 lines */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .pkg-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.78rem;
        color: #888;
        margin-bottom: 1rem;
    }
    .pkg-meta span { display: flex; align-items: center; gap: 0.3rem; }
    .btn-view {
        display: block;
        text-align: center;
        background: var(--green-dark);
        color: #fff;
        border-radius: 10px;
        padding: 0.65rem 1rem;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-view:hover { background: var(--green-mid); color: #fff; }

    /* CTA Banner */
    .pkg-cta {
        background: var(--green-dark);
        border-radius: 20px;
        padding: 3rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin: 0 0 5rem;
    }
    .pkg-cta h3 { font-family: 'Playfair Display', serif; color: #fff; font-size: 1.6rem; margin-bottom: 0.5rem; }
    .pkg-cta p { color: rgba(255,255,255,0.7); font-size: 0.9rem; margin: 0; }
    .btn-enquire {
        background: transparent;
        color: #fff;
        border: 2px solid rgba(255,255,255,0.5);
        border-radius: 50px;
        padding: 0.6rem 1.6rem;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-enquire:hover { background: rgba(255,255,255,0.1); color: #fff; border-color: #fff; }
    .btn-download {
        background: #fff;
        color: var(--green-dark);
        border-radius: 50px;
        padding: 0.6rem 1.6rem;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-download:hover { background: #f0f0f0; color: var(--green-dark); }
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="pkg-hero">
    <div class="container">
        <span class="pkg-badge"><i class="bi bi-stars me-1"></i> Pengalaman Desa</span>
        <h1>Perjalanan Autentik ke<br>Warisan Budaya Jawa</h1>
        <p>Temukan jiwa Kampung Adat Bajulan melalui pengalaman pilihan kami, dirancang untuk menyelami tradisi berabad-abad dan keindahan alam yang asri.</p>

        {{-- Filter Tabs --}}
        <div class="filter-tabs">
            <a href="{{ route('packages') }}"
               class="filter-tab {{ !$activeTag ? 'active' : '' }}">Semua Paket</a>
            <a href="{{ route('packages', ['tag' => 'Budaya']) }}"
               class="filter-tab {{ $activeTag === 'Budaya' ? 'active' : '' }}">Budaya</a>
            <a href="{{ route('packages', ['tag' => 'Alam']) }}"
               class="filter-tab {{ $activeTag === 'Alam' ? 'active' : '' }}">Alam</a>
            <a href="{{ route('packages', ['tag' => 'Ritual']) }}"
               class="filter-tab {{ $activeTag === 'Ritual' ? 'active' : '' }}">Ritual</a>
            <a href="{{ route('packages', ['tag' => 'Kuliner']) }}"
               class="filter-tab {{ $activeTag === 'Kuliner' ? 'active' : '' }}">Kuliner</a>
            <a href="{{ route('packages', ['tag' => 'Petualangan']) }}"
               class="filter-tab {{ $activeTag === 'Petualangan' ? 'active' : '' }}">Petualangan</a>
        </div>
    </div>
</div>

{{-- PACKAGES GRID --}}
<section class="packages-section">
    <div class="container">
        <div class="row g-4">
            @foreach($packages as $pkg)
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="pkg-card">
                    <div class="pkg-card-img">
                        <img src="{{ $pkg['img'] }}" alt="{{ $pkg['title'] }}" loading="lazy">
                        <span class="pkg-card-tag" style="background:{{ $pkg['tag_color'] }}">{{ $pkg['tag'] }}</span>
                    </div>
                    <div class="pkg-card-body">
                        <div class="pkg-title-row">
                            <h5 class="pkg-title">{{ $pkg['title'] }}</h5>
                            <div class="pkg-price">{{ $pkg['price_label'] ?? 'Rp '.number_format($pkg['price'], 0, ',', '.') }}</div>
                        </div>
                        <p class="pkg-desc">{{ $pkg['desc'] }}</p>
                        <div class="pkg-meta">
                            <span><i class="bi bi-clock"></i> {{ $pkg['duration'] }}</span>
                            <span><i class="bi bi-people"></i> {{ $pkg['group'] ?? '' }}</span>
                        </div>
                        <a href="{{ route('packages.show', $pkg['id']) }}" class="btn-view">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA Banner --}}
        <div class="pkg-cta mt-5 fade-up">
            <div>
                <h3>Ingin pengalaman yang disesuaikan?</h3>
                <p>Sesepuh desa kami dapat merancang perjalanan khusus sesuai minat dan jumlah rombongan Anda.</p>
            </div>
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ url('/#contact') }}" class="btn-enquire">Hubungi Kami</a>
                <a href="{{ asset('images/Kampung-Adat-Bajulan-Brochure.png') }}" 
                   class="btn-download" id="btnUnduhBrosur" target="_blank" rel="noopener" download="Brosur-Kampung-Adat-Bajulan.png">
                    <i class="bi bi-download me-1"></i>Unduh Brosur
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
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

// ── Notifikasi unduh brosur ──
document.getElementById('btnUnduhBrosur').addEventListener('click', function () {
    // Buat toast
    var toast = document.createElement('div');
    toast.innerHTML = '<i class="bi bi-arrow-down-circle-fill me-2"></i>Sedang mengunduh brosur...';
    toast.style.cssText = [
        'position:fixed',
        'bottom:5rem',
        'left:50%',
        'transform:translateX(-50%) translateY(20px)',
        'background:#1e3a1e',
        'color:#fff',
        'padding:0.75rem 1.4rem',
        'border-radius:50px',
        'font-size:0.88rem',
        'font-weight:600',
        'box-shadow:0 8px 24px rgba(0,0,0,0.2)',
        'z-index:99999',
        'opacity:0',
        'transition:opacity 0.3s ease, transform 0.3s ease',
        'white-space:nowrap',
        'pointer-events:none',
    ].join(';');

    document.body.appendChild(toast);

    // Fade in
    requestAnimationFrame(function () {
        requestAnimationFrame(function () {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(-50%) translateY(0)';
        });
    });

    // Fade out setelah 3 detik
    setTimeout(function () {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(-50%) translateY(20px)';
        setTimeout(function () { toast.remove(); }, 350);
    }, 3000);
});
</script>
@endsection
