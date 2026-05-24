{{-- 5. GALLERY --}}
<section id="gallery">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <p class="section-label">Foto</p>
            <h2 class="section-heading">Momen Keindahan Bajulan</h2>
            <p class="mt-3 mx-auto" style="max-width:480px;font-size:0.92rem;color:var(--text-muted)">
                Sekilas keindahan alam dan kehidupan di Kampung Adat Bajulan melalui lensa kamera.
            </p>
        </div>

        @php
            $fallbackImages = [
                ['url' => '/images/hero.jpg',     'title' => 'Panorama Bajulan',   'caption' => null, 'category' => 'alam'],
                ['url' => '/images/gallery1.png', 'title' => 'Tari Tradisional',   'caption' => null, 'category' => 'budaya'],
                ['url' => '/images/about.png',    'title' => 'Rumah Adat',         'caption' => null, 'category' => 'budaya'],
                ['url' => '/images/gallery2.png', 'title' => 'Edukasi Durian',     'caption' => null, 'category' => 'kuliner'],
                ['url' => '/images/gallery3.png', 'title' => 'Pendakian Wilis',    'caption' => null, 'category' => 'alam'],
                ['url' => '/images/gallery4.png', 'title' => 'Trabas Wilis',       'caption' => null, 'category' => 'alam'],
            ];
            $useDb = isset($galleries) && $galleries->count() > 0;
        @endphp

        <div class="gallery-grid-2x3 fade-up">
            @if($useDb)
                @foreach($galleries as $item)
                <div class="gallery-item"
                     data-img="{{ $item->full_url }}"
                     data-title="{{ $item->title }}"
                     data-caption="{{ $item->caption ?? '' }}"
                     data-category="{{ $item->category }}"
                     onclick="openLightbox(this)">
                    <img src="{{ $item->full_url }}"
                         alt="{{ $item->caption ?? $item->title }}"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='';this.closest('.gallery-item').classList.add('img-broken');">
                    <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
                </div>
                @endforeach
            @else
                @foreach($fallbackImages as $img)
                <div class="gallery-item"
                     data-img="{{ $img['url'] }}"
                     data-title="{{ $img['title'] }}"
                     data-caption=""
                     data-category="{{ $img['category'] }}"
                     onclick="openLightbox(this)">
                    <img src="{{ $img['url'] }}" alt="{{ $img['title'] }}" loading="lazy">
                    <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- LIGHTBOX MODAL --}}
<div id="galleryLightbox" style="
    display:none;
    position:fixed;inset:0;
    background:rgba(0,0,0,0.88);
    z-index:9999;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    padding:1.5rem;
" onclick="closeLightbox(event)">

    {{-- Close button --}}
    <button onclick="closeLightbox()" style="
        position:absolute;top:1.2rem;right:1.5rem;
        background:none;border:none;
        color:#fff;font-size:2rem;
        cursor:pointer;line-height:1;
        opacity:0.8;
    " aria-label="Tutup">&times;</button>

    {{-- Image --}}
    <img id="lbImage" src="" alt="" style="
        max-width:90vw;
        max-height:75vh;
        object-fit:contain;
        border-radius:12px;
        box-shadow:0 8px 40px rgba(0,0,0,0.5);
    ">

    {{-- Caption area --}}
    <div style="margin-top:1.2rem;text-align:center;max-width:600px">
        <p id="lbTitle" style="
            color:#fff;
            font-family:'Playfair Display',serif;
            font-size:1.15rem;
            font-weight:600;
            margin-bottom:0.3rem;
        "></p>
        <p id="lbCaption" style="
            color:rgba(255,255,255,0.65);
            font-size:0.88rem;
            margin:0;
        "></p>
        <span id="lbCategory" style="
            display:inline-block;
            margin-top:0.6rem;
            background:rgba(255,255,255,0.15);
            color:rgba(255,255,255,0.8);
            border-radius:50px;
            padding:0.2rem 0.8rem;
            font-size:0.72rem;
            font-weight:600;
            letter-spacing:0.08em;
            text-transform:uppercase;
        "></span>
    </div>
</div>

<script>
function openLightbox(el) {
    const lb = document.getElementById('galleryLightbox');
    document.getElementById('lbImage').src    = el.dataset.img;
    document.getElementById('lbImage').alt    = el.dataset.title;
    document.getElementById('lbTitle').textContent    = el.dataset.title;
    document.getElementById('lbCaption').textContent  = el.dataset.caption || '';
    document.getElementById('lbCategory').textContent = el.dataset.category || '';

    lb.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    // Tutup hanya jika klik di backdrop atau tombol close
    if (e && e.target !== document.getElementById('galleryLightbox') && e.target.tagName !== 'BUTTON') return;
    document.getElementById('galleryLightbox').style.display = 'none';
    document.body.style.overflow = '';
}

// Tutup dengan tombol Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('galleryLightbox').style.display = 'none';
        document.body.style.overflow = '';
    }
});
</script>
