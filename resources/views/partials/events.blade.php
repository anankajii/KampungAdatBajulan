{{-- 4. UPCOMING EVENTS --}}
<section id="events">
    <div class="container">
        <div class="event-header fade-up">
            <div>
                <p class="section-label mb-1">Upcoming</p>
                <h2 class="section-heading text-start" style="font-size:1.9rem">Upcoming Events</h2>
            </div>
            <a href="#contact" class="text-decoration-none d-flex align-items-center gap-1"
               style="color:var(--green-mid);font-size:0.88rem;font-weight:600;white-space:nowrap">
                View Calendar <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        @php
        $events = [
            [
                'day'   => '14',
                'month' => 'Mar',
                'tag'   => 'Upacara Adat',
                'title' => 'Nyabran Ceremony',
                'desc'  => 'A sacred ancestral ritual performed annually at the edge of the forest, marking the agricultural season.',
                'loc'   => 'Lapangan Desa Bajulan',
            ],
            [
                'day'   => '02',
                'month' => 'Apr',
                'tag'   => 'Seni Pertunjukan',
                'title' => 'Wayang Kulit Night',
                'desc'  => 'A full-night shadow puppet performance by a renowned dalang, with traditional gamelan accompaniment.',
                'loc'   => 'Pendopo Desa Bajulan',
            ],
            [
                'day'   => '20',
                'month' => 'Apr',
                'tag'   => 'Festival',
                'title' => 'Festival Durian Wilis',
                'desc'  => 'Annual durian harvest festival with culinary showcase, competitions, and live traditional music.',
                'loc'   => 'Kebun Durian Bajulan',
            ],
            [
                'day'   => '10',
                'month' => 'Mei',
                'tag'   => 'Petualangan',
                'title' => 'Trabas Open Lingkar Wilis',
                'desc'  => 'Open off-road trail event circling the slopes of Mount Wilis for all trail bike enthusiasts.',
                'loc'   => 'Start: Balai Desa Bajulan',
            ],
        ];
        @endphp

        <div class="fade-up">
            @foreach($events as $ev)
            <div class="event-row">
                <div class="event-date-box">
                    <span class="eday">{{ $ev['day'] }}</span>
                    <span class="emon">{{ $ev['month'] }}</span>
                </div>
                <div class="event-info">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="event-tag">{{ $ev['tag'] }}</span>
                    </div>
                    <h6>{{ $ev['title'] }}</h6>
                    <p>{{ $ev['desc'] }}</p>
                </div>
                <a href="#booking" class="btn-join">Join Now</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
