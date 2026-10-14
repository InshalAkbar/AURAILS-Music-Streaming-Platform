@extends('Frontend.layout')

@section('title', 'My Profile')

@section('content')

{{-- ============ PROFILE HERO ============ --}}
<section class="profile-hero">
    <div class="profile-hero-bg"></div>

    <div class="profile-hero-inner">
        <div class="profile-avatar-wrap">
            <div class="profile-avatar-large">
                @if($user->user_image)
                    <img src="{{ asset('storage/' . $user->user_image) }}"
                         alt="{{ $user->user_name }}"
                         class="avatar-img-display">
                @else
                    {{ strtoupper(substr($user->user_name ?? 'U', 0, 1)) }}
                @endif
            </div>

            <label for="quickAvatarInput" class="avatar-upload-btn" title="Change photo">
                <i class="fa-solid fa-camera"></i>
            </label>
            <input type="file" id="quickAvatarInput" accept="image/*" style="display:none;"
                   onchange="document.getElementById('quickAvatarForm').submit();">

            <form id="quickAvatarForm" action="{{ route('user.profile.avatar') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                @csrf
                <input type="file" name="user_image" id="quickAvatarFormFile">
            </form>

            <div class="avatar-ring"></div>
        </div>

        <div class="profile-hero-info">
            <div class="hero-tag">
                <i class="fa-solid fa-user"></i> My Account
            </div>
            <h1 class="profile-hero-name">{{ $user->user_name }}</h1>
            <p class="profile-hero-email">
                <i class="fa-solid fa-envelope"></i> {{ $user->user_email }}
            </p>

            <div class="profile-hero-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $favoritesCount }}</div>
                    <div class="stat-label">Favorites</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-value">{{ $reviewsCount }}</div>
                    <div class="stat-label">Reviews</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-value">{{ $user->created_at->format('M Y') }}</div>
                    <div class="stat-label">Joined</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ TABS ============ --}}
<div class="profile-tabs">
    <button class="tab-btn active" onclick="switchTab(event, 'info')">
        <i class="fa-solid fa-user-pen"></i> Profile Info
    </button>
    <button class="tab-btn" onclick="switchTab(event, 'password')">
        <i class="fa-solid fa-lock"></i> Password
    </button>
    <button class="tab-btn" onclick="switchTab(event, 'activity')">
        <i class="fa-solid fa-chart-simple"></i> Activity
    </button>
</div>

{{-- Alerts --}}
@if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-error">
        <i class="fa-solid fa-circle-exclamation"></i>
        {{ session('error') }}
    </div>
@endif

{{-- ============ TAB 1: INFO ============ --}}
<div class="tab-content active" id="tab-info">
    <section class="section">

        {{-- PROFILE PICTURE UPLOAD CARD --}}
        <div class="form-card" style="margin-bottom: 24px;">
            <div class="form-card-header">
                <h2 class="form-card-title">
                    <span class="icon-badge"><i class="fa-solid fa-camera"></i></span>
                    Profile Picture
                </h2>
                <p class="form-card-sub">Upload a photo to personalize your account</p>
            </div>

            <div class="avatar-upload-area">
                <div class="avatar-preview-wrap">
                    <div class="avatar-preview">
                        @if($user->user_image)
                            <img src="{{ asset('storage/' . $user->user_image) }}" alt="{{ $user->user_name }}" id="avatarPreview">
                        @else
                            <div class="avatar-preview-letter" id="avatarLetter">
                                {{ strtoupper(substr($user->user_name ?? 'U', 0, 1)) }}
                            </div>
                            <img src="" alt="" id="avatarPreview" style="display:none;">
                        @endif
                    </div>
                </div>

                <div class="avatar-upload-actions">
                    <form action="{{ route('user.profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                        @csrf
                        <input type="file" name="user_image" id="avatarInput" accept="image/*" style="display:none;" onchange="previewAvatar(event)">
                        <label for="avatarInput" class="btn-submit" style="cursor:pointer;">
                            <i class="fa-solid fa-upload"></i> Choose Photo
                        </label>
                        <button type="submit" class="btn-submit" style="margin-left:8px;">
                            <i class="fa-solid fa-check"></i> Save Photo
                        </button>
                    </form>

                    @if($user->user_image)
                        <form action="{{ route('user.profile.avatar.remove') }}" method="POST" style="display:inline-block; margin-top:12px;" onsubmit="return confirm('Remove profile picture?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove-avatar">
                                <i class="fa-solid fa-trash"></i> Remove Current Photo
                            </button>
                        </form>
                    @endif

                    <p class="avatar-hint">
                        <i class="fa-solid fa-circle-info"></i>
                        JPG, PNG, or WebP · Max 2MB · Square images look best
                    </p>
                </div>
            </div>
        </div>

        {{-- PROFILE INFO CARD --}}
        <div class="form-card">
            <div class="form-card-header">
                <h2 class="form-card-title">
                    <span class="icon-badge"><i class="fa-solid fa-user-pen"></i></span>
                    Profile Information
                </h2>
                <p class="form-card-sub">Update your personal details</p>
            </div>

            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" name="user_name" class="form-input @error('user_name') is-invalid @enderror"
                               value="{{ old('user_name', $user->user_name) }}" required>
                    </div>
                    @error('user_name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" class="form-input" value="{{ $user->user_email }}" disabled>
                    </div>
                    <small class="form-hint">Email cannot be changed</small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-phone input-icon"></i>
                            <input type="text" name="user_phone" class="form-input"
                                   value="{{ old('user_phone', $user->user_phone) }}"
                                   placeholder="Optional">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-location-dot input-icon"></i>
                            <input type="text" name="user_address" class="form-input"
                                   value="{{ old('user_address', $user->user_address) }}"
                                   placeholder="Optional">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </section>
</div>

{{-- ============ TAB 2: PASSWORD ============ --}}
<div class="tab-content" id="tab-password">
    <section class="section">
        <div class="form-card">
            <div class="form-card-header">
                <h2 class="form-card-title">
                    <span class="icon-badge"><i class="fa-solid fa-lock"></i></span>
                    Change Password
                </h2>
                <p class="form-card-sub">Keep your account secure</p>
            </div>

            <form action="{{ route('user.profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Current Password <span class="text-danger">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-key input-icon"></i>
                        <input type="password" name="current_password" class="form-input" required
                               placeholder="Enter current password">
                    </div>
                    @error('current_password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">New Password <span class="text-danger">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" class="form-input" required
                               placeholder="Min. 6 characters">
                    </div>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password_confirmation" class="form-input" required
                               placeholder="Repeat new password">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-shield-halved"></i> Update Password
                </button>
            </form>
        </div>
    </section>
</div>

{{-- ============ TAB 3: ACTIVITY ============ --}}
<div class="tab-content" id="tab-activity">

    @if($favoriteAlbums->count() > 0)
    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">
                    <span class="icon-badge"><i class="fa-solid fa-heart"></i></span>
                    Recent Favorites
                </h2>
                <p class="section-sub">Albums you've saved</p>
            </div>
            <a href="{{ route('frontend.favorites') }}" class="view-all">
                View All <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="mini-grid">
            @foreach($favoriteAlbums as $fav)
                @if($fav->album)
                <a href="{{ route('frontend.albums.show', $fav->album->id) }}" class="mini-card">
                    <div class="mini-card-img">
                        @if($fav->album->album_cover_image)
                            <img src="{{ asset('storage/' . $fav->album->album_cover_image) }}" alt="{{ $fav->album->album_name }}">
                        @else
                            <img src="https://via.placeholder.com/300x300/0F172A/14B8A6?text=%F0%9F%92%BF" alt="{{ $fav->album->album_name }}">
                        @endif
                    </div>
                    <div class="mini-card-info">
                        <div class="mini-card-title">{{ $fav->album->album_name }}</div>
                        <div class="mini-card-sub">{{ $fav->album->artist->artist_name ?? 'Unknown' }}</div>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
    </section>
    @endif

    @if($recentReviews->count() > 0)
    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">
                    <span class="icon-badge"><i class="fa-solid fa-star"></i></span>
                    Recent Reviews
                </h2>
                <p class="section-sub">Your latest activity</p>
            </div>
        </div>

        <div class="reviews-mini-list">
            @foreach($recentReviews as $review)
                <div class="review-mini-item">
                    <div class="review-mini-icon">
                        <i class="fa-solid fa-{{ $review->review_media_type == 'music' ? 'music' : 'video' }}"></i>
                    </div>
                    <div class="review-mini-body">
                        <div class="review-mini-head">
                            <span class="review-mini-type">{{ ucfirst($review->review_media_type) }}</span>
                            <span class="review-mini-date">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="review-mini-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $review->review_rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                            @endfor
                        </div>
                        <p class="review-mini-text">{{ Str::limit($review->review_text, 120) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if($favoriteAlbums->count() == 0 && $recentReviews->count() == 0)
    <section class="section">
        <div class="empty-state">
            <i class="fa-solid fa-chart-simple"></i>
            <h3>No activity yet</h3>
            <p>Start exploring music, save favorites, and write reviews to see your activity here.</p>
            <div class="empty-actions">
                <a href="{{ route('frontend.music') }}" class="btn-primary-glow">
                    <span><i class="fa-solid fa-music me-2"></i> Explore Music</span>
                </a>
            </div>
        </div>
    </section>
    @endif
</div>

@endsection

@push('styles')
<style>
    /* ============ PROFILE HERO ============ */
    .profile-hero {
        position: relative;
        padding: 40px 0 50px;
        margin-bottom: 20px;
    }

    .profile-hero-bg {
        position: absolute;
        top: 0; left: -24px; right: -24px;
        height: 340px;
        background:
            radial-gradient(ellipse at 30% 30%, rgba(20, 184, 166, 0.15), transparent 55%),
            radial-gradient(ellipse at 70% 70%, rgba(103, 232, 249, 0.1), transparent 55%);
        filter: blur(40px);
        z-index: -1;
        pointer-events: none;
    }

    .profile-hero-inner {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 40px;
        align-items: center;
    }

    .profile-avatar-wrap {
        position: relative;
        width: 180px;
        height: 180px;
    }

    .profile-avatar-large {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Space Grotesk', sans-serif;
        font-size: 72px;
        font-weight: 800;
        z-index: 2;
        box-shadow: 0 20px 50px -15px rgba(20, 184, 166, 0.6);
        overflow: hidden;
    }

    .avatar-img-display {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .avatar-ring {
        position: absolute;
        inset: -10px;
        border-radius: 50%;
        border: 2px dashed rgba(103, 232, 249, 0.4);
        animation: spinRing 20s linear infinite;
        pointer-events: none;
    }

    @keyframes spinRing {
        to { transform: rotate(360deg); }
    }

    .avatar-upload-btn {
        position: absolute;
        bottom: 8px;
        right: 8px;
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: var(--bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        z-index: 5;
        border: 3px solid var(--bg);
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(20, 184, 166, 0.5);
    }

    .avatar-upload-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(20, 184, 166, 0.8);
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
        margin-bottom: 14px;
    }

    .profile-hero-name {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.1;
        color: var(--text);
        margin-bottom: 10px;
        font-family: 'Space Grotesk', sans-serif;
        letter-spacing: -0.02em;
    }

    .profile-hero-email {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--gray);
        font-size: 14.5px;
        margin-bottom: 24px;
    }

    .profile-hero-email i { color: var(--primary); font-size: 13px; }

    .profile-hero-stats {
        display: flex;
        align-items: center;
        gap: 28px;
    }

    .stat-value {
        font-size: 28px;
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

    /* ============ TABS ============ */
    .profile-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 30px;
        border-bottom: 1px solid var(--card-border);
        flex-wrap: wrap;
    }

    .tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: transparent;
        border: none;
        border-bottom: 2px solid transparent;
        color: var(--gray);
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.25s ease;
        margin-bottom: -1px;
    }

    .tab-btn i { font-size: 13px; }
    .tab-btn:hover { color: var(--accent); }
    .tab-btn.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
    }

    .tab-content { display: none; animation: fadeIn 0.3s ease; }
    .tab-content.active { display: block; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ============ FORM CARD ============ */
    .form-card {
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 18px;
        padding: 32px 34px;
        max-width: 720px;
    }

    .form-card-header { margin-bottom: 28px; }

    .form-card-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .form-card-title .icon-badge {
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

    .form-card-sub {
        color: var(--gray);
        font-size: 13.5px;
        margin-top: 4px;
    }

    /* ============ AVATAR UPLOAD ============ */
    .avatar-upload-area {
        display: flex;
        gap: 32px;
        align-items: center;
        flex-wrap: wrap;
    }

    .avatar-preview-wrap {
        flex-shrink: 0;
    }

    .avatar-preview {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid rgba(20, 184, 166, 0.4);
        box-shadow: 0 15px 40px -12px rgba(20, 184, 166, 0.5);
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-preview-letter {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 56px;
        font-weight: 800;
        color: var(--bg);
    }

    .avatar-upload-actions { flex: 1; min-width: 250px; }

    .btn-remove-avatar {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: rgba(239, 68, 68, 0.12);
        border: 1px solid rgba(239, 68, 68, 0.35);
        border-radius: 10px;
        color: #FCA5A5;
        font-size: 13.5px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .btn-remove-avatar:hover {
        background: rgba(239, 68, 68, 0.25);
        color: white;
    }

    .avatar-hint {
        color: var(--gray);
        font-size: 12.5px;
        margin-top: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .avatar-hint i { color: var(--accent); }

    /* ============ FORM ============ */
    .form-group { margin-bottom: 18px; }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 576px) {
        .form-row { grid-template-columns: 1fr; gap: 0; }
    }

    .form-label {
        display: block;
        color: var(--text);
        font-size: 12.5px;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .text-danger { color: #F87171; }

    .input-wrap { position: relative; }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        font-size: 14px;
        pointer-events: none;
        transition: color 0.25s ease;
    }

    .form-input {
        width: 100%;
        padding: 13px 16px 13px 44px;
        background: rgba(8, 17, 26, 0.7);
        border: 1px solid var(--card-border);
        border-radius: 11px;
        color: var(--text);
        font-size: 14px;
        font-family: inherit;
        transition: all 0.25s ease;
    }

    .form-input::placeholder { color: rgba(148, 163, 184, 0.4); }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        background: rgba(8, 17, 26, 0.95);
        box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.12);
    }

    .form-input:disabled { opacity: 0.6; cursor: not-allowed; }

    .input-wrap:focus-within .input-icon { color: var(--primary); }

    .form-error {
        color: #F87171;
        font-size: 12.5px;
        margin-top: 6px;
        font-weight: 600;
    }

    .form-hint {
        display: block;
        color: var(--gray);
        font-size: 12px;
        margin-top: 6px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 26px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: var(--bg);
        border: none;
        border-radius: 11px;
        font-size: 14.5px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 8px 24px -8px rgba(20, 184, 166, 0.5);
        margin-top: 8px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px -8px rgba(20, 184, 166, 0.7);
    }

    /* ============ ALERTS ============ */
    .alert-success,
    .alert-error {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 22px;
        font-size: 14px;
        font-weight: 600;
        max-width: 720px;
    }

    .alert-success {
        background: rgba(20, 184, 166, 0.12);
        border: 1px solid rgba(20, 184, 166, 0.35);
        color: var(--accent);
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.12);
        border: 1px solid rgba(239, 68, 68, 0.35);
        color: #FCA5A5;
    }

    /* ============ MINI CARDS ============ */
    .mini-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }

    .mini-card {
        display: block;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 12px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .mini-card:hover {
        transform: translateY(-5px);
        border-color: rgba(20, 184, 166, 0.4);
        box-shadow: 0 15px 35px -18px rgba(20, 184, 166, 0.4);
    }

    .mini-card-img {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #0F172A, #1E293B);
    }

    .mini-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .mini-card:hover .mini-card-img img { transform: scale(1.08); }

    .mini-card-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Space Grotesk', sans-serif;
    }

    .mini-card-sub {
        font-size: 12px;
        color: var(--gray);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ============ REVIEWS MINI ============ */
    .reviews-mini-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .review-mini-item {
        display: flex;
        gap: 16px;
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 18px 20px;
        transition: all 0.3s ease;
    }

    .review-mini-item:hover {
        border-color: rgba(20, 184, 166, 0.35);
        transform: translateX(4px);
    }

    .review-mini-icon {
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

    .review-mini-body { flex-grow: 1; min-width: 0; }

    .review-mini-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .review-mini-type {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--accent);
    }

    .review-mini-date {
        font-size: 11.5px;
        color: var(--gray);
        font-weight: 600;
    }

    .review-mini-stars {
        display: flex;
        gap: 3px;
        color: #F59E0B;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .review-mini-text {
        color: var(--gray);
        font-size: 13.5px;
        line-height: 1.6;
        margin: 0;
    }

    /* ============ SECTION ============ */
    .section { margin-bottom: 42px; }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .section-title {
        font-size: 22px;
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

    .section-sub { color: var(--gray); font-size: 13px; margin-top: 4px; }

    .view-all {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 10px;
        transition: all 0.25s ease;
    }

    .view-all:hover {
        color: var(--accent);
        background: rgba(20, 184, 166, 0.08);
    }

    /* ============ EMPTY ============ */
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
        font-family: 'Space Grotesk', sans-serif;
    }

    .empty-state p { color: var(--gray); margin: 0 0 22px; font-size: 14px; }

    .empty-actions { display: flex; justify-content: center; gap: 12px; }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .profile-hero-inner {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 24px;
        }
        .profile-avatar-wrap {
            width: 140px;
            height: 140px;
            margin: 0 auto;
        }
        .profile-avatar-large { font-size: 56px; }
        .profile-hero-name { font-size: 34px; }
        .profile-hero-stats { justify-content: center; }
        .form-card { padding: 24px 20px; }
        .tab-btn { padding: 10px 14px; font-size: 13px; }
        .avatar-upload-area { flex-direction: column; text-align: center; }
    }

    @media (max-width: 480px) {
        .mini-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    }
</style>
@endpush

@push('scripts')
<script>
function switchTab(event, tabName) {
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    event.currentTarget.classList.add('active');
    document.getElementById('tab-' + tabName).classList.add('active');
}

function previewAvatar(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById('avatarPreview');
        const letter = document.getElementById('avatarLetter');
        preview.src = e.target.result;
        preview.style.display = 'block';
        if (letter) letter.style.display = 'none';
    };
    reader.readAsDataURL(file);
}

// Quick avatar upload from hero section
document.addEventListener('DOMContentLoaded', function() {
    const quickInput = document.getElementById('quickAvatarInput');
    const quickForm = document.getElementById('quickAvatarForm');
    const quickFile = document.getElementById('quickAvatarFormFile');

    if (quickInput && quickForm && quickFile) {
        quickInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const dt = new DataTransfer();
                dt.items.add(e.target.files[0]);
                quickFile.files = dt.files;
                quickForm.submit();
            }
        });
    }
});
</script>
@endpush