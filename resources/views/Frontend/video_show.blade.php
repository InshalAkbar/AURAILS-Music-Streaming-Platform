@extends('Frontend.layout')

@section('title', $item->video_title)

@section('content')

{{-- ============ VIDEO HERO ============ --}}
<section class="video-hero">
    <div class="video-hero-bg"></div>

    <div class="video-hero-content">

        {{-- LEFT: Video Player --}}
        <div class="video-player-wrap">
            @if($item->video_youtube_id)
                <div class="yt-embed-wrap yt-lazy" onclick="loadYoutube(this, '{{ $item->video_youtube_id }}')">
                    @if($item->video_image_path && file_exists(storage_path('app/public/' . $item->video_image_path)))
                        <img src="{{ asset('storage/' . $item->video_image_path) }}"
                             alt="{{ $item->video_title }}" class="yt-thumb">
                    @else
                        <img src="https://img.youtube.com/vi/{{ $item->video_youtube_id }}/maxresdefault.jpg"
                             alt="{{ $item->video_title }}" class="yt-thumb"
                             onerror="this.src='https://img.youtube.com/vi/{{ $item->video_youtube_id }}/hqdefault.jpg'">
                    @endif

                    <div class="yt-play-overlay">
                        <div class="yt-play-btn"><i class="fa-solid fa-play"></i></div>
                        <div class="yt-play-label">Click to Play</div>
                    </div>

                    <div class="yt-brand">
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                </div>
            @elseif($item->video_file_path)
                <video controls class="video-el" poster="{{ $item->video_image_path ? asset('storage/' . $item->video_image_path) : '' }}">
                    <source src="{{ asset('storage/' . $item->video_file_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                <div class="video-placeholder">
                    @if($item->video_image_path)
                        <img src="{{ asset('storage/' . $item->video_image_path) }}" alt="{{ $item->video_title }}">
                    @endif
                    <div class="placeholder-overlay">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>Video not available yet</p>
                    </div>
                </div>
            @endif

            @if($item->video_youtube_id)
                <div class="yt-fallback-hint">
                    <i class="fa-solid fa-circle-info"></i>
                    Video nahi chal rahi?
                    <a href="https://www.youtube.com/watch?v={{ $item->video_youtube_id }}" target="_blank">
                        YouTube pe dekho <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
            @endif
        </div>

        {{-- RIGHT: Info Panel --}}
        <div class="video-info-panel">
            <div class="hero-tag">
                <i class="fa-solid fa-video"></i>
                {{ $item->video_is_new == 'yes' ? 'New Video' : 'Official Video' }}
            </div>

            <h1 class="video-hero-title">{{ $item->video_title }}</h1>

            <div class="hero-meta">
                <a href="{{ route('frontend.artists.show', $item->artist->id ?? '#') }}" class="meta-link">
                    <i class="fa-solid fa-user"></i>
                    {{ $item->artist->artist_name ?? 'Unknown Artist' }}
                </a>
                @if($item->album)
                    <a href="{{ route('frontend.albums.show', $item->album->id) }}" class="meta-link">
                        <i class="fa-solid fa-compact-disc"></i>
                        {{ $item->album->album_name }}
                    </a>
                @endif
            </div>

            <div class="hero-chips">
                @if($item->genre)
                    <span class="chip"><i class="fa-solid fa-tag"></i> {{ $item->genre->genre_name }}</span>
                @endif
                @if($item->language)
                    <span class="chip"><i class="fa-solid fa-globe"></i> {{ $item->language->language_name }}</span>
                @endif
                @if($item->video_year)
                    <span class="chip"><i class="fa-solid fa-calendar"></i> {{ $item->video_year }}</span>
                @endif
                @if($item->video_duration)
                    <span class="chip"><i class="fa-solid fa-clock"></i> {{ $item->video_duration }}</span>
                @endif
            </div>

            @if($item->video_description)
                <p class="video-hero-desc">{{ $item->video_description }}</p>
            @endif

            <div class="hero-actions">
                @if($item->video_youtube_id)
                    <a href="https://www.youtube.com/watch?v={{ $item->video_youtube_id }}"
                       target="_blank"
                       class="btn-primary-glow">
                        <span><i class="fa-brands fa-youtube me-2"></i> Watch on YouTube</span>
                    </a>
                @endif

                @auth
                    <form action="{{ route('user.favorites.store') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $item->video_album_id }}">
                        <button type="submit" class="btn-ghost">
                            <i class="fa-solid fa-heart"></i> Add to Favorites
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</section>

{{-- ============ DETAILS ============ --}}
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-circle-info"></i></span>
                Video Details
            </h2>
        </div>
    </div>

    <div class="details-grid">
        <div class="detail-card">
            <div class="detail-icon"><i class="fa-solid fa-user"></i></div>
            <div class="detail-info">
                <div class="detail-label">Artist</div>
                <div class="detail-value">{{ $item->artist->artist_name ?? 'N/A' }}</div>
            </div>
        </div>
        <div class="detail-card">
            <div class="detail-icon"><i class="fa-solid fa-compact-disc"></i></div>
            <div class="detail-info">
                <div class="detail-label">Album</div>
                <div class="detail-value">{{ $item->album->album_name ?? 'Single' }}</div>
            </div>
        </div>
        <div class="detail-card">
            <div class="detail-icon"><i class="fa-solid fa-tag"></i></div>
            <div class="detail-info">
                <div class="detail-label">Genre</div>
                <div class="detail-value">{{ $item->genre->genre_name ?? 'N/A' }}</div>
            </div>
        </div>
        <div class="detail-card">
            <div class="detail-icon"><i class="fa-solid fa-globe"></i></div>
            <div class="detail-info">
                <div class="detail-label">Language</div>
                <div class="detail-value">{{ $item->language->language_name ?? 'N/A' }}</div>
            </div>
        </div>
        <div class="detail-card">
            <div class="detail-icon"><i class="fa-solid fa-calendar"></i></div>
            <div class="detail-info">
                <div class="detail-label">Release Year</div>
                <div class="detail-value">{{ $item->video_year ?? 'N/A' }}</div>
            </div>
        </div>
        <div class="detail-card">
            <div class="detail-icon"><i class="fa-solid fa-clock"></i></div>
            <div class="detail-info">
                <div class="detail-label">Duration</div>
                <div class="detail-value">{{ $item->video_duration ?? 'N/A' }}</div>
            </div>
        </div>
    </div>
</section>

{{-- ============ MORE VIDEOS ============ --}}
@php
    $moreVideos = \App\Models\Video::with('artist')
        ->where('id', '!=', $item->id)
        ->where('video_artist_id', $item->video_artist_id)
        ->take(3)
        ->get();

    if ($moreVideos->count() < 3) {
        $additional = \App\Models\Video::with('artist')
            ->where('id', '!=', $item->id)
            ->whereNotIn('id', $moreVideos->pluck('id'))
            ->take(3 - $moreVideos->count())
            ->get();
        $moreVideos = $moreVideos->merge($additional);
    }
@endphp

@if($moreVideos->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-play-circle"></i></span>
                More Videos
            </h2>
        </div>
        <a href="{{ route('frontend.videos') }}" class="view-all">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="videos-grid">
        @foreach($moreVideos as $video)
            <a href="{{ route('frontend.videos.show', $video->id) }}" class="video-card">
                <div class="video-img-wrap">
                    @if($video->video_image_path && file_exists(storage_path('app/public/' . $video->video_image_path)))
                        <img src="{{ asset('storage/' . $video->video_image_path) }}" alt="{{ $video->video_title }}" class="video-img">
                    @elseif($video->video_youtube_id)
                        <img src="https://img.youtube.com/vi/{{ $video->video_youtube_id }}/hqdefault.jpg" alt="{{ $video->video_title }}" class="video-img">
                    @else
                        <img src="https://via.placeholder.com/640x360/0F172A/14B8A6?text=%F0%9F%8E%AC" alt="{{ $video->video_title }}" class="video-img">
                    @endif
                    <div class="video-overlay">
                        <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                    </div>
                    @if($video->video_duration)
                        <span class="video-duration">{{ $video->video_duration }}</span>
                    @endif
                </div>
                <div class="video-info">
                    <h3 class="video-title">{{ $video->video_title }}</h3>
                    <div class="video-artist">
                        <i class="fa-solid fa-user"></i>
                        {{ $video->artist->artist_name ?? 'Unknown' }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- ============ REVIEWS ============ --}}
@php
    $reviews = \App\Models\Review::with('user')
        ->where('review_media_type', 'video')
        ->where('review_media_id', $item->id)
        ->latest()
        ->get();

    $avgRating = $reviews->avg('review_rating') ?? 0;
    $userReview = Auth::check()
        ? $reviews->where('review_user_id', Auth::id())->first()
        : null;
@endphp

<section class="section reviews-section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-star"></i></span>
                Reviews
            </h2>
            <p class="section-sub">{{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }}</p>
        </div>
    </div>

    <div class="reviews-layout">
        {{-- Left --}}
        <div class="reviews-left">
            <div class="rating-summary">
                <div class="rating-big">
                    <div class="rating-number">{{ number_format($avgRating, 1) }}</div>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgRating))
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="rating-count">{{ $reviews->count() }} ratings</div>
                </div>
            </div>

            @auth
                @if($userReview)
                    <div class="review-already">
                        <div class="already-header">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>You've already reviewed this</span>
                        </div>
                        <div class="already-review">
                            <div class="already-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $userReview->review_rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <p>{{ $userReview->review_text }}</p>
                            <form action="{{ route('user.reviews.destroy', $userReview->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove-review" onclick="return confirm('Delete your review?')">
                                    <i class="fa-solid fa-trash"></i> Delete Review
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="review-form-wrap">
                        <div class="form-header">
                            <i class="fa-solid fa-pen"></i>
                            <span>Write a Review</span>
                        </div>
                        <form action="{{ route('user.reviews.store') }}" method="POST" class="review-form">
                            @csrf
                            <input type="hidden" name="review_media_type" value="video">
                            <input type="hidden" name="review_media_id" value="{{ $item->id }}">

                            <div class="form-group">
                                <label class="form-label">Your Rating</label>
                                <div class="star-input">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" name="review_rating" id="star{{ $i }}" value="{{ $i }}" required>
                                        <label for="star{{ $i }}" title="{{ $i }} star">
                                            <i class="fa-solid fa-star"></i>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Your Review</label>
                                <textarea name="review_text" rows="4"
                                          class="form-textarea"
                                          placeholder="Share your thoughts about this video..."
                                          maxlength="1000"
                                          required>{{ old('review_text') }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit-review">
                                <i class="fa-solid fa-paper-plane"></i> Submit Review
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="login-prompt">
                    <i class="fa-solid fa-lock"></i>
                    <p>Sign in to write a review</p>
                    <a href="{{ route('user.login') }}" class="btn-primary-glow">
                        <span><i class="fa-solid fa-right-to-bracket me-2"></i> Login</span>
                    </a>
                </div>
            @endauth
        </div>

        {{-- Right --}}
        <div class="reviews-right">
            @if($reviews->count() > 0)
                <div class="reviews-list">
                    @foreach($reviews as $review)
                        <div class="review-item">
                            <div class="review-avatar">
                                {{ strtoupper(substr($review->user->user_name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="review-body">
                                <div class="review-head">
                                    <div class="review-user">{{ $review->user->user_name ?? 'Anonymous' }}</div>
                                    <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $review->review_rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                    @endfor
                                </div>
                                <p class="review-text">{{ $review->review_text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-reviews">
                    <i class="fa-regular fa-comment-dots"></i>
                    <h4>No reviews yet</h4>
                    <p>Be the first to share your thoughts!</p>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ============ VIDEO HERO ============ */
    .video-hero { position: relative; padding: 40px 0 60px; margin-bottom: 20px; }

    .video-hero-bg {
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

    .video-hero-content {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .video-player-wrap {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        background: #000;
        box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.8);
    }

    .yt-embed-wrap {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        background: #000;
    }

    .yt-embed {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .yt-lazy {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        cursor: pointer;
        overflow: hidden;
        border-radius: 18px;
    }

    .yt-thumb {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .yt-lazy:hover .yt-thumb { transform: scale(1.05); }

    .yt-play-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.2));
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 16px;
        transition: background 0.3s ease;
    }

    .yt-lazy:hover .yt-play-overlay {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.85), rgba(20, 184, 166, 0.2));
    }

    .yt-play-btn {
        width: 82px;
        height: 82px;
        background: var(--primary);
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 12px 40px rgba(20, 184, 166, 0.6);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease;
        padding-left: 6px;
    }

    .yt-lazy:hover .yt-play-btn {
        transform: scale(1.12);
        box-shadow: 0 15px 55px rgba(20, 184, 166, 0.9);
    }

    .yt-play-label {
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        background: rgba(8, 17, 26, 0.75);
        padding: 8px 18px;
        border-radius: 30px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(103, 232, 249, 0.3);
    }

    .yt-brand {
        position: absolute;
        bottom: 16px;
        right: 16px;
        width: 42px;
        height: 42px;
        background: rgba(255, 0, 0, 0.95);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5);
        z-index: 3;
    }

    .yt-fallback-hint {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 16px;
        margin-top: 14px;
        background: rgba(20, 184, 166, 0.08);
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 12px;
        font-size: 13px;
        color: var(--gray);
    }

    .yt-fallback-hint i { color: var(--accent); font-size: 13px; }

    .yt-fallback-hint a {
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.25s ease;
    }

    .yt-fallback-hint a:hover { color: var(--accent); }
    .yt-fallback-hint a i { font-size: 10px; color: inherit; }

    .video-el { width: 100%; display: block; background: #000; }

    .video-placeholder {
        position: relative;
        aspect-ratio: 16 / 9;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .video-placeholder img { width: 100%; height: 100%; object-fit: cover; }

    .placeholder-overlay {
        position: absolute;
        inset: 0;
        background: rgba(8, 17, 26, 0.7);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        gap: 12px;
    }

    .placeholder-overlay i { font-size: 40px; color: var(--accent); }
    .placeholder-overlay p { margin: 0; font-size: 14px; }

    .video-info-panel { position: relative; z-index: 3; }

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

    .video-hero-title {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.1;
        color: var(--text);
        margin-bottom: 18px;
        font-family: 'Space Grotesk', sans-serif;
        letter-spacing: -0.02em;
    }

    .hero-meta { display: flex; flex-wrap: wrap; gap: 18px; margin-bottom: 18px; }

    .meta-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent);
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: color 0.25s ease;
    }

    .meta-link i { font-size: 12px; }
    .meta-link:hover { color: var(--primary); }

    .hero-chips { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid var(--card-border);
        border-radius: 20px;
        color: var(--gray);
        font-size: 12px;
        font-weight: 600;
    }

    .chip i { color: var(--primary); font-size: 10px; }

    .video-hero-desc { font-size: 14.5px; color: var(--gray); line-height: 1.7; margin-bottom: 24px; }

    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ============ DETAILS GRID ============ */
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 14px;
    }

    .detail-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 18px;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        border-color: rgba(20, 184, 166, 0.35);
        transform: translateY(-3px);
        box-shadow: 0 12px 30px -15px rgba(20, 184, 166, 0.35);
    }

    .detail-icon {
        width: 42px;
        height: 42px;
        background: rgba(20, 184, 166, 0.1);
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 15px;
        flex-shrink: 0;
    }

    .detail-label {
        font-size: 11px;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .detail-value {
        font-size: 14.5px;
        color: var(--text);
        font-weight: 700;
        font-family: 'Space Grotesk', sans-serif;
    }

    /* ============ VIDEOS GRID ============ */
    .videos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 18px;
    }

    .video-card {
        display: block;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 10px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .video-card:hover {
        transform: translateY(-5px);
        border-color: rgba(20, 184, 166, 0.4);
        box-shadow: 0 15px 35px -18px rgba(20, 184, 166, 0.4);
    }

    .video-img-wrap {
        position: relative;
        aspect-ratio: 16 / 9;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .video-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .video-card:hover .video-img { transform: scale(1.08); }

    .video-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 17, 26, 0.6), transparent 55%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .video-card:hover .video-overlay { opacity: 1; }

    .play-btn {
        width: 52px;
        height: 52px;
        background: rgba(20, 184, 166, 0.95);
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        box-shadow: 0 8px 30px rgba(20, 184, 166, 0.6);
        transform: scale(0.7);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        padding-left: 3px;
    }

    .video-card:hover .play-btn { transform: scale(1); }

    .video-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        padding: 3px 8px;
        background: rgba(8, 17, 26, 0.9);
        color: var(--text);
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }

    .video-info { padding: 0 4px; }

    .video-title {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }

    .video-artist {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: var(--gray);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .video-artist i { font-size: 10px; color: var(--primary); }

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

    /* ============ REVIEWS SECTION ============ */
    .reviews-section { margin-top: 50px; }

    .reviews-layout {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 28px;
        align-items: start;
    }

    .reviews-left { display: flex; flex-direction: column; gap: 20px; }

    .rating-summary {
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 28px;
        text-align: center;
    }

    .rating-number {
        font-size: 56px;
        font-weight: 800;
        color: var(--accent);
        line-height: 1;
        font-family: 'Space Grotesk', sans-serif;
        margin-bottom: 12px;
    }

    .rating-stars {
        display: flex;
        justify-content: center;
        gap: 6px;
        font-size: 22px;
        color: #F59E0B;
        margin-bottom: 10px;
    }

    .rating-count { color: var(--gray); font-size: 13px; font-weight: 600; }

    .review-form-wrap {
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 24px;
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text);
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 18px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .form-header i { color: var(--primary); }

    .form-group { margin-bottom: 16px; }

    .form-label {
        display: block;
        color: var(--gray);
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .star-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 4px;
    }

    .star-input input { display: none; }

    .star-input label {
        cursor: pointer;
        font-size: 26px;
        color: rgba(148, 163, 184, 0.3);
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .star-input input:checked ~ label,
    .star-input label:hover,
    .star-input label:hover ~ label {
        color: #F59E0B;
        transform: scale(1.1);
    }

    .form-textarea {
        width: 100%;
        padding: 12px 14px;
        background: rgba(8, 17, 26, 0.7);
        border: 1px solid var(--card-border);
        border-radius: 10px;
        color: var(--text);
        font-family: inherit;
        font-size: 14px;
        resize: vertical;
        transition: all 0.25s ease;
    }

    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.12);
    }

    .form-textarea::placeholder { color: rgba(148, 163, 184, 0.4); }

    .btn-submit-review {
        width: 100%;
        padding: 12px 20px;
        background: var(--primary);
        color: var(--bg);
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        font-family: inherit;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px -8px rgba(20, 184, 166, 0.5);
    }

    .btn-submit-review:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 12px 28px -8px rgba(20, 184, 166, 0.7);
    }

    .review-already {
        background: var(--card);
        border: 1px solid rgba(20, 184, 166, 0.35);
        border-radius: 16px;
        padding: 22px;
    }

    .already-header {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--accent);
        font-weight: 700;
        font-size: 13.5px;
        margin-bottom: 14px;
    }

    .already-review p { color: var(--gray); font-size: 14px; line-height: 1.6; margin: 10px 0; }
    .already-stars { display: flex; gap: 4px; font-size: 16px; color: #F59E0B; }

    .btn-remove-review {
        padding: 8px 14px;
        background: rgba(239, 68, 68, 0.15);
        color: #FCA5A5;
        border: 1px solid rgba(239, 68, 68, 0.35);
        border-radius: 8px;
        font-weight: 600;
        font-size: 12.5px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s ease;
    }

    .btn-remove-review:hover { background: rgba(239, 68, 68, 0.25); color: white; }

    .login-prompt {
        background: var(--card);
        border: 1px dashed var(--card-border);
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
    }

    .login-prompt i { font-size: 32px; color: var(--gray); opacity: 0.5; margin-bottom: 14px; }
    .login-prompt p { color: var(--gray); font-size: 14px; margin-bottom: 18px; }

    .reviews-right {
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 24px;
    }

    .reviews-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-height: 620px;
        overflow-y: auto;
        padding-right: 8px;
    }

    .reviews-list::-webkit-scrollbar { width: 6px; }
    .reviews-list::-webkit-scrollbar-track { background: transparent; }
    .reviews-list::-webkit-scrollbar-thumb { background: var(--card-border); border-radius: 3px; }

    .review-item {
        display: flex;
        gap: 14px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--card-border);
    }

    .review-item:last-child { border-bottom: none; padding-bottom: 0; }

    .review-avatar {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 16px;
        flex-shrink: 0;
        font-family: 'Space Grotesk', sans-serif;
    }

    .review-body { flex-grow: 1; min-width: 0; }

    .review-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 6px;
    }

    .review-user {
        font-weight: 700;
        color: var(--text);
        font-size: 14px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .review-date { color: var(--gray); font-size: 11.5px; font-weight: 600; }
    .review-stars { display: flex; gap: 3px; font-size: 12px; color: #F59E0B; margin-bottom: 8px; }
    .review-text { color: var(--gray); font-size: 13.5px; line-height: 1.6; margin: 0; }

    .no-reviews { text-align: center; padding: 60px 20px; }
    .no-reviews i { font-size: 48px; color: var(--gray); opacity: 0.4; margin-bottom: 16px; }
    .no-reviews h4 { color: var(--text); font-weight: 700; margin-bottom: 8px; font-family: 'Space Grotesk', sans-serif; }
    .no-reviews p { color: var(--gray); font-size: 14px; margin: 0; }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 991px) {
        .video-hero-content { grid-template-columns: 1fr; gap: 30px; }
        .video-hero-title { font-size: 28px; }
        .reviews-layout { grid-template-columns: 1fr; }
    }

    @media (max-width: 576px) {
        .video-hero-title { font-size: 24px; }
        .videos-grid { grid-template-columns: 1fr; gap: 14px; }
        .details-grid { grid-template-columns: 1fr; }
        .yt-play-btn { width: 62px; height: 62px; font-size: 22px; }
        .reviews-right { padding: 18px; }
        .review-avatar { width: 36px; height: 36px; font-size: 14px; }
        .rating-number { font-size: 42px; }
    }
</style>
@endpush

@push('scripts')
<script>
function loadYoutube(el, videoId) {
    const iframe = document.createElement('iframe');
    iframe.className = 'yt-embed';
    iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0&modestbranding=1';
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
    iframe.setAttribute('allowfullscreen', 'true');
    iframe.style.position = 'absolute';
    iframe.style.top = '0';
    iframe.style.left = '0';
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    iframe.style.border = 'none';

    el.innerHTML = '';
    el.appendChild(iframe);
    el.style.cursor = 'default';
    el.classList.remove('yt-lazy');
}
</script>
@endpush