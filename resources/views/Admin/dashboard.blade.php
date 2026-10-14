@extends('Admin.master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('main')
<div class="container-fluid">

    <!-- Welcome Banner -->
    <div class="welcome-banner mb-4">
        <div>
            <h2 class="welcome-title mb-1">
                Welcome back, <span class="welcome-name">{{ Auth::user()->user_name ?? 'Admin' }}</span> 👋
            </h2>
            <p class="welcome-sub mb-0">Here's what's happening with Aurails today.</p>
        </div>
        <div class="welcome-icon">
            <i class="bi bi-soundwave"></i>
        </div>
    </div>

    <!-- KPI Cards Row 1 -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #14B8A6, #0D9488);">
                    <div class="kpi-value">{{ $musicCount }}</div>
                    <div class="kpi-label">Total Music</div>
                    <div class="kpi-icon"><i class="bi bi-music-note-beamed"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(20, 184, 166, 0.15); color: #67E8F9;">
                    <span>All tracks</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #0EA5E9, #0284C7);">
                    <div class="kpi-value">{{ $artistCount }}</div>
                    <div class="kpi-label">Total Artists</div>
                    <div class="kpi-icon"><i class="bi bi-mic"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(14, 165, 233, 0.15); color: #7DD3FC;">
                    <span>Registered</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #22D3EE, #06B6D4);">
                    <div class="kpi-value">{{ $albumCount }}</div>
                    <div class="kpi-label">Total Albums</div>
                    <div class="kpi-icon"><i class="bi bi-journal-album"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(34, 211, 238, 0.15); color: #67E8F9;">
                    <span>Published</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #0F766E, #115E59);">
                    <div class="kpi-value">{{ $videoCount }}</div>
                    <div class="kpi-label">Total Videos</div>
                    <div class="kpi-icon"><i class="bi bi-camera-video"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(15, 118, 110, 0.2); color: #5EEAD4;">
                    <span>Uploaded</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Cards Row 2 -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #8B5CF6, #7C3AED);">
                    <div class="kpi-value">{{ $userCount }}</div>
                    <div class="kpi-label">Total Users</div>
                    <div class="kpi-icon"><i class="bi bi-people"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(139, 92, 246, 0.15); color: #C4B5FD;">
                    <span>Registered</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #F59E0B, #D97706);">
                    <div class="kpi-value">{{ $reviewCount }}</div>
                    <div class="kpi-label">Total Reviews</div>
                    <div class="kpi-icon"><i class="bi bi-star"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(245, 158, 11, 0.15); color: #FCD34D;">
                    <span>Community</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #EC4899, #DB2777);">
                    <div class="kpi-value">{{ $genreCount }}</div>
                    <div class="kpi-label">Genres</div>
                    <div class="kpi-icon"><i class="bi bi-tags"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(236, 72, 153, 0.15); color: #F9A8D4;">
                    <span>Categories</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-body" style="background: linear-gradient(135deg, #10B981, #059669);">
                    <div class="kpi-value">{{ $languageCount }}</div>
                    <div class="kpi-label">Languages</div>
                    <div class="kpi-icon"><i class="bi bi-translate"></i></div>
                </div>
                <div class="kpi-footer" style="background: rgba(16, 185, 129, 0.15); color: #6EE7B7;">
                    <span>Available</span>
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 chart-title">Music Release Activity</h6>
                    <span class="badge-trend">
                        <i class="bi bi-graph-up-arrow"></i> By Year
                    </span>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <canvas id="activityChart"></canvas>
                    </div>
                    <div class="chart-footer">
                        <div>
                            <div class="chart-foot-value">{{ $musicCount }}</div>
                            <div class="chart-foot-label">Total Tracks</div>
                        </div>
                        <div>
                            <div class="chart-foot-value">{{ count($songsByYearRaw) }}</div>
                            <div class="chart-foot-label">Active Years</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0 chart-title">Content Distribution</h6>
                </div>
                <div class="card-body text-center">
                    <div class="donut-wrapper">
                        <canvas id="distributionChart"></canvas>
                    </div>
                    <div class="donut-legend mt-3">
                        <div class="legend-item"><span class="dot" style="background:#14B8A6;"></span> Music</div>
                        <div class="legend-item"><span class="dot" style="background:#0EA5E9;"></span> Albums</div>
                        <div class="legend-item"><span class="dot" style="background:#67E8F9;"></span> Videos</div>
                        <div class="legend-item"><span class="dot" style="background:#8B5CF6;"></span> Artists</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 chart-title">Top Artists</h6>
                    <a href="{{ route('admin.artists.index') }}" class="view-all-link">View All →</a>
                </div>
                <div class="card-body">
                    @php $maxCount = $topArtists->max('music_count') ?: 1; @endphp
                    @forelse($topArtists as $artist)
                        <div class="artist-row-dash">
                            <div class="artist-info-dash">
                                <span class="artist-name-dash">{{ $artist->artist_name }}</span>
                                <span class="artist-count-dash">{{ $artist->music_count }} songs</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill-teal" style="width: {{ ($artist->music_count / $maxCount) * 100 }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--gray); text-align: center;">No artists yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

        <!-- Analytics Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0 chart-title">Songs by Genre</h6>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <canvas id="genreChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 chart-title">Review Ratings Distribution</h6>
                    <span class="badge-trend">
                        <i class="bi bi-star-fill"></i> Avg: {{ number_format($avgRating, 1) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <canvas id="ratingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Lists Row -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0" style="font-weight: 700;">
                        <i class="bi bi-people me-2" style="color: #8B5CF6;"></i>Recent Users
                    </h6>
                    <a href="{{ route('admin.users.index') }}" class="view-all-link">View All →</a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($recentUsers as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    @if($user->user_image && file_exists(storage_path('app/public/' . $user->user_image)))
                                        <img src="{{ asset('storage/' . $user->user_image) }}"
                                             style="width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid rgba(20,184,166,0.4);"
                                             alt="{{ $user->user_name }}">
                                    @else
                                        <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#14B8A6,#0EA5E9);color:#08111A;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;">
                                            {{ strtoupper(substr($user->user_name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                    <span>{{ $user->user_name }}</span>
                                </div>
                                <span class="pill-badge">{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center" style="color: var(--gray);">No users yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0" style="font-weight: 700;">
                        <i class="bi bi-star me-2" style="color: #F59E0B;"></i>Recent Reviews
                    </h6>
                    <a href="{{ route('admin.reviews.index') }}" class="view-all-link">View All →</a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($recentReviews as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ \Illuminate\Support\Str::limit($item->review_text, 40) }}</span>
                                <span class="pill-badge rating">{{ $item->review_rating }} ⭐</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center" style="color: var(--gray);">No reviews yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #0F172A 0%, #0B1E2C 100%);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 24px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%; right: -50%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(20, 184, 166, 0.15), transparent 70%);
        pointer-events: none;
    }

    .welcome-title { color: var(--text); font-weight: 800; font-size: 22px; }
    .welcome-name { color: var(--accent); }
    .welcome-sub { color: var(--gray); font-size: 13.5px; }
    .welcome-icon { font-size: 38px; color: var(--primary); position: relative; z-index: 1; }

    .kpi-card {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(20, 184, 166, 0.2);
    }

    .kpi-body {
        padding: 20px 20px 18px;
        position: relative;
        overflow: hidden;
        color: #08111A;
        flex-grow: 1;
    }

    .kpi-body::after {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 120px; height: 120px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }

    .kpi-value {
        font-size: 34px;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 6px;
        color: #08111A;
        font-family: 'Space Grotesk', sans-serif;
    }

    .kpi-label {
        font-size: 13.5px;
        font-weight: 600;
        opacity: 0.85;
        color: #08111A;
    }

    .kpi-icon {
        position: absolute;
        top: 20px; right: 20px;
        font-size: 24px;
        width: 46px; height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.18);
        border-radius: 12px;
        color: #08111A;
    }

    .kpi-footer {
        padding: 10px 20px;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        justify-content: space-between;
        align-items: center;
        letter-spacing: 0.3px;
    }

    .chart-title { color: var(--text); font-weight: 700; font-size: 15px; }

    .badge-trend {
        background: rgba(20, 184, 166, 0.15);
        color: var(--accent);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .chart-wrapper { height: 220px; position: relative; margin-bottom: 16px; }

    .chart-footer {
        display: flex;
        justify-content: space-around;
        padding-top: 16px;
        border-top: 1px solid var(--card-border);
    }

    .chart-foot-value {
        font-size: 22px;
        font-weight: 800;
        color: var(--accent);
        text-align: center;
        font-family: 'Space Grotesk', sans-serif;
    }

    .chart-foot-label {
        font-size: 12px;
        color: var(--gray);
        text-align: center;
        font-weight: 600;
    }

    .donut-wrapper {
        height: 180px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .donut-legend {
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: var(--text);
        font-weight: 600;
    }

    .legend-item .dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .artist-row-dash { margin-bottom: 18px; }
    .artist-row-dash:last-child { margin-bottom: 0; }

    .artist-info-dash {
        display: flex;
        justify-content: space-between;
        margin-bottom: 6px;
        font-size: 13px;
    }

    .artist-name-dash {
        color: var(--text);
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 65%;
    }

    .artist-count-dash { color: var(--accent); font-weight: 700; }

    .progress-track {
        background: rgba(148, 163, 184, 0.15);
        height: 6px;
        border-radius: 6px;
        overflow: hidden;
    }

    .progress-fill-teal {
        background: linear-gradient(90deg, #14B8A6, #67E8F9);
        height: 100%;
        border-radius: 6px;
        transition: width 0.6s ease;
        box-shadow: 0 0 10px rgba(20, 184, 166, 0.4);
    }

    .list-group-item {
        background-color: transparent !important;
        color: var(--text) !important;
        border-color: var(--card-border) !important;
        padding: 14px 20px;
        font-size: 14px;
        transition: 0.2s;
    }

    .list-group-item:hover {
        background-color: rgba(20, 184, 166, 0.04) !important;
    }

    .pill-badge {
        background: var(--primary);
        color: #08111A;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 12px;
    }

    .pill-badge.rating { background: #F59E0B; }

    .view-all-link {
        color: var(--primary);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s;
    }

    .view-all-link:hover { color: var(--accent); }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Chart.defaults.color = '#94A3B8';
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";

    // Line Chart
    const yearData  = @json(array_keys($songsByYearRaw));
    const yearCount = @json(array_values($songsByYearRaw));

    const ctxLine = document.getElementById('activityChart').getContext('2d');
    const gradientLine = ctxLine.createLinearGradient(0, 0, 0, 220);
    gradientLine.addColorStop(0, 'rgba(20, 184, 166, 0.45)');
    gradientLine.addColorStop(1, 'rgba(20, 184, 166, 0.02)');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: yearData,
            datasets: [{
                label: 'Songs',
                data: yearCount,
                borderColor: '#14B8A6',
                backgroundColor: gradientLine,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#67E8F9',
                pointBorderColor: '#14B8A6',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0F172A',
                    borderColor: '#1E293B',
                    borderWidth: 1,
                    titleColor: '#67E8F9',
                    bodyColor: '#E5E7EB',
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(30, 41, 59, 0.5)', drawBorder: false },
                    ticks: { color: '#94A3B8', font: { size: 11, weight: '600' } }
                },
                y: {
                    grid: { color: 'rgba(30, 41, 59, 0.5)', drawBorder: false },
                    ticks: { color: '#94A3B8', font: { size: 11, weight: '600' }, stepSize: 1, precision: 0 },
                    beginAtZero: true
                }
            }
        }
    });

    // Donut Chart with 4 categories
    const ctxDonut = document.getElementById('distributionChart').getContext('2d');
    new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: ['Music', 'Albums', 'Videos', 'Artists'],
            datasets: [{
                data: [{{ $musicCount }}, {{ $albumCount }}, {{ $videoCount }}, {{ $artistCount }}],
                backgroundColor: ['#14B8A6', '#0EA5E9', '#67E8F9', '#8B5CF6'],
                borderColor: '#0F172A',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0F172A',
                    borderColor: '#1E293B',
                    borderWidth: 1,
                    titleColor: '#67E8F9',
                    bodyColor: '#E5E7EB',
                    padding: 12,
                    cornerRadius: 8,
                }
            }
        }
    });
});
    // Genre Chart (Bar)
    const genreLabels = @json($songsByGenre->pluck('name'));
    const genreCounts = @json($songsByGenre->pluck('count'));

    if (genreLabels.length > 0) {
        const ctxGenre = document.getElementById('genreChart').getContext('2d');
        new Chart(ctxGenre, {
            type: 'bar',
            data: {
                labels: genreLabels,
                datasets: [{
                    label: 'Songs',
                    data: genreCounts,
                    backgroundColor: [
                        '#14B8A6', '#0EA5E9', '#67E8F9', '#8B5CF6', '#EC4899',
                        '#F59E0B', '#10B981', '#EF4444', '#6366F1', '#F97316'
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0F172A',
                        borderColor: '#1E293B',
                        borderWidth: 1,
                        titleColor: '#67E8F9',
                        bodyColor: '#E5E7EB',
                        padding: 12,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94A3B8', font: { size: 11, weight: '600' } }
                    },
                    y: {
                        grid: { color: 'rgba(30, 41, 59, 0.5)', drawBorder: false },
                        ticks: { color: '#94A3B8', font: { size: 11, weight: '600' }, stepSize: 1, precision: 0 },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Rating Chart (Doughnut)
    const ratingData = @json(array_values($reviewsByRating));
    const ctxRating = document.getElementById('ratingChart').getContext('2d');
    new Chart(ctxRating, {
        type: 'doughnut',
        data: {
            labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
            datasets: [{
                data: ratingData,
                backgroundColor: ['#EF4444', '#F97316', '#F59E0B', '#22D3EE', '#14B8A6'],
                borderColor: '#0F172A',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#E5E7EB',
                        font: { size: 12, weight: '600' },
                        padding: 12,
                        boxWidth: 12,
                        boxHeight: 12,
                    }
                },
                tooltip: {
                    backgroundColor: '#0F172A',
                    borderColor: '#1E293B',
                    borderWidth: 1,
                    titleColor: '#67E8F9',
                    bodyColor: '#E5E7EB',
                    padding: 12,
                    cornerRadius: 8,
                }
            }
        }
    });
</script>
@endpush