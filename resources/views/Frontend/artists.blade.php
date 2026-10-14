@extends('Frontend.layout')

@section('title', 'Artists')

@section('content')

<section class="page-header">
    <div class="page-tag"><i class="fa-solid fa-microphone"></i> All Artists</div>
    <h1 class="page-title">
        Discover <span class="page-gradient">Voices</span><br>
        Behind the Sound
    </h1>
    <p class="page-desc">Every artist tells a story. Explore the voices that shape Aurails.</p>
</section>

@if($artists->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-users"></i></span>
                {{ $artists->count() }}+ Artists
            </h2>
            <p class="section-sub">From legends to rising stars</p>
        </div>
    </div>

    <div class="artist-grid">
        @foreach($artists as $artist)
            <a href="{{ route('frontend.artists.show', $artist->id) }}" class="artist-card">
                <div class="artist-img-wrap">
                    @if($artist->artist_image)
                        <img src="{{ asset('storage/' . $artist->artist_image) }}"
                             alt="{{ $artist->artist_name }}"
                             class="artist-img">
                    @else
                        <img src="https://via.placeholder.com/400x400/0F172A/14B8A6?text=%F0%9F%8E%A4"
                             alt="{{ $artist->artist_name }}"
                             class="artist-img">
                    @endif
                    <div class="artist-overlay"></div>
                    <div class="artist-play">
                        <i class="fa-solid fa-play"></i>
                    </div>
                </div>
                <div class="artist-meta">
                    <h3 class="artist-name">{{ $artist->artist_name }}</h3>
                    <div class="artist-tracks">
                        <i class="fa-solid fa-music"></i>
                        {{ $artist->music_count ?? 0 }} {{ Str::plural('track', $artist->music_count ?? 0) }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@else
<div class="empty-state">
    <i class="fa-solid fa-microphone-slash"></i>
    <h3>No artists yet</h3>
    <p>Artists will appear here once they're added.</p>
</div>
@endif

@endsection

@push('styles')
<style>
    /* ============ PAGE HEADER ============ */
    .page-header {
        padding: 40px 0 30px;
        position: relative;
    }

    .page-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: rgba(20, 184, 166, 0.1);
        border: 1px solid rgba(20, 184, 166, 0.3);
        border-radius: 30px;
        color: var(--accent);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .page-title {
        font-size: 52px;
        font-weight: 800;
        line-height: 1.05;
        color: var(--text);
        margin-bottom: 16px;
    }

    .page-gradient {
        background: linear-gradient(120deg, var(--primary), var(--accent));
        background-size: 200% 200%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientMove 6s ease infinite;
    }

    @keyframes gradientMove {
        0%, 100% { background-position: 0% 50%; }
        50%      { background-position: 100% 50%; }
    }

    .page-desc {
        color: var(--gray);
        font-size: 15.5px;
        max-width: 500px;
        line-height: 1.7;
    }

    /* ============ ARTIST GRID ============ */
    .artist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 24px;
    }

    @media (max-width: 768px) {
        .artist-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    }

    @media (max-width: 480px) {
        .artist-grid { grid-template-columns: 1fr; }
    }

    /* ============ ARTIST CARD ============ */
    .artist-card {
        display: block;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 18px;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .artist-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--primary), transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .artist-card:hover {
        transform: translateY(-8px);
        border-color: rgba(20, 184, 166, 0.4);
        box-shadow: 0 20px 40px -20px rgba(20, 184, 166, 0.4);
    }

    .artist-card:hover::before {
        opacity: 1;
    }

    .artist-img-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 16px;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .artist-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 14px;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .artist-card:hover .artist-img {
        transform: scale(1.08);
    }

    .artist-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 17, 26, 0.7), transparent 55%);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 14px;
    }

    .artist-card:hover .artist-overlay {
        opacity: 1;
    }

    .artist-play {
        position: absolute;
        bottom: 14px;
        right: 14px;
        width: 46px;
        height: 46px;
        background: var(--primary);
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        box-shadow: 0 8px 20px rgba(20, 184, 166, 0.5);
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .artist-card:hover .artist-play {
        opacity: 1;
        transform: translateY(0);
    }

    .artist-meta {
        padding: 0 2px;
    }

    .artist-name {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 6px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }

    .artist-tracks {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: var(--gray);
        font-weight: 600;
        padding: 4px 10px;
        background: rgba(20, 184, 166, 0.08);
        border-radius: 20px;
        border: 1px solid rgba(20, 184, 166, 0.15);
    }

    .artist-tracks i {
        font-size: 10px;
        color: var(--primary);
    }

    /* ============ SECTION ============ */
    .section {
        margin-bottom: 52px;
    }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .section-title {
        font-size: 26px;
        font-weight: 800;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title .icon-badge {
        width: 38px;
        height: 38px;
        background: rgba(20, 184, 166, 0.12);
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 16px;
    }

    .section-sub {
        color: var(--gray);
        font-size: 13.5px;
        margin-top: 4px;
    }

    /* ============ EMPTY STATE ============ */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: var(--card);
        border: 1px dashed var(--card-border);
        border-radius: 18px;
        margin: 40px 0;
    }

    .empty-state i {
        font-size: 60px;
        color: var(--gray);
        opacity: 0.4;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--text);
        margin-bottom: 8px;
        font-weight: 700;
    }

    .empty-state p {
        color: var(--gray);
        margin: 0;
    }

    @media (max-width: 576px) {
        .page-title { font-size: 36px; }
        .artist-card { padding: 12px; }
    }
</style>
@endpush