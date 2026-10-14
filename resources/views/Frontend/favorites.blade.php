@extends('Frontend.layout')

@section('title', 'My Favorites')

@section('content')

{{-- ============ PAGE HERO ============ --}}
<section class="page-header">
    <div class="page-tag">
        <i class="fa-solid fa-heart"></i> My Favorites
    </div>
    <h1 class="page-title">
        Your <span class="page-gradient">Curated Collection</span>
    </h1>
    <p class="page-desc">
        Albums you've saved for later. Click the heart on any album to add it here.
    </p>

    @if($favorites->count() > 0)
    <div class="page-stats">
        <div class="stat-item">
            <div class="stat-value">{{ $favorites->count() }}</div>
            <div class="stat-label">Saved Albums</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-value">{{ $favorites->unique('album.album_artist_id')->count() }}</div>
            <div class="stat-label">Artists</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-value">∞</div>
            <div class="stat-label">Discover</div>
        </div>
    </div>
    @endif
</section>

{{-- ============ FAVORITES GRID ============ --}}
@if($favorites->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-heart"></i></span>
                Saved Albums
            </h2>
            <p class="section-sub">{{ $favorites->count() }} albums in your library</p>
        </div>
        <a href="{{ route('frontend.albums') }}" class="view-all">
            Browse Albums <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="albums-grid">
        @foreach($favorites as $fav)
            @if($fav->album)
                <div class="album-card-wrapper">
                    <a href="{{ route('frontend.albums.show', $fav->album->id) }}" class="album-card">
                        <div class="album-img-wrap">
                            @if($fav->album->album_cover_image)
                                <img src="{{ asset('storage/' . $fav->album->album_cover_image) }}"
                                     alt="{{ $fav->album->album_name }}"
                                     class="album-img">
                            @else
                                <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%F0%9F%92%BF"
                                     alt="{{ $fav->album->album_name }}"
                                     class="album-img">
                            @endif

                            <div class="album-overlay">
                                <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                            </div>

                            @if($fav->album->album_release_year)
                                <span class="badge-year">{{ $fav->album->album_release_year }}</span>
                            @endif

                            <div class="badge-heart">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                        </div>

                        <div class="album-info">
                            <h3 class="album-title">{{ $fav->album->album_name }}</h3>
                            <div class="album-artist">
                                <i class="fa-solid fa-user"></i>
                                {{ $fav->album->artist->artist_name ?? 'Unknown' }}
                            </div>
                        </div>
                    </a>

                    {{-- Remove Button --}}
                    <form action="{{ route('user.favorites.destroy', $fav->id) }}"
                          method="POST"
                          class="remove-form"
                          onsubmit="return confirm('Remove this album from favorites?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn" title="Remove from Favorites">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </form>
                </div>
            @endif
        @endforeach
    </div>
</section>
@else
{{-- ============ EMPTY STATE ============ --}}
<div class="empty-state-wrap">
    <div class="empty-visual">
        <div class="empty-heart">
            <i class="fa-solid fa-heart"></i>
        </div>
        <div class="empty-pulse pulse-1"></div>
        <div class="empty-pulse pulse-2"></div>
        <div class="empty-pulse pulse-3"></div>
    </div>

    <h2 class="empty-title">No favorites yet</h2>
    <p class="empty-desc">
        Start building your personal collection! Tap the heart icon on any album to save it here.
    </p>

    <div class="empty-actions">
        <a href="{{ route('frontend.albums') }}" class="btn-primary-glow">
            <span><i class="fa-solid fa-compact-disc me-2"></i> Explore Albums</span>
        </a>
        <a href="{{ route('frontend.music') }}" class="btn-ghost">
            <i class="fa-solid fa-music"></i> Browse Music
        </a>
    </div>
</div>
@endif

@endsection

@push('styles')
<style>
    /* ============ PAGE HEADER ============ */
    .page-header { padding: 40px 0 30px; }

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
        font-family: 'Space Grotesk', sans-serif;
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
        max-width: 540px;
        line-height: 1.7;
        margin-bottom: 32px;
    }

    .page-stats {
        display: flex;
        align-items: center;
        gap: 32px;
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
        margin-top: 6px;
    }

    .stat-divider {
        width: 1px;
        height: 40px;
        background: var(--card-border);
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
        font-family: 'Space Grotesk', sans-serif;
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

    /* ============ ALBUMS GRID ============ */
    .albums-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    @media (max-width: 768px) {
        .albums-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    }

    @media (max-width: 480px) {
        .albums-grid { grid-template-columns: 1fr; }
    }

    /* ============ ALBUM CARD ============ */
    .album-card-wrapper {
        position: relative;
    }

    .album-card {
        display: block;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 14px;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .album-card:hover {
        transform: translateY(-6px);
        border-color: rgba(20, 184, 166, 0.4);
        box-shadow: 0 20px 40px -20px rgba(20, 184, 166, 0.4);
    }

    .album-img-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 12px;
        margin-bottom: 14px;
        overflow: hidden;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .album-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .album-card:hover .album-img {
        transform: scale(1.08);
    }

    .album-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 17, 26, 0.75), transparent 55%);
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 12px;
        opacity: 0;
        transition: opacity 0.35s ease;
        border-radius: 12px;
    }

    .album-card:hover .album-overlay { opacity: 1; }

    .play-btn {
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
        transform: translateY(10px);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .album-card:hover .play-btn { transform: translateY(0); }

    .badge-year {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 4px 10px;
        background: rgba(8, 17, 26, 0.85);
        border: 1px solid rgba(103, 232, 249, 0.3);
        color: var(--accent);
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
        backdrop-filter: blur(8px);
        z-index: 3;
    }

    .badge-heart {
        position: absolute;
        top: 12px;
        left: 12px;
        width: 32px;
        height: 32px;
        background: rgba(20, 184, 166, 0.95);
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.5);
        z-index: 3;
    }

    .album-info { padding: 0 2px; }

    .album-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 6px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }

    .album-artist {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: var(--gray);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .album-artist i {
        font-size: 10px;
        color: var(--primary);
    }

    /* ============ REMOVE BUTTON ============ -- */
    .remove-form {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
        margin: 0;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .album-card-wrapper:hover .remove-form {
        opacity: 1;
        transform: scale(1);
    }

    .remove-btn {
        width: 34px;
        height: 34px;
        background: rgba(239, 68, 68, 0.95);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.5);
        transition: all 0.25s ease;
    }

    .remove-btn:hover {
        background: #DC2626;
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.7);
    }

    /* ============ EMPTY STATE ============ */
    .empty-state-wrap {
        text-align: center;
        padding: 60px 20px 80px;
        max-width: 620px;
        margin: 0 auto;
    }

    .empty-visual {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 0 auto 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-heart {
        position: relative;
        z-index: 3;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--card), var(--card-hover));
        border: 2px solid rgba(20, 184, 166, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 40px;
        box-shadow:
            0 0 50px rgba(20, 184, 166, 0.3),
            inset 0 0 30px rgba(20, 184, 166, 0.1);
        animation: heartBeat 1.4s ease-in-out infinite;
    }

    @keyframes heartBeat {
        0%, 100% { transform: scale(1);    }
        14%      { transform: scale(1.12); }
        28%      { transform: scale(1);    }
        42%      { transform: scale(1.08); }
        70%      { transform: scale(1);    }
    }

    .empty-pulse {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 1.5px solid rgba(103, 232, 249, 0.5);
        animation: emptyPulse 1.4s ease-out infinite;
        pointer-events: none;
    }

    .empty-pulse.pulse-1 { animation-delay: 0s; }
    .empty-pulse.pulse-2 { animation-delay: 0.47s; }
    .empty-pulse.pulse-3 { animation-delay: 0.94s; }

    @keyframes emptyPulse {
        0%   { transform: scale(0.85); opacity: 0.7; }
        100% { transform: scale(2.2);  opacity: 0; }
    }

    .empty-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 12px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .empty-desc {
        color: var(--gray);
        font-size: 15px;
        line-height: 1.7;
        max-width: 460px;
        margin: 0 auto 32px;
    }

    .empty-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 576px) {
        .page-title { font-size: 34px; }
        .page-stats { gap: 16px; }
        .stat-value { font-size: 22px; }
        .empty-title { font-size: 22px; }
        .remove-form {
            opacity: 1;
            transform: scale(1);
            top: 18px;
            right: 18px;
        }
    }
</style>
@endpush