@extends('layouts.app')

@section('title', 'Homestay – Kampung Adat Bajulan')

@section('head')
<style>
    body { background: #f5f0e6; }

    /* Hero */
    .hs-hero {
        padding: 8rem 0 5rem;
        background: linear-gradient(135deg, var(--green-dark) 0%, #0d2b0d 100%);
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    .hs-hero::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 28px 28px;
    }
    .hs-hero-badge {
        display: inline-block;
        background: rgba(200,134,10,0.25);
        border: 1px solid rgba(200,134,10,0.5);
        color: #f5d27a;
        border-radius: 50px;
        padding: 0.3rem 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }
    .hs-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        color: #fff;
        margin-bottom: 1rem;
    }
    .hs-hero p {
        color: rgba(255,255,255,0.75);
        font-size: 1rem;
        max-width: 560px;
        margin: 0 auto 2rem;
        line-height: 1.7;
    }
    .hs-coming-badge {
        display: inline-block;
        background: var(--gold);
        color: #fff;
        border-radius: 50px;
        padding: 0.4rem 1.2rem;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.06em;
    }

    /* Info section */
    .hs-section { padding: 5rem 0; }

    /* Feature cards */
    .hs-feature {
        background: #fff;
        border-radius: 18px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        height: 100%;
        transition: transform 0.2s;
    }
    .hs-feature:hover { transform: translateY(-4px); }
    .hs-feature-icon {
        width: 60px; height: 60px;
        background: var(--green-dark);
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.2rem;
        font-size: 1.5rem;
        color: #fff;
    }
    .hs-feature h5 {
        font-family: 'Playfair Display', serif;
        color: var(--green-dark);
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }
    .hs-feature p {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin: 0;
        line-height: 1.6;
    }

    /* Form */
    .hs-form-card {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }
    .hs-form-card h3 {
        font-family: 'Playfair Display', serif;
        color: var(--green-dark);
        font-size: 1.6rem;
        margin-bottom: 0.5rem;
    }
    .hs-form-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }
    .hs-input-group { margin-bottom: 1.2rem; }
    .hs-label {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }
    .hs-input {
        width: 100%;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 0.92rem;
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
        background: var(--cream);
        outline: none;
        transition: border-color 0.2s;
    }
    .hs-input:focus { border-color: var(--green-mid); }
    .hs-input::placeholder { color: #bbb; }
    .btn-wa-submit {
        display: block; width: 100%;
        background: #25D366;
        color: #fff; border: none;
        border-radius: 12px;
        padding: 1rem;
        font-size: 0.95rem;
        font-weight: 700;
        text-align: center;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 1.5rem;
        text-decoration: none;
    }
    .btn-wa-submit:hover { background: #1da851; color: #fff; }

    /* Info box */
    .hs-info-box {
        background: linear-gradient(135deg, var(--green-dark), #0d2b0d);
        border-radius: 20px;
        padding: 2.5rem;
        color: #fff;
        height: 100%;
    }
    .hs-info-box h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        margin-bottom: 1.5rem;
    }
    .hs-info-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.2rem;
        font-size: 0.88rem;
        color: rgba(255,255,255,0.8);
        line-height: 1.5;
    }
    .hs-info-item i {
        color: var(--gold);
        font-size: 1.1rem;
        min-width: 18px;
        margin-top: 2px;
    }
    .hs-info-item strong { color: #fff; display: block; margin-bottom: 0.2rem; }
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="hs-hero">
    <div class="container" style="position:relative;z-index:2">
        <div class="hs-hero-badge"><i class="bi bi-house-heart me-1"></i> Segera Hadir</div>
        <h1>Homestay Kampung Adat<br>Bajulan</h1>
        <p>Rasakan pengalaman menginap autentik di rumah warga Bajulan — menyatu dengan alam, tradisi, dan kehangatan masyarakat desa.</p>
        <span class="hs-coming-badge"><i class="bi bi-clock me-1"></i> Coming Soon — Daftar Minat Sekarang</span>
    </div>
</div>

{{-- FITUR HOMESTAY --}}
<section class="hs-section" style="background:var(--cream)">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">Yang Akan Tersedia</p>
            <h2 class="section-heading">Pengalaman Menginap Autentik</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="hs-feature">
                    <div class="hs-feature-icon"><i class="bi bi-house-fill"></i></div>
                    <h5>Rumah Joglo Tradisional</h5>
                    <p>Menginap di rumah adat joglo milik warga dengan arsitektur Jawa yang autentik dan nyaman.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hs-feature">
                    <div class="hs-feature-icon"><i class="bi bi-cup-hot-fill"></i></div>
                    <h5>Sarapan Masakan Lokal</h5>
                    <p>Nikmati sarapan pagi dengan masakan tradisional Jawa yang disiapkan langsung oleh tuan rumah.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hs-feature">
                    <div class="hs-feature-icon"><i class="bi bi-tree-fill"></i></div>
                    <h5>Aktivitas Desa</h5>
                    <p>Ikut serta dalam kegiatan sehari-hari warga — bertani, membuat kerajinan, atau belajar tari tradisional.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hs-feature">
                    <div class="hs-feature-icon"><i class="bi bi-moon-stars-fill"></i></div>
                    <h5>Suasana Malam Desa</h5>
                    <p>Rasakan ketenangan malam di kaki Gunung Wilis, jauh dari keramaian kota dengan langit berbintang.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hs-feature">
                    <div class="hs-feature-icon"><i class="bi bi-people-fill"></i></div>
                    <h5>Interaksi Langsung</h5>
                    <p>Berinteraksi langsung dengan keluarga tuan rumah dan belajar tentang budaya Jawa dari sumbernya.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hs-feature">
                    <div class="hs-feature-icon"><i class="bi bi-wifi"></i></div>
                    <h5>Fasilitas Dasar</h5>
                    <p>Kamar bersih, kamar mandi, dan fasilitas dasar yang nyaman untuk istirahat setelah seharian berwisata.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FORM MINAT + INFO --}}
<section class="hs-section" style="background:var(--cream-dark)">
    <div class="container">
        <div class="row g-5 align-items-start">

            {{-- Form Minat --}}
            <div class="col-lg-7">
                <div class="hs-form-card">
                    <h3>Daftar Minat Homestay</h3>
                    <p>Isi form di bawah dan kami akan menghubungi Anda via WhatsApp ketika homestay sudah siap beroperasi.</p>

                    <div id="homestayForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="hs-input-group">
                                    <label class="hs-label">Nama Lengkap *</label>
                                    <input type="text" id="hs_name" class="hs-input" placeholder="cth. Budi Santoso">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="hs-input-group">
                                    <label class="hs-label">Nomor WhatsApp *</label>
                                    <input type="tel" id="hs_phone" class="hs-input" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="hs-input-group">
                                    <label class="hs-label">Rencana Tanggal Kunjungan</label>
                                    <input type="date" id="hs_date" class="hs-input"
                                           min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="hs-input-group">
                                    <label class="hs-label">Jumlah Tamu</label>
                                    <select id="hs_guests" class="hs-input">
                                        <option value="">-- Pilih --</option>
                                        @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }} Orang</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="hs-input-group">
                                    <label class="hs-label">Pesan / Pertanyaan (opsional)</label>
                                    <textarea id="hs_message" class="hs-input" rows="3"
                                              placeholder="Ceritakan kebutuhan atau pertanyaan Anda..."></textarea>
                                </div>
                            </div>
                        </div>

                        <a href="#" id="btnSendWa" class="btn-wa-submit" onclick="sendToWhatsApp(event)">
                            <i class="bi bi-whatsapp me-2"></i>Kirim via WhatsApp
                        </a>

                        <p style="font-size:0.78rem;color:var(--text-muted);text-align:center;margin-top:0.75rem">
                            <i class="bi bi-shield-check me-1" style="color:var(--green-mid)"></i>
                            Data Anda hanya digunakan untuk keperluan informasi homestay.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-5">
                <div class="hs-info-box">
                    <h4>Informasi Homestay</h4>
                    <div class="hs-info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <strong>Lokasi</strong>
                            Dusun Bajulan, Desa Bajulan, Kec. Loceret, Kab. Nganjuk, Jawa Timur
                        </div>
                    </div>
                    <div class="hs-info-item">
                        <i class="bi bi-cash-coin"></i>
                        <div>
                            <strong>Estimasi Harga</strong>
                            Mulai dari Rp 150.000 – Rp 300.000 / malam / orang (termasuk sarapan)
                        </div>
                    </div>
                    <div class="hs-info-item">
                        <i class="bi bi-people-fill"></i>
                        <div>
                            <strong>Kapasitas</strong>
                            2–8 orang per unit homestay
                        </div>
                    </div>
                    <div class="hs-info-item">
                        <i class="bi bi-calendar-check"></i>
                        <div>
                            <strong>Status</strong>
                            Sedang dalam persiapan. Daftar minat sekarang untuk mendapat notifikasi pertama.
                        </div>
                    </div>
                    <div class="hs-info-item">
                        <i class="bi bi-whatsapp"></i>
                        <div>
                            <strong>Hubungi Langsung</strong>
                            <a href="https://wa.me/6281234567890" target="_blank"
                               style="color:rgba(255,255,255,0.8);text-decoration:none">
                                +62 812-3456-7890
                            </a>
                        </div>
                    </div>

                    <hr style="border-color:rgba(255,255,255,0.15);margin:1.5rem 0">

                    <p style="font-size:0.85rem;color:rgba(255,255,255,0.65);line-height:1.7;margin:0">
                        Dengan mendaftar minat, Anda akan menjadi yang pertama mendapat informasi ketika homestay Bajulan resmi dibuka.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
function sendToWhatsApp(e) {
    e.preventDefault();

    const name    = document.getElementById('hs_name').value.trim();
    const phone   = document.getElementById('hs_phone').value.trim();
    const date    = document.getElementById('hs_date').value;
    const guests  = document.getElementById('hs_guests').value;
    const message = document.getElementById('hs_message').value.trim();

    if (!name || !phone) {
        alert('Nama dan nomor WhatsApp harus diisi.');
        return;
    }

    let text = `Halo, saya ingin mendaftar minat Homestay Kampung Adat Bajulan.\n\n`;
    text += `*Nama:* ${name}\n`;
    text += `*No. WA:* ${phone}\n`;
    if (date) text += `*Rencana Tanggal:* ${date}\n`;
    if (guests) text += `*Jumlah Tamu:* ${guests} orang\n`;
    if (message) text += `*Pesan:* ${message}\n`;
    text += `\nMohon informasi lebih lanjut. Terima kasih!`;

    const waNumber = '6281234567890';
    const url = `https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
}
</script>
@endsection
