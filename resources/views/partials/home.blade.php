{{-- 1. HERO --}}
<section id="home">
    <div class="hero-content px-3">
        <div class="hero-badge">
            <i class="bi bi-geo-alt-fill me-1"></i> Nganjuk, Jawa Timur
        </div>

        <div class="hero-title-swap">
            <h1 class="hero-title swap-text" id="swapText">Sugeng Rawuh</h1>
        </div>

        <p class="hero-subtitle">
            Rasakan keajaiban alam, seni, dan tradisi yang tak lekang oleh waktu di<br>
            Kampung Adat Bajulan, di kaki Gunung Wilis.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-5">
            <a href="{{ route('packages') }}" class="btn-hero-primary">
                <i class="bi bi-compass-fill me-2"></i>Lihat Paket Wisata
            </a>
            <a href="#about" class="btn-hero-outline">
                <i class="bi bi-book me-2"></i>Pelajari Budaya
            </a>
        </div>
    </div>
</section>

<style>
.hero-title-swap {
    min-height: clamp(3.3rem, 7.7vw, 6.6rem);
}
.swap-text {
    display: inline-block;
    transition: opacity 0.5s ease, transform 0.5s ease;
}
.swap-text.out {
    opacity: 0;
    transform: translateY(-14px);
    pointer-events: none;
}
.swap-text.in {
    opacity: 0;
    transform: translateY(14px);
}
</style>

<script>
(function () {
    function getGreeting() {
        const now = new Date();
        const wib = new Date(now.getTime() + now.getTimezoneOffset() * 60000 + 7 * 3600000);
        const h   = wib.getHours();
        if (h >= 4  && h < 11) return 'Wilujeng Injing';
        if (h >= 11 && h < 18) return 'Wilujeng Sonten';
        return 'Wilujeng Dalu';
    }

    const el       = document.getElementById('swapText');
    const greeting = getGreeting();

    // Urutan teks yang akan di-loop
    const texts = [
        { text: 'Sugeng Rawuh', color: '#ffffff' },
        { text: greeting,       color: '#f5d27a' },
    ];

    let current = 0;

    function swapTo(index) {
        // 1. Fade out
        el.classList.add('out');

        setTimeout(function () {
            // 2. Ganti konten
            el.textContent  = texts[index].text;
            el.style.color  = texts[index].color;

            // 3. Siapkan fade-in dari bawah
            el.classList.remove('out');
            el.classList.add('in');
            void el.offsetWidth; // reflow

            // 4. Fade in
            el.classList.remove('in');

        }, 500); // durasi fade-out
    }

    // Mulai loop setelah 2.5 detik pertama
    setTimeout(function () {
        current = 1;
        swapTo(current);

        // Loop terus setiap 3 detik
        setInterval(function () {
            current = (current + 1) % texts.length;
            swapTo(current);
        }, 3000);

    }, 2500);
})();
</script>
