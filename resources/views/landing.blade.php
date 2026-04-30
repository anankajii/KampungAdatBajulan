@extends('layouts.app')

@section('title', 'Kampung Adat Bajulan – Wisata Budaya, Alam & Tradisi')

@section('content')

    @include('partials.home')

    @include('partials.about')

    @include('partials.tourism')

    @include('partials.events')

    @include('partials.gallery')

    @include('partials.booking')

    @include('partials.contact')

@endsection

@section('scripts')
<script>
// Scroll-reveal: add hidden class after first paint so elements render first
requestAnimationFrame(() => {
    document.body.classList.add('no-js-fade');
    const fadeEls = document.querySelectorAll('.fade-up');
    const io = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.10 });
    fadeEls.forEach(el => io.observe(el));
});
</script>
@endsection
