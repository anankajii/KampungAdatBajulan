@extends('layouts.app')

@section('title', 'Status Booking – Kampung Adat Bajulan')

@section('head')
<style>
    body { background: #f5f0e6; }
    .status-section {
        padding: 8rem 0 5rem;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    .status-card {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 4px 30px rgba(0,0,0,0.08);
        max-width: 520px;
        margin: 0 auto;
        text-align: center;
    }
    .status-icon {
        width: 80px; height: 80px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.2rem;
    }
    .status-icon.success { background: #e8f5e9; color: #2e7d32; }
    .status-icon.pending { background: #fff8e1; color: #f9a825; }
    .status-icon.error   { background: #fce4ec; color: #c62828; }
    .status-card h2 {
        font-family: 'Playfair Display', serif;
        color: var(--green-dark);
        font-size: 1.6rem;
        margin-bottom: 0.5rem;
    }
    .status-card p { font-size: 0.9rem; color: var(--text-muted); line-height: 1.7; }
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
    .detail-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.88rem;
        color: var(--text-muted);
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-row span:last-child { font-weight: 600; color: var(--green-dark); }
    .btn-home {
        display: inline-block;
        background: var(--green-dark);
        color: #fff;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-size: 0.9rem;
        font-weight: 700;
        text-decoration: none;
        margin-top: 1.5rem;
        transition: background 0.2s;
    }
    .btn-home:hover { background: var(--green-mid); color: #fff; }
</style>
@endsection

@section('content')
<section class="status-section">
    <div class="container">
        <div class="status-card">
            @if($status === 'success')
                <div class="status-icon success"><i class="bi bi-check-circle-fill"></i></div>
                <h2>Pembayaran Berhasil!</h2>
                <p>Terima kasih! Booking Anda telah dikonfirmasi. Notifikasi akan dikirim ke WhatsApp Anda.</p>
            @elseif($status === 'pending')
                <div class="status-icon pending"><i class="bi bi-clock-fill"></i></div>
                <h2>Menunggu Pembayaran</h2>
                <p>Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran sesuai instruksi yang diberikan.</p>
            @else
                <div class="status-icon error"><i class="bi bi-x-circle-fill"></i></div>
                <h2>Pembayaran Gagal</h2>
                <p>Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi atau hubungi kami.</p>
            @endif

            @if($code)
            <div class="booking-code-box">
                Kode Booking Anda
                <strong>{{ $code }}</strong>
            </div>
            @endif

            @if($booking)
            <div class="mt-3 text-start">
                <div class="detail-row">
                    <span>Paket</span>
                    <span>{{ $booking->package->name ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span>Tanggal Kunjungan</span>
                    <span>{{ \Carbon\Carbon::parse($booking->visit_date)->format('d M Y') }}</span>
                </div>
                <div class="detail-row">
                    <span>Jumlah Orang</span>
                    <span>{{ $booking->total_person }} orang</span>
                </div>
                <div class="detail-row">
                    <span>Total Harga</span>
                    <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
            @endif

            <a href="{{ route('landing') }}" class="btn-home">
                <i class="bi bi-house-fill me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
