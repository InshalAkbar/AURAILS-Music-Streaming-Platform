@extends('Frontend.layout')

@section('title', 'Home')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero-section">
    <div class="hero-left">
        <div class="hero-tag">
            <i class="fa-solid fa-wave-square"></i> Sound Reimagined
        </div>
        <h1 class="hero-title">
            Feel Every<br>
            <span class="hero-gradient">Frequency</span><br>
            with Aurails.
        </h1>
        <p class="hero-desc">
            Discover, stream, and create the perfect sound for every moment.
            Your journey into a world of pure audio excellence starts here.
        </p>
        <div class="hero-actions">
            <a href="{{ route('frontend.music') }}" class="btn-primary-glow">
                <span><i class="fa-solid fa-play me-2"></i> Explore Sounds</span>
            </a>
            <a href="{{ route('frontend.artists') }}" class="btn-ghost">
                <i class="fa-solid fa-microphone"></i> Top Artists
            </a>
        </div>

        <div class="hero-stats">
            <div class="stat">
                <div class="stat-value">{{ $latestMusic->count() + 14 }}+</div>
                <div class="stat-label">Tracks</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <div class="stat-value">{{ $topArtists->count() + 10 }}+</div>
                <div class="stat-label">Artists</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <div class="stat-value">{{ $recentAlbums->count() + 10 }}+</div>
                <div class="stat-label">Albums</div>
            </div>
        </div>
    </div>

    <div class="hero-right">
        <div class="corner-label tl">AURAILS · 001</div>
        <div class="corner-label tr">LIVE · ORBIT</div>
        <div class="corner-label bl">drag to explore</div>
        <div class="corner-label br">48.0 kHz</div>

        <div class="orbit-stage">
            <div class="bars-orbit">
                @php $barCount = 64; @endphp
                @for($i = 0; $i < $barCount; $i++)
                    @php
                        $angle = ($i / $barCount) * 360;
                        $pattern = $i % 8;
                        $heightClass = 'bar-sm';
                        if ($pattern == 0 || $pattern == 4)      $heightClass = 'bar-xl';
                        elseif ($pattern == 1 || $pattern == 5)  $heightClass = 'bar-lg';
                        elseif ($pattern == 2 || $pattern == 6)  $heightClass = 'bar-md';
                        $delay = round(($i % 16) * 0.08, 2);
                    @endphp
                    <div class="bar-wrapper" style="transform: rotate({{ $angle }}deg);">
                        <div class="bar {{ $heightClass }}" style="animation-delay: {{ $delay }}s;"></div>
                    </div>
                @endfor
            </div>

            <div class="beat-icon">
                <div class="beat-glow"></div>
                <div class="beat-ring ring-1"></div>
                <div class="beat-ring ring-2"></div>
                <div class="beat-ring ring-3"></div>
                <div class="beat-icon-inner">
                    <i class="fa-solid fa-music"></i>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ LATEST MUSIC ============ --}}
@if($latestMusic->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-music"></i></span>
                Latest Music
            </h2>
            <p class="section-sub">Fresh tracks, handpicked for you</p>
        </div>
        <a href="{{ route('frontend.music') }}" class="view-all">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-4">
        @foreach($latestMusic as $music)
            <a href="{{ route('frontend.music.show', $music->id) }}" class="music-card card-dark">
                <div class="img-frame music-img">
                    @if($music->music_image_path)
                        <img src="{{ asset('storage/' . $music->music_image_path) }}" alt="{{ $music->music_title }}">
                    @else
                        <img src="https://via.placeholder.com/400x400/0F172A/14B8A6?text=%E2%99%AA" alt="{{ $music->music_title }}">
                    @endif
                    <div class="play-overlay">
                        <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                    </div>
                    @if($music->music_is_new == 'yes')
                        <span class="pill pill-new badge-corner">New</span>
                    @endif
                </div>
                <div class="music-meta">
                    <div class="music-title">{{ $music->music_title }}</div>
                    <div class="music-artist">
                        <i class="fa-solid fa-user"></i>
                        {{ $music->artist->artist_name ?? 'Unknown' }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- ============ TOP ARTISTS ============ --}}
@if($topArtists->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-microphone"></i></span>
                Top Artists
            </h2>
            <p class="section-sub">Voices that define our sound</p>
        </div>
        <a href="{{ route('frontend.artists') }}" class="view-all">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="artist-row">
        @foreach($topArtists as $artist)
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
                <div class="artist-tracks">{{ $artist->music_count ?? 0 }} tracks</div>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- ============ RECENT ALBUMS ============ --}}
@if($recentAlbums->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-compact-disc"></i></span>
                Fresh Albums
            </h2>
            <p class="section-sub">Complete collections worth exploring</p>
        </div>
        <a href="{{ route('frontend.albums') }}" class="view-all">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-4">
        @foreach($recentAlbums as $album)
            <a href="{{ route('frontend.albums.show', $album->id) }}" class="album-card card-dark">
                <div class="album-cover-wrap">
                    @if($album->album_cover_image)
                        <img src="{{ asset('storage/' . $album->album_cover_image) }}" alt="{{ $album->album_name }}" class="album-cover">
                    @else
                        <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%F0%9F%92%BF" alt="{{ $album->album_name }}" class="album-cover">
                    @endif
                </div>
                <div class="album-meta">
                    <div class="album-title">{{ $album->album_name }}</div>
                    <div class="album-artist">{{ $album->artist->artist_name ?? 'Unknown' }} · {{ $album->album_release_year }}</div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- ============ LATEST VIDEOS ============ --}}
@if($latestVideos->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-video"></i></span>
                Latest Videos
            </h2>
            <p class="section-sub">Watch music come alive</p>
        </div>
        <a href="{{ route('frontend.videos') }}" class="view-all">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-4">
        @foreach($latestVideos as $video)
            <a href="{{ route('frontend.videos.show', $video->id) }}" class="video-card card-dark">
                <div class="img-frame video-img">
                    @if($video->video_image_path && file_exists(storage_path('app/public/' . $video->video_image_path)))
                        <img src="{{ asset('storage/' . $video->video_image_path) }}" alt="{{ $video->video_title }}">
                    @elseif($video->video_youtube_id)
                        <img src="https://img.youtube.com/vi/{{ $video->video_youtube_id }}/hqdefault.jpg" alt="{{ $video->video_title }}">
                    @else
                        <img src="https://via.placeholder.com/640x360/0F172A/14B8A6?text=%F0%9F%8E%AC" alt="{{ $video->video_title }}">
                    @endif
                    <div class="video-play-overlay">
                        <div class="video-play-btn"><i class="fa-solid fa-play"></i></div>
                    </div>
                    @if($video->video_duration)
                        <span class="video-duration">{{ $video->video_duration }}</span>
                    @endif
                </div>
                <div class="music-meta">
                    <div class="music-title">{{ $video->video_title }}</div>
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

@endsection

@push('styles')
<style>
    /* HERO */
    .hero-section {
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        gap: 40px;
        align-items: center;
        padding: 30px 0 70px;
        min-height: 620px;
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
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 22px;
    }

    .hero-title {
        font-size: 58px;
        font-weight: 800;
        line-height: 1.05;
        color: var(--text);
        margin-bottom: 22px;
    }

    .hero-gradient {
        background: linear-gradient(120deg, var(--primary), var(--accent), var(--secondary));
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

    .hero-desc {
        font-size: 15.5px;
        color: var(--gray);
        line-height: 1.7;
        max-width: 500px;
        margin-bottom: 32px;
    }

    .hero-actions {
        display: flex;
        gap: 14px;
        margin-bottom: 42px;
        flex-wrap: wrap;
    }

    .hero-stats { display: flex; align-items: center; gap: 26px; }

    .stat-value {
        font-size: 26px;
        font-weight: 800;
        color: var(--accent);
        line-height: 1;
        font-family: 'Space Grotesk', sans-serif;
    }
    .stat-label {
        font-size: 12px;
        color: var(--gray);
        font-weight: 600;
        margin-top: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-divider { width: 1px; height: 40px; background: var(--card-border); }

    /* HERO RIGHT */
    .hero-right {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 560px;
        border-radius: 20px;
        overflow: hidden;
        background:
            radial-gradient(circle at 50% 50%, rgba(20, 184, 166, 0.10), transparent 55%),
            radial-gradient(circle at 30% 30%, rgba(103, 232, 249, 0.05), transparent 50%),
            radial-gradient(circle at 70% 70%, rgba(14, 165, 233, 0.05), transparent 50%);
    }

    .corner-label {
        position: absolute;
        font-family: 'Space Grotesk', monospace;
        font-size: 10.5px;
        color: #475569;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 700;
        z-index: 5;
    }
    .corner-label.tl { top: 18px; left: 20px; }
    .corner-label.tr { top: 18px; right: 20px; }
    .corner-label.bl { bottom: 18px; left: 20px; }
    .corner-label.br { bottom: 18px; right: 20px; }

    .orbit-stage {
        position: relative;
        width: 100%;
        max-width: 560px;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bars-orbit {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: slowRotate 90s linear infinite;
        will-change: transform;
    }
    @keyframes slowRotate {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    .bar-wrapper {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        transform-origin: 0 0;
    }

    .bar {
        position: absolute;
        left: -2.5px;
        top: -195px;
        width: 5px;
        background: linear-gradient(to top, #0D9488, #14B8A6, #67E8F9);
        border-radius: 4px;
        box-shadow: 0 0 8px rgba(20, 184, 166, 0.7), 0 0 16px rgba(103, 232, 249, 0.4);
        transform-origin: bottom center;
        animation: barBounce 1.4s ease-in-out infinite;
    }
    .bar-sm { height: 18px; }
    .bar-md { height: 30px; }
    .bar-lg { height: 44px; }
    .bar-xl { height: 58px; }

    @keyframes barBounce {
        0%   { transform: scaleY(0.5);  opacity: 0.55; }
        14%  { transform: scaleY(1);    opacity: 1;    }
        28%  { transform: scaleY(0.6);  opacity: 0.75; }
        42%  { transform: scaleY(0.9);  opacity: 0.95; }
        70%  { transform: scaleY(0.5);  opacity: 0.55; }
        100% { transform: scaleY(0.5);  opacity: 0.55; }
    }

    .beat-icon {
        position: relative;
        width: 160px;
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .beat-glow {
        position: absolute;
        inset: -30px;
        border-radius: 50%;
        background: radial-gradient(circle,
            rgba(20, 184, 166, 0.55) 0%,
            rgba(20, 184, 166, 0.15) 45%,
            transparent 70%);
        animation: glowBeat 1.4s ease-in-out infinite;
        pointer-events: none;
    }
    @keyframes glowBeat {
        0%, 100% { transform: scale(1);    opacity: 0.7; }
        14%      { transform: scale(1.25); opacity: 1;   }
        28%      { transform: scale(1);    opacity: 0.7; }
        45%      { transform: scale(1.15); opacity: 0.95;}
        65%      { transform: scale(1);    opacity: 0.7; }
    }

    .beat-icon-inner {
        position: relative;
        z-index: 5;
        color: #67E8F9;
        font-size: 76px;
        line-height: 1;
        filter:
            drop-shadow(0 0 15px rgba(103, 232, 249, 0.9))
            drop-shadow(0 0 30px rgba(20, 184, 166, 0.7))
            drop-shadow(0 0 50px rgba(20, 184, 166, 0.4));
        animation: iconBeat 1.4s ease-in-out infinite;
    }
    .beat-icon-inner i { display: block; }

    @keyframes iconBeat {
        0%   { transform: scale(1);    }
        14%  { transform: scale(1.18); }
        28%  { transform: scale(1);    }
        42%  { transform: scale(1.12); }
        70%  { transform: scale(1);    }
        100% { transform: scale(1);    }
    }

    .beat-ring {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 2px solid rgba(103, 232, 249, 0.6);
        animation: ringBeat 1.4s ease-out infinite;
        pointer-events: none;
    }
    .beat-ring.ring-1 { animation-delay: 0s; }
    .beat-ring.ring-2 { animation-delay: 0.47s; }
    .beat-ring.ring-3 { animation-delay: 0.94s; }

    @keyframes ringBeat {
        0%   { transform: scale(0.85); opacity: 0.9; }
        14%  { opacity: 0.5; }
        100% { transform: scale(2.2);  opacity: 0; }
    }

    /* GRID */
    .grid { display: grid; gap: 20px; }
    .grid-4 { grid-template-columns: repeat(4, 1fr); }

    @media (max-width: 1100px) { .grid-4 { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 768px)  { .grid-4 { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px)  { .grid-4 { grid-template-columns: 1fr; } }

    /* CARDS */
    .card-dark {
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        color: var(--text);
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
    }
    .card-dark:hover {
        background: var(--card-hover);
        border-color: rgba(20, 184, 166, 0.4);
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -20px rgba(20, 184, 166, 0.35);
    }

    .img-frame {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }
    .img-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .card-dark:hover .img-frame img { transform: scale(1.08); }

    /* MUSIC CARD */
    .music-card { display: block; padding: 14px; }
    .music-img { aspect-ratio: 1 / 1; border-radius: 12px; margin-bottom: 14px; }

    .play-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 17, 26, 0.75), transparent 60%);
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .music-card:hover .play-overlay { opacity: 1; }

    .play-btn {
        width: 44px;
        height: 44px;
        background: var(--primary);
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        box-shadow: var(--glow-teal);
        transform: translateY(10px);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .music-card:hover .play-btn { transform: translateY(0); }

    .badge-corner {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 3;
        background: rgba(8, 17, 26, 0.85);
        backdrop-filter: blur(8px);
        border: 1px solid var(--primary);
        color: var(--accent);
    }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .music-meta { padding: 0 2px; }

    .music-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }
    .music-artist {
        font-size: 12.5px;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 6px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .music-artist i { font-size: 10px; color: var(--primary); }

    /* ARTIST */
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
        margin-bottom: 3px;
        font-family: 'Space Grotesk', sans-serif;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 100%;
    }
    .artist-tracks {
        font-size: 11.5px;
        color: var(--gray);
        font-weight: 600;
    }

    /* ALBUM */
    .album-card { display: block; padding: 14px; }
    .album-cover-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 12px;
        margin-bottom: 16px;
        overflow: hidden;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }
    .album-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .album-card:hover .album-cover { transform: scale(1.08); }

    .album-meta { padding: 0 2px; }
    .album-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }
    .album-artist {
        font-size: 12px;
        color: var(--gray);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* VIDEO */
    .video-card { display: block; padding: 14px; }
    .video-img { aspect-ratio: 16 / 9; border-radius: 12px; margin-bottom: 14px; }
    .video-play-overlay {
        position: absolute;
        inset: 0;
        background: rgba(8, 17, 26, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .video-card:hover .video-play-overlay { opacity: 1; }
    .video-play-btn {
        width: 56px;
        height: 56px;
        background: rgba(20, 184, 166, 0.95);
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: var(--glow-teal);
        transform: scale(0.7);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .video-card:hover .video-play-btn { transform: scale(1); }
    .video-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(8, 17, 26, 0.9);
        color: var(--text);
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
    }

    /* SECTION */
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
    .section-sub { color: var(--gray); font-size: 13.5px; margin-top: 4px; }

    .view-all {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 10px;
        transition: all 0.25s ease;
    }
    .view-all:hover { color: var(--accent); background: rgba(20, 184, 166, 0.08); }

    /* RESPONSIVE */
    @media (max-width: 991px) {
        .hero-section {
            grid-template-columns: 1fr;
            text-align: center;
            padding: 20px 0 40px;
            min-height: auto;
        }
        .hero-left { display: flex; flex-direction: column; align-items: center; }
        .hero-title { font-size: 44px; }
        .hero-right { min-height: 420px; margin-top: 20px; }
        .orbit-stage { max-width: 420px; }
        .beat-icon { width: 130px; height: 130px; }
        .beat-icon-inner { font-size: 62px; }
        .hero-actions, .hero-stats { justify-content: center; }
    }

    @media (max-width: 576px) {
        .hero-title { font-size: 34px; }
        .hero-stats { gap: 16px; }
        .stat-value { font-size: 20px; }
        .hero-right { min-height: 340px; }
        .orbit-stage { max-width: 320px; }
        .beat-icon { width: 100px; height: 100px; }
        .beat-icon-inner { font-size: 46px; }
        .corner-label { font-size: 9px; }
        .artist-row { grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .artist-ring { width: 90px; height: 90px; }
        .artist-name-sm { font-size: 12px; }
        .artist-tracks { font-size: 10.5px; }
    }
</style>
@endpush