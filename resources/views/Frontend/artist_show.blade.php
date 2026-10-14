@extends('Frontend.layout')

@section('title', $artist->artist_name)

@section('content')

{{-- ============ ARTIST HERO ============ --}}
<section class="artist-hero">
    <div class="artist-hero-bg"></div>

    <div class="artist-hero-content">
        <div class="artist-hero-img-wrap">
            @if($artist->artist_image)
                <img src="{{ asset('storage/' . $artist->artist_image) }}"
                     alt="{{ $artist->artist_name }}"
                     class="artist-hero-img">
            @else
                <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%F0%9F%8E%A4"
                     alt="{{ $artist->artist_name }}"
                     class="artist-hero-img">
            @endif
        </div>

        <div class="artist-hero-info">
            <div class="artist-hero-tag">
                <i class="fa-solid fa-microphone"></i> Artist Profile
            </div>
            <h1 class="artist-hero-name">{{ $artist->artist_name }}</h1>
            <p class="artist-hero-bio">
                {{ $artist->artist_bio ?? $artist->artist_name . ' is a legendary artist known for soulful melodies.' }}
            </p>

            <div class="artist-stats">
                <div class="stat-box">
                    <div class="stat-value">{{ $music->count() }}</div>
                    <div class="stat-label">Tracks</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-box">
                    <div class="stat-value">{{ $artist->albums->count() ?? '—' }}</div>
                    <div class="stat-label">Albums</div>
                </div>
            </div>

            <div class="artist-actions">
                <a href="{{ route('frontend.music') }}" class="btn-primary-glow">
                    <span><i class="fa-solid fa-play me-2"></i> Play All</span>
                </a>
                <button class="btn-ghost" onclick="showToast('Following {{ $artist->artist_name }}')">
                    <i class="fa-solid fa-plus"></i> Follow
                </button>
            </div>
        </div>
    </div>
</section>

{{-- ============ TRACKS ============ --}}
@if($music->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-music"></i></span>
                Songs by {{ $artist->artist_name }}
            </h2>
            <p class="section-sub">{{ $music->count() }} tracks available</p>
        </div>
    </div>

    <div class="track-list">
        @foreach($music as $index => $item)
            <a href="{{ route('frontend.music.show', $item->id) }}" class="track-row">
                <div class="track-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>

                <div class="track-img-wrap">
                    @if($item->music_image_path)
                        <img src="{{ asset('storage/' . $item->music_image_path) }}"
                             alt="{{ $item->music_title }}"
                             class="track-img">
                    @else
                        <img src="https://via.placeholder.com/80x80/0F172A/14B8A6?text=%E2%99%AA"
                             alt="{{ $item->music_title }}"
                             class="track-img">
                    @endif
                    <div class="track-play">
                        <i class="fa-solid fa-play"></i>
                    </div>
                </div>

                <div class="track-info">
                    <div class="track-title">{{ $item->music_title }}</div>
                    <div class="track-sub">{{ $item->album->album_name ?? 'Single' }}</div>
                </div>

                <div class="track-meta">
                    @if($item->genre)
                        <span class="track-pill">{{ $item->genre->genre_name }}</span>
                    @endif
                    <span class="track-year">{{ $item->music_year ?? '—' }}</span>
                </div>

                <div class="track-duration">
                    @if($item->music_is_new == 'yes')
                        <span class="pill pill-new">New</span>
                    @endif
                    <i class="fa-solid fa-play ms-3"></i>
                </div>
            </a>
        @endforeach
    </div>
</section>
@else
<div class="empty-state">
    <i class="fa-solid fa-music"></i>
    <h3>No tracks yet</h3>
    <p>{{ $artist->artist_name }} doesn't have any tracks listed yet.</p>
</div>
@endif

@endsection

@push('styles')
<style>
    /* ============ ARTIST HERO ============ */
    .artist-hero {
        position: relative;
        padding: 40px 0 60px;
        margin-bottom: 30px;
    }

    .artist-hero-bg {
        position: absolute;
        top: 0; left: -24px; right: -24px;
        height: 300px;
        background:
            radial-gradient(ellipse at 30% 20%, rgba(20, 184, 166, 0.15), transparent 60%),
            radial-gradient(ellipse at 70% 80%, rgba(103, 232, 249, 0.1), transparent 60%);
        filter: blur(30px);
        z-index: -1;
        pointer-events: none;
    }

    .artist-hero-content {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
        align-items: center;
    }

    .artist-hero-img-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 24px;
        overflow: hidden;
        border: 3px solid transparent;
        background: linear-gradient(var(--card), var(--card)) padding-box,
                    linear-gradient(135deg, var(--primary), var(--accent)) border-box;
        box-shadow: 0 20px 60px -20px rgba(20, 184, 166, 0.5);
    }

    .artist-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .artist-hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: rgba(20, 184, 166, 0.1);
        border: 1px solid rgba(20, 184, 166, 0.3);
        border-radius: 30px;
        color: var(--accent);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .artist-hero-name {
        font-size: 56px;
        font-weight: 800;
        line-height: 1.05;
        color: var(--text);
        margin-bottom: 16px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .artist-hero-bio {
        font-size: 15px;
        color: var(--gray);
        line-height: 1.7;
        max-width: 620px;
        margin-bottom: 28px;
    }

    .artist-stats {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 28px;
    }

    .stat-box {
        text-align: left;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--accent);
        line-height: 1;
        font-family: 'Space Grotesk', sans-serif;
    }

    .stat-label {
        font-size: 11px;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-top: 4px;
    }

    .stat-divider {
        width: 1px;
        height: 40px;
        background: var(--card-border);
    }

    .artist-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* ============ TRACK LIST ============ */
    .track-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .track-row {
        display: grid;
        grid-template-columns: 40px 60px 1fr auto auto;
        gap: 20px;
        align-items: center;
        padding: 12px 18px;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .track-row:hover {
        background: var(--card-hover);
        border-color: rgba(20, 184, 166, 0.4);
        transform: translateX(4px);
    }

    .track-num {
        color: var(--gray);
        font-size: 14px;
        font-weight: 700;
        font-family: 'Space Grotesk', monospace;
    }

    .track-img-wrap {
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .track-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .track-row:hover .track-img {
        transform: scale(1.1);
    }

    .track-play {
        position: absolute;
        inset: 0;
        background: rgba(20, 184, 166, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--bg);
        font-size: 16px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .track-row:hover .track-play {
        opacity: 1;
    }

    .track-info {
        min-width: 0;
    }

    .track-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }

    .track-sub {
        font-size: 12.5px;
        color: var(--gray);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .track-meta {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .track-pill {
        padding: 4px 10px;
        background: rgba(20, 184, 166, 0.12);
        border: 1px solid rgba(20, 184, 166, 0.25);
        color: var(--accent);
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .track-year {
        color: var(--gray);
        font-size: 13px;
        font-weight: 600;
    }

    .track-duration {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--gray);
    }

    .track-duration i {
        color: var(--primary);
        font-size: 14px;
    }

    .pill-new {
        background: var(--primary);
        color: var(--bg);
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* ============ SECTION ============ */
    .section { margin-bottom: 52px; }

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
        padding: 60px 20px;
        background: var(--card);
        border: 1px dashed var(--card-border);
        border-radius: 18px;
    }

    .empty-state i {
        font-size: 50px;
        color: var(--gray);
        opacity: 0.4;
        margin-bottom: 16px;
    }

    .empty-state h3 {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--gray);
        margin: 0;
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 991px) {
        .artist-hero-content {
            grid-template-columns: 220px 1fr;
            gap: 24px;
        }
        .artist-hero-name { font-size: 42px; }
    }

    @media (max-width: 768px) {
        .artist-hero-content {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .artist-hero-img-wrap {
            max-width: 240px;
            margin: 0 auto;
        }
        .artist-stats, .artist-actions {
            justify-content: center;
        }
        .stat-box { text-align: center; }
        .track-row {
            grid-template-columns: 30px 50px 1fr;
            gap: 12px;
        }
        .track-img-wrap { width: 50px; height: 50px; }
        .track-meta, .track-duration { display: none; }
    }

    @media (max-width: 576px) {
        .artist-hero-name { font-size: 32px; }
    }
</style>
@endpush