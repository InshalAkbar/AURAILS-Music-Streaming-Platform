@extends('Frontend.layout')

@section('title', $query ? 'Search: ' . $query : 'Search')

@section('content')

{{-- ============ PAGE HEADER ============ --}}
<section class="page-header">
    <div class="page-tag">
        <i class="fa-solid fa-magnifying-glass"></i> Search Results
    </div>

    @if($query)
        <h1 class="page-title">
            Results for <span class="page-gradient">"{{ $query }}"</span>
        </h1>
        <p class="page-desc">
            {{ $totalResults }} {{ Str::plural('result', $totalResults) }} found across music, artists, albums and videos.
        </p>
    @else
        <h1 class="page-title">
            Search <span class="page-gradient">Aurails</span>
        </h1>
        <p class="page-desc">
            Find your favorite tracks, artists, albums, and videos.
        </p>
    @endif
</section>

@if($query && $totalResults > 0)

    {{-- ============ ARTISTS ============ --}}
    @if($artists->count() > 0)
    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">
                    <span class="icon-badge"><i class="fa-solid fa-microphone"></i></span>
                    Artists
                </h2>
                <p class="section-sub">{{ $artists->count() }} found</p>
            </div>
        </div>

        <div class="artist-row">
            @foreach($artists as $artist)
                <a href="{{ route('frontend.artists.show', $artist->id) }}" class="artist-bubble">
                    <div class="artist-ring">
                        <div class="artist-avatar">
                            @if($artist->artist_image)
                                <img src="{{ asset('storage/' . $artist->artist_image) }}" alt="{{ $artist->artist_name }}">
                            @else
                                <img src="https://via.placeholder.com/200x200/0F172A/14B8A6?text=%F0%9F%8E%A4" alt="{{ $artist->artist_name }}">
                            @endif
                        </div>
                        <div class="artist-glow"></div>
                    </div>
                    <div class="artist-name-sm">{{ $artist->artist_name }}</div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ============ MUSIC ============ --}}
    @if($music->count() > 0)
    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">
                    <span class="icon-badge"><i class="fa-solid fa-music"></i></span>
                    Music
                </h2>
                <p class="section-sub">{{ $music->count() }} found</p>
            </div>
        </div>

        <div class="grid grid-4">
            @foreach($music as $item)
                <a href="{{ route('frontend.music.show', $item->id) }}" class="music-card">
                    <div class="music-img-wrap">
                        @if($item->music_image_path)
                            <img src="{{ asset('storage/' . $item->music_image_path) }}" alt="{{ $item->music_title }}" class="music-img">
                        @else
                            <img src="https://via.placeholder.com/400x400/0F172A/14B8A6?text=%E2%99%AA" alt="{{ $item->music_title }}" class="music-img">
                        @endif
                        <div class="music-overlay">
                            <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                        </div>
                        @if($item->music_is_new == 'yes')
                            <span class="badge-new">New</span>
                        @endif
                    </div>
                    <div class="music-info">
                        <h3 class="music-title">{{ $item->music_title }}</h3>
                        <div class="music-artist">
                            <i class="fa-solid fa-user"></i>
                            {{ $item->artist->artist_name ?? 'Unknown' }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ============ ALBUMS ============ --}}
    @if($albums->count() > 0)
    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">
                    <span class="icon-badge"><i class="fa-solid fa-compact-disc"></i></span>
                    Albums
                </h2>
                <p class="section-sub">{{ $albums->count() }} found</p>
            </div>
        </div>

        <div class="grid grid-4">
            @foreach($albums as $album)
                <a href="{{ route('frontend.albums.show', $album->id) }}" class="music-card">
                    <div class="music-img-wrap">
                        @if($album->album_cover_image)
                            <img src="{{ asset('storage/' . $album->album_cover_image) }}" alt="{{ $album->album_name }}" class="music-img">
                        @else
                            <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%F0%9F%92%BF" alt="{{ $album->album_name }}" class="music-img">
                        @endif
                        <div class="music-overlay">
                            <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                        </div>
                        @if($album->album_release_year)
                            <span class="badge-year">{{ $album->album_release_year }}</span>
                        @endif
                    </div>
                    <div class="music-info">
                        <h3 class="music-title">{{ $album->album_name }}</h3>
                        <div class="music-artist">
                            <i class="fa-solid fa-user"></i>
                            {{ $album->artist->artist_name ?? 'Unknown' }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ============ VIDEOS ============ --}}
    @if($videos->count() > 0)
    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">
                    <span class="icon-badge"><i class="fa-solid fa-video"></i></span>
                    Videos
                </h2>
                <p class="section-sub">{{ $videos->count() }} found</p>
            </div>
        </div>

        <div class="grid grid-4">
            @foreach($videos as $video)
                <a href="{{ route('frontend.videos.show', $video->id) }}" class="music-card">
                    <div class="video-img-wrap">
                        @if($video->video_image_path && file_exists(storage_path('app/public/' . $video->video_image_path)))
                            <img src="{{ asset('storage/' . $video->video_image_path) }}" alt="{{ $video->video_title }}" class="music-img">
                        @elseif($video->video_youtube_id)
                            <img src="https://img.youtube.com/vi/{{ $video->video_youtube_id }}/hqdefault.jpg" alt="{{ $video->video_title }}" class="music-img">
                        @else
                            <img src="https://via.placeholder.com/640x360/0F172A/14B8A6?text=%F0%9F%8E%AC" alt="{{ $video->video_title }}" class="music-img">
                        @endif
                        <div class="video-overlay">
                            <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                        </div>
                        @if($video->video_duration)
                            <span class="badge-year">{{ $video->video_duration }}</span>
                        @endif
                    </div>
                    <div class="music-info">
                        <h3 class="music-title">{{ $video->video_title }}</h3>
                        <div class="music-artist">
                            <i class="fa-solid fa-user"></i>
                            {{ $video->artist->artist_name ?? 'Unknown' }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

@elseif($query)
    {{-- ============ NO RESULTS ============ --}}
    <div class="empty-state-wrap">
        <div class="empty-visual">
            <div class="empty-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="empty-pulse pulse-1"></div>
            <div class="empty-pulse pulse-2"></div>
            <div class="empty-pulse pulse-3"></div>
        </div>

        <h2 class="empty-title">No results found</h2>
        <p class="empty-desc">
            Humm... we couldn't find anything matching "<strong style="color: var(--accent);">{{ $query }}</strong>".
            Try a different keyword or explore our music.
        </p>

        <div class="empty-actions">
            <a href="{{ route('frontend.music') }}" class="btn-primary-glow">
                <span><i class="fa-solid fa-music me-2"></i> Browse Music</span>
            </a>
            <a href="{{ route('frontend.artists') }}" class="btn-ghost">
                <i class="fa-solid fa-microphone"></i> View Artists
            </a>
        </div>
    </div>
@else
    {{-- ============ SEARCH HINT ============ --}}
    <div class="empty-state-wrap">
        <div class="empty-visual">
            <div class="empty-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="empty-pulse pulse-1"></div>
            <div class="empty-pulse pulse-2"></div>
            <div class="empty-pulse pulse-3"></div>
        </div>

        <h2 class="empty-title">Start Searching</h2>
        <p class="empty-desc">
            Type in the search bar above to find music, artists, albums, and videos.
        </p>

        <div class="search-suggestions">
            <span class="sugg-label">Try searching for:</span>
            <div class="sugg-list">
                <a href="{{ route('frontend.search', ['q' => 'Atif']) }}" class="sugg-chip">Atif Aslam</a>
                <a href="{{ route('frontend.search', ['q' => 'Taylor']) }}" class="sugg-chip">Taylor Swift</a>
                <a href="{{ route('frontend.search', ['q' => 'Aadat']) }}" class="sugg-chip">Aadat</a>
                <a href="{{ route('frontend.search', ['q' => 'Ghoomar']) }}" class="sugg-chip">Ghoomar</a>
                <a href="{{ route('frontend.search', ['q' => 'Pop']) }}" class="sugg-chip">Pop</a>
            </div>
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
        font-size: 48px;
        font-weight: 800;
        line-height: 1.1;
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
        max-width: 620px;
        line-height: 1.7;
    }

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

    .section-sub { color: var(--gray); font-size: 13.5px; margin-top: 4px; }

    /* ============ GRID ============ */
    .grid { display: grid; gap: 20px; }
    .grid-4 { grid-template-columns: repeat(4, 1fr); }

    @media (max-width: 1100px) { .grid-4 { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px)  { .grid-4 { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px)  { .grid-4 { grid-template-columns: 1fr; } }

    /* ============ MUSIC/ALBUM/VIDEO CARD ============ */
    .music-card {
        display: block;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 12px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .music-card:hover {
        transform: translateY(-5px);
        border-color: rgba(20, 184, 166, 0.4);
        box-shadow: 0 15px 35px -18px rgba(20, 184, 166, 0.4);
    }

    .music-img-wrap,
    .video-img-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .video-img-wrap { aspect-ratio: 16 / 9; }

    .music-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .music-card:hover .music-img { transform: scale(1.08); }

    .music-overlay,
    .video-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 17, 26, 0.75), transparent 55%);
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .video-overlay {
        align-items: center;
        justify-content: center;
        background: rgba(8, 17, 26, 0.4);
    }

    .music-card:hover .music-overlay,
    .music-card:hover .video-overlay { opacity: 1; }

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

    .music-card:hover .play-btn { transform: translateY(0); }

    .badge-new {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 3px 9px;
        background: var(--primary);
        color: var(--bg);
        border-radius: 20px;
        font-size: 9.5px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        z-index: 2;
    }

    .badge-year {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 3px 9px;
        background: rgba(8, 17, 26, 0.85);
        border: 1px solid rgba(103, 232, 249, 0.3);
        color: var(--accent);
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
        backdrop-filter: blur(8px);
        z-index: 2;
    }

    .music-info { padding: 0 2px; }

    .music-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }

    .music-artist {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--gray);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .music-artist i { font-size: 10px; color: var(--primary); }

    /* ============ ARTIST BUBBLE ============ */
    .artist-row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 24px;
    }

    .artist-bubble {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .artist-bubble:hover { transform: translateY(-6px); }

    .artist-ring {
        position: relative;
        width: 130px;
        height: 130px;
        margin-bottom: 14px;
    }

    .artist-avatar {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid transparent;
        background: linear-gradient(var(--card), var(--card)) padding-box,
                    linear-gradient(135deg, var(--primary), var(--accent)) border-box;
        z-index: 2;
    }

    .artist-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .artist-bubble:hover .artist-avatar img { transform: scale(1.08); }

    .artist-glow {
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(20, 184, 166, 0.4), transparent 65%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 1;
    }

    .artist-bubble:hover .artist-glow { opacity: 1; }

    .artist-name-sm {
        font-size: 14px;
        font-weight: 700;
        color: var(--text);
        font-family: 'Space Grotesk', sans-serif;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 100%;
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

    .empty-icon {
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
        animation: iconPulse 2s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1);    }
        50%      { transform: scale(1.08); }
    }

    .empty-pulse {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 1.5px solid rgba(103, 232, 249, 0.5);
        animation: emptyPulse 2.4s ease-out infinite;
        pointer-events: none;
    }

    .empty-pulse.pulse-1 { animation-delay: 0s; }
    .empty-pulse.pulse-2 { animation-delay: 0.8s; }
    .empty-pulse.pulse-3 { animation-delay: 1.6s; }

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

    /* Suggestions */
    .search-suggestions {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid var(--card-border);
    }

    .sugg-label {
        display: block;
        color: var(--gray);
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .sugg-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
    }

    .sugg-chip {
        padding: 8px 16px;
        background: rgba(20, 184, 166, 0.08);
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 20px;
        color: var(--accent);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .sugg-chip:hover {
        background: var(--primary);
        color: var(--bg);
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .page-title { font-size: 32px; }
        .empty-title { font-size: 22px; }
    }

    @media (max-width: 576px) {
        .page-title { font-size: 26px; }
        .artist-row { grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .artist-ring { width: 90px; height: 90px; }
        .artist-name-sm { font-size: 12px; }
    }
</style>
@endpush