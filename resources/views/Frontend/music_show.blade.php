@extends('Frontend.layout')

@section('title', $item->music_title)

@section('content')

{{-- ============ MUSIC HERO ============ --}}
<section class="music-hero">
    <div class="music-hero-bg"></div>

    <div class="music-hero-content">
        {{-- Album Art --}}
        <div class="music-art-wrap">
            @if($item->music_image_path)
                <img src="{{ asset('storage/' . $item->music_image_path) }}"
                     alt="{{ $item->music_title }}"
                     class="music-art">
            @else
                <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%E2%99%AA"
                     alt="{{ $item->music_title }}"
                     class="music-art">
            @endif

            @if($item->music_is_new == 'yes')
                <span class="art-badge">New Release</span>
            @endif
        </div>

        {{-- Info --}}
        <div class="music-info-panel">
            <div class="hero-tag">
                <i class="fa-solid fa-music"></i>
                {{ $item->music_is_new == 'yes' ? 'Fresh Drop' : 'Classic Track' }}
            </div>

            <h1 class="music-hero-title">{{ $item->music_title }}</h1>

            <div class="hero-meta">
                <a href="{{ route('frontend.artists.show', $item->artist->id ?? '#') }}" class="meta-artist">
                    <i class="fa-solid fa-user"></i>
                    {{ $item->artist->artist_name ?? 'Unknown Artist' }}
                </a>

                @if($item->album)
                    <a href="{{ route('frontend.albums.show', $item->album->id) }}" class="meta-album">
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
                @if($item->music_year)
                    <span class="chip"><i class="fa-solid fa-calendar"></i> {{ $item->music_year }}</span>
                @endif
            </div>

            @if($item->music_description)
                <p class="music-hero-desc">{{ $item->music_description }}</p>
            @endif

            <div class="hero-actions">
                @if($item->music_youtube_id)
                    <a href="https://www.youtube.com/watch?v={{ $item->music_youtube_id }}"
                       target="_blank"
                       class="btn-primary-glow">
                        <span><i class="fa-brands fa-youtube me-2"></i> Watch on YouTube</span>
                    </a>
                @else
                    <button class="btn-primary-glow"
                            onclick="document.getElementById('audioPlayer') && document.getElementById('audioPlayer').play()">
                        <span><i class="fa-solid fa-play me-2"></i> Play Track</span>
                    </button>
                @endif

                <form action="{{ route('user.favorites.store') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="album_id" value="{{ $item->music_album_id }}">
                    <button type="submit" class="btn-ghost">
                        <i class="fa-solid fa-heart"></i> Add to Favorites
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ============ PLAYER ============ --}}
<section class="section player-section">
    <div class="player-card">
        @if($item->music_youtube_id)
            <div class="yt-embed-wrap">
                <iframe
                    class="yt-embed"
                    src="https://www.youtube.com/embed/{{ $item->music_youtube_id }}?rel=0&modestbranding=1"
                    title="{{ $item->music_title }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        @elseif($item->music_file_path)
            <div class="player-visual">
                <div class="player-wave">
                    @for($i = 0; $i < 40; $i++)
                        <span style="animation-delay: {{ $i * 0.05 }}s"></span>
                    @endfor
                </div>
            </div>
            <audio id="audioPlayer" controls class="audio-el">
                <source src="{{ asset('storage/' . $item->music_file_path) }}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        @else
            <div class="player-visual">
                <div class="player-wave">
                    @for($i = 0; $i < 40; $i++)
                        <span style="animation-delay: {{ $i * 0.05 }}s"></span>
                    @endfor
                </div>
            </div>
            <p class="player-note">
                <i class="fa-solid fa-circle-info"></i>
                Audio not available for this track yet.
            </p>
        @endif
    </div>
</section>

{{-- ============ DETAILS ============ --}}
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-circle-info"></i></span>
                Track Details
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
                <div class="detail-value">{{ $item->music_year ?? 'N/A' }}</div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-icon"><i class="fa-solid fa-star"></i></div>
            <div class="detail-info">
                <div class="detail-label">Status</div>
                <div class="detail-value">{{ $item->music_is_new == 'yes' ? 'New Release' : 'Classic' }}</div>
            </div>
        </div>
    </div>
</section>

{{-- ============ MORE FROM ARTIST ============ --}}
@php
    $moreFromArtist = \App\Models\Music::where('music_artist_id', $item->music_artist_id)
        ->where('id', '!=', $item->id)
        ->take(4)
        ->get();
@endphp

@if($moreFromArtist->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-headphones"></i></span>
                More from {{ $item->artist->artist_name }}
            </h2>
        </div>
        <a href="{{ route('frontend.artists.show', $item->artist->id) }}" class="view-all">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="music-grid">
        @foreach($moreFromArtist as $track)
            <a href="{{ route('frontend.music.show', $track->id) }}" class="music-card">
                <div class="music-img-wrap">
                    @if($track->music_image_path)
                        <img src="{{ asset('storage/' . $track->music_image_path) }}" alt="{{ $track->music_title }}" class="music-img">
                    @else
                        <img src="https://via.placeholder.com/400x400/0F172A/14B8A6?text=%E2%99%AA" alt="{{ $track->music_title }}" class="music-img">
                    @endif
                    <div class="music-overlay">
                        <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                    </div>
                </div>
                <div class="music-info">
                    <h3 class="music-title">{{ $track->music_title }}</h3>
                    <div class="music-artist">
                        <i class="fa-solid fa-user"></i>
                        {{ $track->music_year ?? 'N/A' }}
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
        ->where('review_media_type', 'music')
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
                            <input type="hidden" name="review_media_type" value="music">
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
                                          placeholder="Share your thoughts about this track..."
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


{{-- ============ SOCIAL SHARE ============ --}}
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-share-nodes"></i></span>
                Share This Track
            </h2>
        </div>
    </div>

    <div class="share-buttons-wrap">
        <button class="share-btn facebook" onclick="shareOn('facebook', '{{ url()->current() }}', '{{ $item->music_title }}')">
            <i class="fa-brands fa-facebook-f"></i> Facebook
        </button>
        <button class="share-btn twitter" onclick="shareOn('twitter', '{{ url()->current() }}', '{{ $item->music_title }}')">
            <i class="fa-brands fa-x-twitter"></i> Twitter
        </button>
        <button class="share-btn whatsapp" onclick="shareOn('whatsapp', '{{ url()->current() }}', '{{ $item->music_title }}')">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp
        </button>
        <button class="share-btn telegram" onclick="shareOn('telegram', '{{ url()->current() }}', '{{ $item->music_title }}')">
            <i class="fa-brands fa-telegram"></i> Telegram
        </button>
        <button class="share-btn linkedin" onclick="shareOn('linkedin', '{{ url()->current() }}', '{{ $item->music_title }}')">
            <i class="fa-brands fa-linkedin-in"></i> LinkedIn
        </button>
        <button class="share-btn copy" onclick="copyLink('{{ url()->current() }}')">
            <i class="fa-solid fa-link"></i> Copy Link
        </button>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* ============ MUSIC HERO ============ */
    .music-hero { position: relative; padding: 40px 0 60px; margin-bottom: 20px; }

    .music-hero-bg {
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

    .music-hero-content {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 48px;
        align-items: center;
    }

    .music-art-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(135deg, #0F172A, #1E293B);
        box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.8);
        transition: all 0.4s ease;
    }

    .music-art-wrap:hover { box-shadow: 0 35px 70px -20px rgba(20, 184, 166, 0.4); }

    .music-art {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .music-art-wrap:hover .music-art { transform: scale(1.05); }

    .art-badge {
        position: absolute;
        top: 16px; left: 16px;
        padding: 6px 14px;
        background: var(--primary);
        color: var(--bg);
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 8px 20px rgba(20, 184, 166, 0.5);
    }

    .music-info-panel { position: relative; z-index: 3; }

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

    .music-hero-title {
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
        margin-bottom: 20px;
    }

    .meta-artist, .meta-album {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent);
        text-decoration: none;
        font-size: 15px;
        font-weight: 700;
        transition: color 0.25s ease;
    }

    .meta-artist i, .meta-album i { font-size: 13px; }
    .meta-artist:hover, .meta-album:hover { color: var(--primary); }

    .hero-chips { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 22px; }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid var(--card-border);
        border-radius: 20px;
        color: var(--gray);
        font-size: 12.5px;
        font-weight: 600;
    }

    .chip i { color: var(--primary); font-size: 11px; }

    .music-hero-desc {
        font-size: 15px;
        color: var(--gray);
        line-height: 1.75;
        max-width: 640px;
        margin-bottom: 30px;
    }

    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ============ PLAYER ============ */
    .player-section { margin-top: 10px; }

    .player-card {
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 28px 30px;
        position: relative;
        overflow: hidden;
    }

    .player-visual { margin-bottom: 20px; }

    .player-wave {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        height: 40px;
    }

    .player-wave span {
        width: 3px;
        background: linear-gradient(to top, var(--primary), var(--accent));
        border-radius: 3px;
        height: 30%;
        animation: waveAnim 1.4s ease-in-out infinite;
    }

    @keyframes waveAnim {
        0%, 100% { height: 20%; opacity: 0.5; }
        50%      { height: 90%; opacity: 1; }
    }

    .audio-el { width: 100%; outline: none; border-radius: 12px; }

    .player-note {
        margin-top: 14px;
        text-align: center;
        color: var(--gray);
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .player-note i { color: var(--accent); }

    .yt-embed-wrap {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        border-radius: 14px;
        overflow: hidden;
        background: #000;
        box-shadow: 0 20px 50px -20px rgba(0, 0, 0, 0.7);
    }

    .yt-embed {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    /* ============ DETAILS GRID ============ */
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 16px;
    }

    .detail-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
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
        width: 44px;
        height: 44px;
        background: rgba(20, 184, 166, 0.1);
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 16px;
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
        font-size: 15px;
        color: var(--text);
        font-weight: 700;
        font-family: 'Space Grotesk', sans-serif;
    }

    /* ============ MUSIC GRID ============ */
    .music-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 18px;
    }

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

    .music-img-wrap {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .music-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .music-card:hover .music-img { transform: scale(1.08); }

    .music-overlay {
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

    .music-card:hover .music-overlay { opacity: 1; }

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

    .already-review p {
        color: var(--gray);
        font-size: 14px;
        line-height: 1.6;
        margin: 10px 0;
    }

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

    .login-prompt i {
        font-size: 32px;
        color: var(--gray);
        opacity: 0.5;
        margin-bottom: 14px;
    }

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

    .review-stars {
        display: flex;
        gap: 3px;
        font-size: 12px;
        color: #F59E0B;
        margin-bottom: 8px;
    }

    .review-text { color: var(--gray); font-size: 13.5px; line-height: 1.6; margin: 0; }

    .no-reviews { text-align: center; padding: 60px 20px; }

    .no-reviews i {
        font-size: 48px;
        color: var(--gray);
        opacity: 0.4;
        margin-bottom: 16px;
    }

    .no-reviews h4 {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 8px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .no-reviews p { color: var(--gray); font-size: 14px; margin: 0; }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 991px) {
        .music-hero-content { grid-template-columns: 1fr; gap: 32px; text-align: center; }
        .music-art-wrap { max-width: 280px; margin: 0 auto; }
        .music-hero-title { font-size: 38px; }
        .hero-meta, .hero-chips, .hero-actions { justify-content: center; }
        .music-hero-desc { margin-left: auto; margin-right: auto; }
        .details-grid { grid-template-columns: repeat(2, 1fr); }
        .reviews-layout { grid-template-columns: 1fr; }
    }

    @media (max-width: 576px) {
        .music-hero-title { font-size: 28px; }
        .music-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .music-card { padding: 10px; }
        .details-grid { grid-template-columns: 1fr; }
        .player-card { padding: 20px 18px; }
        .reviews-right { padding: 18px; }
        .review-avatar { width: 36px; height: 36px; font-size: 14px; }
        .rating-number { font-size: 42px; }
    }
        /* ============ SOCIAL SHARE ============ */
    .share-buttons-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 22px;
        border: 1px solid var(--card-border);
        background: var(--card);
        color: var(--text);
        border-radius: 12px;
        font-weight: 700;
        font-size: 13.5px;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .share-btn i { font-size: 15px; }

    .share-btn:hover {
        transform: translateY(-3px);
        color: #FFFFFF;
    }

    .share-btn.facebook:hover {
        background: #1877F2;
        border-color: #1877F2;
        box-shadow: 0 10px 25px -8px rgba(24, 119, 242, 0.5);
    }

    .share-btn.twitter:hover {
        background: #000000;
        border-color: #333;
        box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.5);
    }

    .share-btn.whatsapp:hover {
        background: #25D366;
        border-color: #25D366;
        box-shadow: 0 10px 25px -8px rgba(37, 211, 102, 0.5);
    }

    .share-btn.telegram:hover {
        background: #0088CC;
        border-color: #0088CC;
        box-shadow: 0 10px 25px -8px rgba(0, 136, 204, 0.5);
    }

    .share-btn.linkedin:hover {
        background: #0A66C2;
        border-color: #0A66C2;
        box-shadow: 0 10px 25px -8px rgba(10, 102, 194, 0.5);
    }

    .share-btn.copy:hover {
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        border-color: var(--primary);
        color: var(--bg);
        box-shadow: 0 10px 25px -8px rgba(20, 184, 166, 0.5);
    }
</style>
@endpush