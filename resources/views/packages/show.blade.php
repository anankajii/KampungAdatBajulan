@extends('layouts.app')

@section('title', $package['title'] . ' – Kampung Adat Bajulan')

@section('head')
<style>
    body { background: #f5f0e6; }

    /* Hero */
    .pkg-show-hero {
        position: relative;
        height: 420px;
        overflow: hidden;
    }
    .pkg-show-hero img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
    }
    .pkg-show-hero .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(10,25,10,0.80) 0%, rgba(10,25,10,0.3) 50%, transparent 100%);
    }
    .pkg-show-hero .hero-text {
        position: absolute;
        bottom: 2.5rem; left: 2.5rem;
        color: #fff;
        max-width: 600px;
    }
    .pkg-show-badge {
        display: inline-block;
        border-radius: 50px;
        padding: 0.25rem 0.9rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #fff;
        margin-bottom: 0.75rem;
    }
    .pkg-show-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.5rem, 3vw, 2.2rem);
        line-height: 1.2;
        margin-bottom: 0.5rem;
    }
    .pkg-show-hero p { font-size: 0.9rem; color: rgba(255,255,255,0.82); margin: 0; }

    /* Content */
    .pkg-show-section { padding: 3.5rem 0 5rem; }

    .pkg-meta-bar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
    }
    .pkg-meta-bar h2 {
        font-family: 'Playfair Display', serif;
        color: var(--green-dark);
        font-size: 1.5rem;
        margin-bottom: 0.3rem;
    }
    .pkg-loc { font-size: 0.85rem; color: var(--text-muted); }
    .pkg-loc i { color: var(--green-mid); }
    .pkg-starting { text-align: right; }
    .pkg-starting span { font-size: 0.72rem; color: var(--text-muted); display: block; text-transform: uppercase; letter-spacing: 0.08em; }
    .pkg-starting strong { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--green-dark); }
    .pkg-starting small { font-size: 0.78rem; color: var(--text-muted); }

    .pkg-desc p { font-size: 0.93rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 1rem; }

    /* Info boxes */
    .info-boxes { display: flex; gap: 0.75rem; flex-wrap: wrap; margin: 1.75rem 0; }
    .info-box {
        flex: 1; min-width: 140px;
        background: #fff;
        border-radius: 14px;
        padding: 1.1rem 1.2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .info-box i { font-size: 1.3rem; color: var(--green-mid); display: block; margin-bottom: 0.5rem; }
    .info-box .ib-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); }
    .info-box .ib-val { font-size: 0.88rem; font-weight: 600; color: var(--green-dark); margin-top: 0.2rem; }

    /* Includes */
    .includes-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: var(--green-dark);
        margin-bottom: 1rem;
    }
    .includes-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem 1.5rem; }
    .include-item {
        display: flex; align-items: center; gap: 0.6rem;
        font-size: 0.88rem; color: var(--text-muted);
    }
    .include-item i { color: var(--green-mid); font-size: 1rem; }

    /* Photo row */
    .photo-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 2rem; }
    .photo-row img { width: 100%; height: 220px; object-fit: cover; border-radius: 14px; }

    /* Sidebar */
    .pkg-sidebar {
        position: sticky;
        top: 90px;
    }
    .sidebar-card {
        background: #fff;
        border-radius: 18px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    }
    .sidebar-card h5 { font-family: 'Playfair Display', serif; color: var(--green-dark); font-size: 1.05rem; margin-bottom: 1rem; }
    .req-item {
        display: flex; gap: 0.7rem;
        font-size: 0.83rem; color: var(--text-muted);
        margin-bottom: 0.75rem;
        line-height: 1.5;
    }
    .req-item i { color: var(--green-mid); font-size: 1rem; min-width: 16px; margin-top: 2px; }

    .date-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 0.5rem; margin-top: 1.2rem; }
    .date-input {
        width: 100%;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 10px;
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        font-family: 'Inter', sans-serif;
        background: var(--cream);
        outline: none;
        transition: border-color 0.2s;
    }
    .date-input:focus { border-color: var(--green-mid); }

    .btn-book-now {
        display: block; width: 100%;
        background: var(--green-dark);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 0.9rem 1rem;
        font-size: 0.95rem;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        margin-top: 1.2rem;
        transition: background 0.2s;
        cursor: pointer;
    }
    .btn-book-now:hover { background: var(--green-mid); color: #fff; }

    .sidebar-secure { font-size: 0.75rem; color: var(--text-muted); text-align: center; margin-top: 0.75rem; }
    .sidebar-badges {
        display: flex; justify-content: center; gap: 1.5rem;
        margin-top: 1.2rem; padding-top: 1.2rem;
        border-top: 1px solid rgba(0,0,0,0.07);
    }
    .sidebar-badge { text-align: center; font-size: 0.7rem; color: var(--text-muted); }
    .sidebar-badge i { display: block; font-size: 1.3rem; color: var(--green-mid); margin-bottom: 0.3rem; }
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="pkg-show-hero" style="margin-top:62px">
    <img src="{{ $package['img'] }}" alt="{{ $package['title'] }}">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <span class="pkg-show-badge" style="background:{{ $package['tag_color'] }}">
            <i class="bi bi-stars me-1"></i>{{ $package['tag_label'] }}
        </span>
        <h1>{{ $package['subtitle'] }}</h1>
        <p>{{ $package['hero_caption'] }}</p>
    </div>
</div>

{{-- MAIN CONTENT --}}
<section class="pkg-show-section">
    <div class="container">
        <div class="row g-5">

            {{-- LEFT: Detail --}}
            <div class="col-lg-7">
                {{-- Meta Bar --}}
                <div class="pkg-meta-bar">
                    <div>
                        <h2>{{ $package['subtitle'] }}</h2>
                        <p class="pkg-loc mb-0">
                            <i class="bi bi-geo-alt-fill me-1"></i>{{ $package['location'] }}
                        </p>
                    </div>
                    <div class="pkg-starting">
                        <span>Starting From</span>
                        <strong>{{ $package['price_label'] }}</strong>
                        <small>/pax</small>
                    </div>
                </div>

                {{-- Description --}}
                <div class="pkg-desc">
                    <p class="section-label mb-2">Description</p>
                    <p>{{ $package['desc'] }}</p>
                    <p>{{ $package['desc2'] }}</p>
                </div>

                {{-- Info Boxes --}}
                <div class="info-boxes">
                    <div class="info-box">
                        <i class="bi bi-clock"></i>
                        <div class="ib-label">Duration</div>
                        <div class="ib-val">{{ $package['duration'] }}</div>
                    </div>
                    <div class="info-box">
                        <i class="bi bi-people"></i>
                        <div class="ib-label">Group Size</div>
                        <div class="ib-val">{{ $package['group'] }}</div>
                    </div>
                    <div class="info-box">
                        <i class="bi bi-translate"></i>
                        <div class="ib-label">Language</div>
                        <div class="ib-val">{{ $package['language'] }}</div>
                    </div>
                </div>

                {{-- What's Included --}}
                <p class="includes-heading">What's Included</p>
                <div class="includes-grid">
                    @foreach($package['includes'] as $item)
                    <div class="include-item">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ $item }}
                    </div>
                    @endforeach
                </div>

                {{-- Photos --}}
                <div class="photo-row">
                    <img src="{{ $package['img2'] }}" alt="Photo 1" loading="lazy">
                    <img src="{{ $package['img3'] }}" alt="Photo 2" loading="lazy">
                </div>
            </div>

            {{-- RIGHT: Sidebar --}}
            <div class="col-lg-5">
                <div class="pkg-sidebar">
                    <div class="sidebar-card">
                        <h5>Requirements</h5>
                        @foreach($package['requirements'] as $req)
                        <div class="req-item">
                            <i class="bi bi-info-circle-fill"></i>
                            {{ $req }}
                        </div>
                        @endforeach

                        <p class="date-label">Select Date</p>
                        <input type="date" class="date-input" id="preferredDate"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               placeholder="Choose a preferred date">

                        <a href="{{ route('orders.create', ['package' => $package['id']]) }}" class="btn-book-now">
                            Beli Paket Sekarang <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                        <p class="sidebar-secure">
                            <i class="bi bi-shield-lock-fill me-1" style="color:var(--green-mid)"></i>
                            Secure payment via Internet & Digital Wallets. Free cancellation up to 48 hours before arrival.
                        </p>

                        <div class="sidebar-badges">
                            <div class="sidebar-badge">
                                <i class="bi bi-patch-check-fill"></i>
                                Verified Heritage
                            </div>
                            <div class="sidebar-badge">
                                <i class="bi bi-people-fill"></i>
                                Local Support
                            </div>
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
// Pass date from detail page to booking page
document.querySelector('.btn-book-now').addEventListener('click', function(e) {
    const date = document.getElementById('preferredDate').value;
    if (date) {
        const url = new URL(this.href);
        url.searchParams.set('date', date);
        this.href = url.toString();
    }
});
</script>
@endsection
