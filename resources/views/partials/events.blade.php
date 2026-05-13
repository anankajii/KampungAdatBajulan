{{-- 4. UPCOMING EVENTS --}}
<section id="events">
    <div class="container">
        <div class="event-header fade-up">
            <div>
                <p class="section-label mb-1">Akan Datang</p>
                <h2 class="section-heading text-start" style="font-size:1.9rem">Event akan datang</h2>
            </div>
        </div>

        <div class="fade-up">
            @forelse($events as $ev)
            <div class="event-row">
                <div class="event-date-box">
                    <span class="eday">{{ \Carbon\Carbon::parse($ev->event_date)->format('d') }}</span>
                    <span class="emon">{{ \Carbon\Carbon::parse($ev->event_date)->translatedFormat('M') }}</span>
                </div>
                <div class="event-info">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="event-tag">{{ $ev->package->name ?? 'Event' }}</span>
                        @if($ev->start_time)
                        <span style="font-size:0.75rem;color:var(--text-muted)">
                            <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($ev->start_time)->format('H:i') }} WIB
                        </span>
                        @endif
                    </div>
                    <h6>{{ $ev->name }}</h6>
                    <p>{{ $ev->description }}</p>
                    @if($ev->location)
                    <p style="font-size:0.78rem;color:var(--text-muted);margin-top:0.3rem">
                        <i class="bi bi-geo-alt me-1"></i>{{ $ev->location }}
                    </p>
                    @endif
                </div>
                @php
                    $pkg = $ev->package_id ? $ev->package : null;
                    $pkgActive = $pkg && $pkg->status === 'active';
                    $isOngoing = $ev->status === 'ongoing';
                @endphp

                @if($isOngoing)
                    @if($ev->package_id && !$pkgActive)
                        {{-- Paket nonaktif — tampilkan tombol disabled dengan alert --}}
                        <button class="btn-join"
                                style="opacity:0.5;cursor:not-allowed;border-color:#aaa;color:#aaa"
                                onclick="alert('Paket untuk event ini sedang tidak tersedia. Silakan hubungi kami untuk informasi lebih lanjut.')">
                            Join Now
                        </button>
                    @elseif($ev->package_id && $pkgActive)
                        {{-- Paket aktif — langsung ke form order --}}
                        <a href="{{ route('orders.create', ['package' => $ev->package_id, 'date' => $ev->event_date]) }}"
                           class="btn-join">Join Now</a>
                    @else
                        {{-- Tidak ada paket — ke halaman paket --}}
                        <a href="{{ route('packages') }}" class="btn-join">Join Now</a>
                    @endif
                @elseif($ev->status === 'upcoming')
                    {{-- Belum berlangsung — tampilkan badge saja --}}
                    <span style="
                        font-size:0.75rem;
                        font-weight:600;
                        color:var(--gold);
                        border:1.5px solid var(--gold);
                        border-radius:50px;
                        padding:0.35rem 0.9rem;
                        white-space:nowrap;
                    ">
                        <i class="bi bi-clock me-1"></i>Segera
                    </span>
                @else
                    {{-- Done / Cancelled — tidak tampilkan tombol --}}
                    <span style="font-size:0.75rem;color:var(--text-muted)">
                        {{ $ev->status === 'done' ? 'Selesai' : 'Dibatalkan' }}
                    </span>
                @endif
            </div>
            @empty
            <div style="text-align:center;padding:3rem 0;color:var(--text-muted)">
                <i class="bi bi-calendar-x" style="font-size:2.5rem;display:block;margin-bottom:1rem;opacity:0.4"></i>
                <p style="font-size:0.9rem">Belum ada event yang akan datang.<br>Pantau terus untuk update terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
