@extends('layouts.app')

@section('title', 'Pembayaran – Kampung Adat Bajulan')

@section('head')
<style>
    body { background: #f5f0e6; }
    .payment-section {
        padding: 8rem 0 5rem;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    .payment-card {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 4px 30px rgba(0,0,0,0.08);
        max-width: 520px;
        margin: 0 auto;
        text-align: center;
    }
    .payment-icon {
        width: 72px; height: 72px;
        background: #e8f5e9;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem;
    }
    .payment-icon i { font-size: 2rem; color: var(--green-dark); }
    .payment-card h2 {
        font-family: 'Playfair Display', serif;
        color: var(--green-dark);
        font-size: 1.6rem;
        margin-bottom: 0.5rem;
    }
    .payment-card p { font-size: 0.9rem; color: var(--text-muted); line-height: 1.7; }
    .booking-code-box {
        background: #f5f0e6;
        border-radius: 12px;
        padding: 0.9rem 1.5rem;
        margin: 1.5rem 0;
        font-size: 0.85rem;
        color: var(--text-muted);
    }
    .booking-code-box strong {
        display: block;
        font-size: 1.2rem;
        color: var(--green-dark);
        letter-spacing: 0.08em;
        margin-top: 0.3rem;
    }
    .btn-pay {
        display: block; width: 100%;
        background: var(--green-dark);
        color: #fff; border: none;
        border-radius: 12px;
        padding: 1rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 1.5rem;
    }
    .btn-pay:hover { background: var(--green-mid); }
    .secure-note {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 1rem;
    }
    .secure-note i { color: var(--green-mid); }
</style>
@endsection

@section('content')
<section class="payment-section">
    <div class="container">
        <div class="payment-card">
            <div class="payment-icon">
                <i class="bi bi-credit-card-2-front-fill"></i>
            </div>
            <h2>Selesaikan Pembayaran</h2>
            <p>Booking Anda telah dibuat. Klik tombol di bawah untuk melanjutkan ke halaman pembayaran Midtrans.</p>

            <div class="booking-code-box">
                Kode Booking Anda
                <strong>{{ $bookingCode }}</strong>
            </div>

            <p style="font-size:0.85rem;color:var(--text-muted)">
                Paket: <strong style="color:var(--green-dark)">{{ $pkgData['title'] }}</strong>
            </p>

            <button id="pay-button" class="btn-pay">
                <i class="bi bi-lock-fill me-2"></i>Bayar Sekarang
            </button>

            <p class="secure-note">
                <i class="bi bi-shield-lock-fill me-1"></i>
                Pembayaran aman diproses oleh Midtrans. Simpan kode booking Anda.
            </p>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = '/booking/status?code={{ $bookingCode }}&status=success';
            },
            onPending: function(result) {
                window.location.href = '/booking/status?code={{ $bookingCode }}&status=pending';
            },
            onError: function(result) {
                window.location.href = '/booking/status?code={{ $bookingCode }}&status=error';
            },
            onClose: function() {
                // User menutup popup tanpa bayar
            }
        });
    });
</script>
@endsection
