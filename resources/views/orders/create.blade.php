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
                <h1 class="booking-title">Informasi Tamu</h1>
                <p class="booking-subtitle">Isi data Anda untuk menyelesaikan pemesanan kunjungan ke Kampung Adat Bajulan.</p>

                <form action="{{ route('orders.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package['id'] }}">
                    <input type="hidden" name="event_id" value="{{ request('event') }}">

                    @error('general')
                    <div style="background:#fce4ec;border:1.5px solid #e57373;border-radius:10px;padding:0.8rem 1rem;margin-bottom:1.2rem;font-size:0.88rem;color:#c62828;">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ $message }}
                    </div>
                    @enderror

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">Nama Lengkap</label>
                                <div class="input-wrap">
                                    <i class="bi bi-person input-icon"></i>
                                    <input type="text" name="name" class="form-control-custom"
                                           placeholder="cth. Budi Santoso"
                                           value="{{ old('name') }}"
                                           pattern="[A-Za-z\s\.]+"
                                           title="Nama hanya boleh mengandung huruf, spasi, dan titik."
                                           required>
                                </div>
                                @error('name')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">Nomor WhatsApp</label>
                                <div class="input-wrap">
                                    <i class="bi bi-whatsapp input-icon"></i>
                                    <input type="text" name="whatsapp" id="whatsappInput"
                                           class="form-control-custom"
                                           placeholder="08123456789 atau +628123456789"
                                           value="{{ old('whatsapp') }}"
                                           inputmode="tel"
                                           pattern="[+]?[0-9]{10,16}"
                                           minlength="10"
                                           maxlength="16"
                                           autocomplete="tel"
                                           title="Nomor telepon minimal 10 digit. Bisa format 08... atau +62..."
                                           required>
                                </div>
                                <p style="font-size:0.75rem;color:#aaa;margin-top:0.3rem;margin-bottom:0">
                                    <i class="bi bi-info-circle me-1"></i>Gunakan format <strong>08...</strong> atau <strong>+62...</strong>, minimal 10 digit
                                </p>
                                @error('whatsapp')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">Tanggal Kunjungan</label>
                                <div class="input-wrap">
                                    <i class="bi bi-calendar3 input-icon"></i>
                                    <input type="date" name="date" class="form-control-custom"
                                           min="{{ date('Y-m-d') }}"
                                           value="{{ request('date') ?? old('date') }}" required>
                                </div>
                                @error('date')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-custom">Jumlah Orang</label>
                                <div class="input-wrap">
                                    <i class="bi bi-people input-icon"></i>
                                    <input type="number" name="people" class="form-control-custom"
                                           placeholder="cth. 5"
                                           min="{{ $package['min_person'] }}"
                                           max="100"
                                           value="{{ old('people') }}"
                                           inputmode="numeric"
                                           required>
                                </div>
                                <p style="font-size:0.75rem;color:#aaa;margin-top:0.3rem;margin-bottom:0">
                                    <i class="bi bi-info-circle me-1"></i>Min. {{ $package['min_person'] }} orang, maks. 100 orang
                                </p>
                                @error('people')<p style="color:red;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Important Note --}}
                    <div class="note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        <div>
                            <strong>Catatan Penting</strong>
                            <p>Harap tiba di gerbang desa minimal 15 menit sebelum jadwal tur. Kenakan alas kaki yang nyaman dan pakaian yang sopan.</p>
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
                        <h5>Ringkasan Pesanan</h5>

                        <div class="summary-row">
                            <span>Harga per orang</span>
                            <span>Rp {{ number_format($package['price'], 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span id="ticket-label">Jumlah orang</span>
                            <span id="ticket-count">—</span>
                        </div>
                        <div class="summary-row">
                            <span>Min. pemesanan</span>
                            <span>{{ $package['min_person'] }} orang</span>
                        </div>

                        <div class="summary-row total">
                            <span class="label">Total Price</span>
                            <span class="amount" id="total-price">—</span>
                        </div>

                        <button type="submit" form="bookingForm" class="btn-checkout">
                            Lanjut ke Pembayaran &nbsp;→
                        </button>
                        <p class="secure-text">
                            <i class="bi bi-shield-lock-fill me-1"></i>
                            Pembayaran terenkripsi SSL 256-bit yang aman
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
const pricePerPerson = {{ $package['price'] }};
const minPerson = {{ $package['min_person'] }};

function formatRupiah(num) {
    return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function updateSummary() {
    const people = parseInt(document.querySelector('input[name="people"]').value) || 0;

    if (people > 0) {
        const total = pricePerPerson * people;
        document.getElementById('ticket-label').textContent = 'Ticket x ' + people + ' orang';
        document.getElementById('ticket-count').textContent = formatRupiah(total);
        document.getElementById('total-price').textContent = formatRupiah(total);
    } else {
        document.getElementById('ticket-label').textContent = 'Jumlah orang';
        document.getElementById('ticket-count').textContent = '—';
        document.getElementById('total-price').textContent = '—';
    }
}

document.querySelector('input[name="people"]').addEventListener('input', updateSummary);
updateSummary();

// ── Phone: izinkan angka dan '+' di posisi pertama saja ──
const waInput = document.getElementById('whatsappInput');
waInput.addEventListener('keydown', function(e) {
    const allowed = ['Backspace','Delete','Tab','ArrowLeft','ArrowRight','Home','End'];
    if (allowed.includes(e.key)) return;
    // Izinkan '+' hanya di posisi 0 dan belum ada '+'
    if (e.key === '+' && this.selectionStart === 0 && !this.value.includes('+')) return;
    if (!/^[0-9]$/.test(e.key)) e.preventDefault();
});
waInput.addEventListener('paste', function(e) {
    e.preventDefault();
    const text = (e.clipboardData || window.clipboardData).getData('text').trim();
    if (text.startsWith('+')) {
        // Pertahankan '+', strip karakter non-digit setelahnya
        this.value = '+' + text.slice(1).replace(/\D/g, '').slice(0, 15);
    } else {
        this.value = text.replace(/\D/g, '').slice(0, 16);
    }
});
waInput.addEventListener('input', function() {
    const val = this.value;
    if (val.startsWith('+')) {
        // Jaga '+' di depan, hapus non-digit setelahnya
        this.value = '+' + val.slice(1).replace(/\D/g, '').slice(0, 15);
    } else {
        this.value = val.replace(/\D/g, '').slice(0, 16);
    }
});
</script>
@endsection
