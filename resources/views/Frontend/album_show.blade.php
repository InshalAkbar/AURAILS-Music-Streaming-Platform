@extends('Frontend.layout')

@section('title', $album->album_name)

@section('content')

{{-- ============ ALBUM HERO ============ --}}
<section class="album-hero">
    <div class="album-hero-bg"></div>

    <div class="album-hero-content">
        {{-- Album Cover --}}
        <div class="album-art-wrap">
            @if($album->album_cover_image)
                <img src="{{ asset('storage/' . $album->album_cover_image) }}"
                     alt="{{ $album->album_name }}"
                     class="album-art">
            @else
                <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%F0%9F%92%BF"
                     alt="{{ $album->album_name }}"
                     class="album-art">
            @endif
        </div>

        {{-- Info --}}
        <div class="album-info-panel">
            <div class="hero-tag">
                <i class="fa-solid fa-compact-disc"></i> Album
            </div>

            <h1 class="album-hero-title">{{ $album->album_name }}</h1>

            <div class="hero-meta">
                <a href="{{ route('frontend.artists.show', $album->artist->id ?? '#') }}" class="meta-artist">
                    <i class="fa-solid fa-user"></i>
                    {{ $album->artist->artist_name ?? 'Unknown Artist' }}
                </a>
                @if($album->album_release_year)
                    <span class="meta-year">
                        <i class="fa-solid fa-calendar"></i>
                        {{ $album->album_release_year }}
                    </span>
                @endif
                <span class="meta-tracks">
                    <i class="fa-solid fa-music"></i>
                    {{ $music->count() }} {{ Str::plural('Track', $music->count()) }}
                </span>
            </div>

            @if($album->album_description)
                <p class="album-hero-desc">{{ $album->album_description }}</p>
            @endif

            <div class="hero-actions">
                @if($music->count() > 0)
                    <a href="{{ route('frontend.music.show', $music->first()->id) }}" class="btn-primary-glow">
                        <span><i class="fa-solid fa-play me-2"></i> Play Album</span>
                    </a>
                @endif

                @auth
                    <form action="{{ route('user.favorites.store') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $album->id }}">
                        <button type="submit" class="btn-ghost">
                            <i class="fa-solid fa-heart"></i> Add to Favorites
                        </button>
                    </form>
                @endauth
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
                Tracks
            </h2>
            <p class="section-sub">{{ $music->count() }} songs in this album</p>
        </div>
    </div>

    <div class="track-list">
        @foreach($music as $index => $track)
            <a href="{{ route('frontend.music.show', $track->id) }}" class="track-row">
                <div class="track-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>

                <div class="track-img-wrap">
                    @if($track->music_image_path)
                        <img src="{{ asset('storage/' . $track->music_image_path) }}"
                             alt="{{ $track->music_title }}"
                             class="track-img">
                    @else
                        <img src="https://via.placeholder.com/80x80/0F172A/14B8A6?text=%E2%99%AA"
                             alt="{{ $track->music_title }}"
                             class="track-img">
                    @endif
                    <div class="track-play">
                        <i class="fa-solid fa-play"></i>
                    </div>
                </div>

                <div class="track-info">
                    <div class="track-title">{{ $track->music_title }}</div>
                    <div class="track-sub">
                        {{ $track->genre->genre_name ?? 'Music' }}
                        @if($track->music_year) · {{ $track->music_year }} @endif
                    </div>
                </div>

                <div class="track-meta">
                    @if($track->music_is_new == 'yes')
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
    <h3>No tracks in this album</h3>
    <p>Tracks will be added soon.</p>
</div>
@endif

{{-- ============ MORE FROM ARTIST ============ --}}
@php
    $otherAlbums = \App\Models\Album::where('album_artist_id', $album->album_artist_id)
        ->where('id', '!=', $album->id)
        ->take(4)
        ->get();
@endphp

@if($otherAlbums->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-compact-disc"></i></span>
                More from {{ $album->artist->artist_name }}
            </h2>
        </div>
        <a href="{{ route('frontend.artists.show', $album->artist->id) }}" class="view-all">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="albums-grid">
        @foreach($otherAlbums as $other)
            <a href="{{ route('frontend.albums.show', $other->id) }}" class="album-card">
                <div class="album-img-wrap">
                    @if($other->album_cover_image)
                        <img src="{{ asset('storage/' . $other->album_cover_image) }}" alt="{{ $other->album_name }}" class="album-img">
                    @else
                        <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%F0%9F%92%BF" alt="{{ $other->album_name }}" class="album-img">
                    @endif
                    <div class="album-overlay">
                        <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                    </div>
                </div>
                <div class="album-info">
                    <h3 class="album-title">{{ $other->album_name }}</h3>
                    <div class="album-artist">
                        <i class="fa-solid fa-calendar"></i>
                        {{ $other->album_release_year ?? 'N/A' }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

@endsection

@push('styles')
<style>
    /* ============ ALBUM HERO ============ */
    .album-hero {
        position: relative;
        padding: 40px 0 60px;
        margin-bottom: 20px;
    }

    .album-hero-bg {
        position: absolute;
        top: 0; left: -24px; right: -24px;
        height: 400px;
        background:
            radial-gradient(ellipse at 30% 30%, rgba(20, 184, 166, 0.15), transparent 55%),
            radial-gradient(ellipse at 70% 70%, rgba(103, 232, 249, 0.1), transparent 55%);
        filter: blur(40px);
        z-index: -1;
        pointer-events: none;
    }

    .album-hero-content {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 48px;
        align-items: center;
    }

    .album-art-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(135deg, #0F172A, #1E293B);
        box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.8);
        transition: all 0.4s ease;
    }

    .album-art-wrap:hover {
        box-shadow: 0 35px 70px -20px rgba(20, 184, 166, 0.4);
    }

    .album-art {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .album-art-wrap:hover .album-art {
        transform: scale(1.05);
    }

    .album-info-panel {
        position: relative;
        z-index: 3;
    }

    .hero-tag {
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

    .album-hero-title {
        font-size: 54px;
        font-weight: 800;
        line-height: 1.05;
        color: var(--text);
        margin-bottom: 20px;
        font-family: 'Space Grotesk', sans-serif;
        letter-spacing: -0.02em;
    }

    .hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 22px;
    }

    .meta-artist,
    .meta-year,
    .meta-tracks {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent);
        text-decoration: none;
        font-size: 14.5px;
        font-weight: 700;
        transition: color 0.25s ease;
    }

    .meta-year,
    .meta-tracks { color: var(--gray); }

    .meta-artist:hover { color: var(--primary); }

    .meta-artist i,
    .meta-year i,
    .meta-tracks i { font-size: 13px; }

    .album-hero-desc {
        font-size: 15px;
        color: var(--gray);
        line-height: 1.75;
        max-width: 640px;
        margin-bottom: 30px;
    }

    .hero-actions {
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
        grid-template-columns: 40px 60px 1fr auto;
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

    .track-row:hover .track-img { transform: scale(1.1); }

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

    .track-row:hover .track-play { opacity: 1; }

    .track-info { min-width: 0; }

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
        align-items: center;
        color: var(--gray);
    }

    .track-meta i { color: var(--primary); font-size: 14px; }

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

    /* ============ ALBUMS GRID (More from artist) ============ */
    .albums-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 18px;
    }

    .album-card {
        display: block;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 12px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .album-card:hover {
        transform: translateY(-5px);
        border-color: rgba(20, 184, 166, 0.4);
        box-shadow: 0 15px 35px -18px rgba(20, 184, 166, 0.4);
    }

    .album-img-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .album-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    /* SIMPLE ZOOM HOVER */
    .album-card:hover .album-img { transform: scale(1.08); }

    .album-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 17, 26, 0.75), transparent 55%);
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 10px;
    }

    .album-card:hover .album-overlay { opacity: 1; }

    .play-btn {
        width: 40px;
        height: 40px;
        background: var(--primary);
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        box-shadow: 0 8px 20px rgba(20, 184, 166, 0.5);
        transform: translateY(8px);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .album-card:hover .play-btn { transform: translateY(0); }

    .album-info { padding: 0 2px; }

    .album-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }

    .album-artist {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--gray);
    }

    .album-artist i { font-size: 10px; color: var(--primary); }

    /* ============ SECTION ============ */
    .section { margin-bottom: 48px; }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .section-title .icon-badge {
        width: 36px;
        height: 36px;
        background: rgba(20, 184, 166, 0.12);
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 15px;
    }

    .section-sub {
        color: var(--gray);
        font-size: 13.5px;
        margin-top: 4px;
    }

    .view-all {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        padding: 8px 14px;
        border-radius: 10px;
        transition: all 0.25s ease;
    }

    .view-all:hover {
        color: var(--accent);
        background: rgba(20, 184, 166, 0.08);
        gap: 10px;
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

    .empty-state p { color: var(--gray); margin: 0; }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 991px) {
        .album-hero-content {
            grid-template-columns: 1fr;
            gap: 32px;
            text-align: center;
        }
        .album-art-wrap { max-width: 280px; margin: 0 auto; }
        .album-hero-title { font-size: 38px; }
        .hero-meta, .hero-actions { justify-content: center; }
        .album-hero-desc { margin-left: auto; margin-right: auto; }
    }

    @media (max-width: 768px) {
        .track-row {
            grid-template-columns: 30px 50px 1fr;
            gap: 12px;
        }
        .track-img-wrap { width: 50px; height: 50px; }
        .track-meta { display: none; }
    }

    @media (max-width: 576px) {
        .album-hero-title { font-size: 28px; }
        .albums-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .album-card { padding: 10px; }
    }
</style>
@endpush