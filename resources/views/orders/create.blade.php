@extends('layouts.app')

@section('title', 'Booking – ' . $package['title'] . ' | Kampung Adat Bajulan')

@section('head')
<style>
    body { background: #f5f0e6; }

    .booking-section { padding: 7rem 0 5rem; min-height: 100vh; }

    /* Left: Form */
    .booking-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--green-dark);
        margin-bottom: 0.4rem;
    }
    .booking-subtitle { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 2rem; }

    .form-group { margin-bottom: 1.4rem; }
    .form-label-custom {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }
    .form-control-custom {
        width: 100%;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 12px;
        padding: 0.8rem 1rem 0.8rem 2.8rem;
        font-size: 0.92rem;
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
        background: #fff;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control-custom:focus {
        border-color: var(--green-mid);
        box-shadow: 0 0 0 3px rgba(45,90,39,0.1);
    }
    .form-control-custom::placeholder { color: #bbb; }
    .input-wrap { position: relative; }
    .input-icon {
        position: absolute;
        left: 1rem; top: 50%;
        transform: translateY(-50%);
        color: #aaa; font-size: 1rem;
    }
    select.form-control-custom { cursor: pointer; appearance: none; }
    .select-wrap::after {
        content: '\F282';
        font-family: 'bootstrap-icons';
        position: absolute;
        right: 1rem; top: 50%;
        transform: translateY(-50%);
        color: #aaa; pointer-events: none;
    }

    /* Important note */
    .note-box {
        background: #fff8e6;
        border: 1.5px solid #f0d080;
        border-radius: 12px;
        padding: 1rem 1.2rem;
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    .note-box i { color: #c8860a; font-size: 1.1rem; min-width: 18px; margin-top: 2px; }
    .note-box strong { font-size: 0.85rem; color: #7a5800; display: block; margin-bottom: 0.3rem; }
    .note-box p { font-size: 0.82rem; color: #7a5800; margin: 0; line-height: 1.6; }

    /* Right: Summary */
    .summary-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        position: sticky;
        top: 90px;
    }
    .summary-img-wrap {
        position: relative;
        height: 160px;
        overflow: hidden;
    }
    .summary-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .summary-img-label {
        position: absolute;
        bottom: 0.75rem; left: 0.75rem;
        background: rgba(10,25,10,0.75);
        color: #fff;
        border-radius: 8px;
        padding: 0.25rem 0.7rem;
        font-size: 0.78rem;
        font-weight: 600;
        backdrop-filter: blur(4px);
    }
    .summary-body { padding: 1.5rem; }
    .summary-body h5 {
        font-family: 'Playfair Display', serif;
        color: var(--green-dark);
        font-size: 1.1rem;
        margin-bottom: 1.2rem;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.88rem;
        color: var(--text-muted);
        margin-bottom: 0.7rem;
    }
    .summary-row.total {
        padding-top: 1rem;
        border-top: 1.5px solid rgba(0,0,0,0.08);
        margin-top: 0.5rem;
    }
    .summary-row.total .label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-muted);
    }
    .summary-row.total .amount {
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--green-dark);
    }

    .btn-checkout {
        display: block; width: 100%;
        background: var(--green-dark);
        color: #fff; border: none;
        border-radius: 12px;
        padding: 1rem 1rem;
        font-size: 0.95rem;
        font-weight: 700;
        text-align: center;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 1.3rem;
    }
    .btn-checkout:hover { background: var(--green-mid); }
    .secure-text {
        text-align: center;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 0.75rem;
    }
    .secure-text i { color: var(--green-mid); }
</style>
@endsection

@section('content')
<section class="booking-section">
    <div class="container">
        <div class="row g-5">

            {{-- LEFT: Guest Form --}}
            <div class="col-lg-7">
                <h1 class="booking-title">Guest Information</h1>
                <p class="booking-subtitle">Please fill in your details to finalize your visit to Kampung Adat Bajulan.</p>

                <form action="{{ route('orders.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package['id'] }}">

                    @error('general')
                    <div style="background:#fce4ec;border:1.5px solid #e57373;border-radius:10px;padding:0.8rem 1rem;margin-bottom:1.2rem;font-size:0.88rem;color:#c62828;">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ $message }}
                    </div>
                    @enderror

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">Full Name</label>
                                <div class="input-wrap">
                                    <i class="bi bi-person input-icon"></i>
                                    <input type="text" name="name" class="form-control-custom"
                                           placeholder="e.g. Budi Santoso"
                                           value="{{ old('name') }}" required>
                                </div>
                                @error('name')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">WhatsApp Number</label>
                                <div class="input-wrap">
                                    <i class="bi bi-whatsapp input-icon"></i>
                                    <input type="tel" name="whatsapp" class="form-control-custom"
                                           placeholder="+62 812..."
                                           value="{{ old('whatsapp') }}" required>
                                </div>
                                @error('whatsapp')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">Visit Date</label>
                                <div class="input-wrap">
                                    <i class="bi bi-calendar3 input-icon"></i>
                                    <input type="date" name="date" class="form-control-custom"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           value="{{ request('date') ?? old('date') }}" required>
                                </div>
                                @error('date')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">Number of People</label>
                                <div class="input-wrap select-wrap">
                                    <i class="bi bi-people input-icon"></i>
                                    <select name="people" class="form-control-custom" required>
                                        <option value="">-- Select --</option>
                                        @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('people') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i === 1 ? 'Person' : 'People' }}
                                        </option>
                                        @endfor
                                    </select>
                                </div>
                                @error('people')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Important Note --}}
                    <div class="note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        <div>
                            <strong>Important Note</strong>
                            <p>Please arrive at the village gate at least 15 minutes before your scheduled tour time. Wear comfortable walking shoes and modest clothing.</p>
                        </div>
                    </div>
                </form>
            </div>

            {{-- RIGHT: Order Summary --}}
            <div class="col-lg-5">
                <div class="summary-card">
                    <div class="summary-img-wrap">
                        <img src="{{ $package['img'] }}" alt="{{ $package['title'] }}">
                        <span class="summary-img-label">{{ $package['title'] }}</span>
                    </div>
                    <div class="summary-body">
                        <h5>Order Summary</h5>

                        <div class="summary-row">
                            <span>Ticket (Adult) x 2</span>
                            <span>Rp {{ number_format($package['price'] * 2, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Local Guide Service</span>
                            <span style="color:var(--green-mid);font-weight:600">Included</span>
                        </div>
                        <div class="summary-row">
                            <span>Processing Fee</span>
                            <span>Rp 5.000</span>
                        </div>

                        <div class="summary-row total">
                            <span class="label">Total Price</span>
                            <span class="amount">Rp {{ number_format($package['price'] * 2 + 5000, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" form="bookingForm" class="btn-checkout">
                            Lanjut ke Pembayaran &nbsp;→
                        </button>
                        <p class="secure-text">
                            <i class="bi bi-shield-lock-fill me-1"></i>
                            Secure 256-bit SSL Encrypted Payment
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
