@extends('Frontend.layout')

@section('title', 'Albums')

@section('content')

<section class="page-header">
    <div class="page-tag">
        <i class="fa-solid fa-compact-disc"></i> All Albums
    </div>
    <h1 class="page-title">
        Explore <span class="page-gradient">Every Collection</span><br>
        In Our Library
    </h1>
    <p class="page-desc">
        Complete albums from legendary artists — stories told in every track.
    </p>

    <div class="page-stats">
        <div class="stat-item">
            <div class="stat-value">{{ $albums->count() }}</div>
            <div class="stat-label">Albums</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-value">{{ $albums->unique('album_artist_id')->count() }}</div>
            <div class="stat-label">Artists</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-value">{{ $albums->min('album_release_year') ?? '—' }}</div>
            <div class="stat-label">Earliest</div>
        </div>
    </div>
</section>

{{-- FILTER BAR --}}
<section class="filter-bar">
    <form action="{{ route('frontend.albums') }}" method="GET" class="filter-form">
        <div class="filter-group">
            <label class="filter-label"><i class="fa-solid fa-filter"></i> Filters</label>
        </div>

        <div class="filter-group">
            <select name="artist" class="filter-select" onchange="this.form.submit()">
                <option value="">All Artists</option>
                @foreach($artists as $a)
                    <option value="{{ $a->id }}" {{ request('artist') == $a->id ? 'selected' : '' }}>
                        {{ $a->artist_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <select name="year" class="filter-select" onchange="this.form.submit()">
                <option value="">All Years</option>
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <select name="sort" class="filter-select" onchange="this.form.submit()">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                <option value="year"   {{ request('sort') == 'year'   ? 'selected' : '' }}>Year (Newest)</option>
                <option value="az"     {{ request('sort') == 'az'     ? 'selected' : '' }}>Title (A-Z)</option>
                <option value="za"     {{ request('sort') == 'za'     ? 'selected' : '' }}>Title (Z-A)</option>
            </select>
        </div>

        @if(request('artist') || request('year') || (request('sort') && request('sort') != 'latest'))
            <a href="{{ route('frontend.albums') }}" class="filter-clear">
                <i class="fa-solid fa-xmark"></i> Clear
            </a>
        @endif
    </form>
</section>

@if($albums->count() > 0)
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">
                <span class="icon-badge"><i class="fa-solid fa-list"></i></span>
                All Albums
            </h2>
            <p class="section-sub">{{ $albums->count() }} {{ Str::plural('album', $albums->count()) }} available</p>
        </div>
    </div>

    <div class="albums-grid">
        @foreach($albums as $album)
            <a href="{{ route('frontend.albums.show', $album->id) }}" class="album-card">
                <div class="album-img-wrap">
                    @if($album->album_cover_image)
                        <img src="{{ asset('storage/' . $album->album_cover_image) }}"
                             alt="{{ $album->album_name }}"
                             class="album-img">
                    @else
                        <img src="https://via.placeholder.com/500x500/0F172A/14B8A6?text=%F0%9F%92%BF"
                             alt="{{ $album->album_name }}"
                             class="album-img">
                    @endif

                    <div class="album-overlay">
                        <div class="play-btn"><i class="fa-solid fa-play"></i></div>
                    </div>

                    @if($album->album_release_year)
                        <span class="badge-year">{{ $album->album_release_year }}</span>
                    @endif
                </div>

                <div class="album-info">
                    <h3 class="album-title">{{ $album->album_name }}</h3>
                    <div class="album-artist">
                        <i class="fa-solid fa-user"></i>
                        {{ $album->artist->artist_name ?? 'Unknown' }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@else
<div class="empty-state">
    <i class="fa-solid fa-compact-disc"></i>
    <h3>No albums found</h3>
    <p>
        @if(request('artist') || request('year'))
            Try changing your filters or <a href="{{ route('frontend.albums') }}" style="color: var(--accent); font-weight: 700;">clear all filters</a>.
        @else
            Albums will appear here once they're added.
        @endif
    </p>
</div>
@endif

@endsection

@push('styles')
<style>
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

    .page-stats { display: flex; align-items: center; gap: 32px; }

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

    .stat-divider { width: 1px; height: 40px; background: var(--card-border); }

    /* FILTER BAR */
    .filter-bar {
        background: var(--card);
        border: 1px solid var(--card-border);
        border-radius: 14px;
        padding: 14px 20px;
        margin-bottom: 32px;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }

    .filter-group { display: flex; align-items: center; }

    .filter-label {
        color: var(--gray);
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .filter-label i { color: var(--primary); }

    .filter-select {
        padding: 8px 32px 8px 14px;
        background: rgba(8, 17, 26, 0.7);
        border: 1px solid var(--card-border);
        border-radius: 10px;
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.25s ease;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.12);
    }

    .filter-select option { background: #0F172A; color: var(--text); }

    .filter-clear {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 10px;
        color: #FCA5A5;
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        margin-left: auto;
    }

    .filter-clear:hover { background: rgba(239, 68, 68, 0.2); color: white; }

    /* ALBUMS GRID */
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

    .album-card:hover .album-img { transform: scale(1.08); }

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
        z-index: 2;
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

    .album-artist i { font-size: 10px; color: var(--primary); }

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

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: var(--card);
        border: 1px dashed var(--card-border);
        border-radius: 18px;
    }

    .empty-state i {
        font-size: 60px;
        color: var(--gray);
        opacity: 0.4;
        margin-bottom: 20px;
    }

    .empty-state h3 { color: var(--text); margin-bottom: 8px; font-weight: 700; }
    .empty-state p { color: var(--gray); margin: 0; }

    @media (max-width: 768px) {
        .page-title { font-size: 34px; }
        .page-stats { gap: 16px; }
        .stat-value { font-size: 22px; }
        .filter-form { gap: 8px; }
        .filter-select { font-size: 12px; padding: 7px 28px 7px 12px; }
        .filter-clear { margin-left: 0; }
    }
</style>
@endpush