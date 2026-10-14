@extends('Admin.master')

@section('title', 'Review Details')
@section('page-title', 'Review Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-star me-2"></i>Review Details
            </h5>
            <div>
                <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- User Card --}}
            @if($review->user)
            <div class="review-user-card mb-4">
                @if($review->user->user_image && file_exists(storage_path('app/public/' . $review->user->user_image)))
                    <img src="{{ asset('storage/' . $review->user->user_image) }}"
                         alt="{{ $review->user->user_name }}"
                         class="review-user-avatar-lg">
                @else
                    <div class="review-user-avatar-lg-letter">
                        {{ strtoupper(substr($review->user->user_name ?? 'U', 0, 1)) }}
                    </div>
                @endif
                <div class="review-user-details">
                    <div class="review-user-label">Review By</div>
                    <div class="review-user-name-lg">{{ $review->user->user_name ?? 'Unknown' }}</div>
                    <div class="review-user-email-lg">
                        <i class="bi bi-envelope me-1"></i>{{ $review->user->user_email ?? 'N/A' }}
                    </div>
                </div>
                <a href="{{ route('admin.users.show', $review->user->id) }}" class="btn btn-info btn-sm ms-auto">
                    <i class="bi bi-person me-1"></i> View User
                </a>
            </div>
            @endif

            {{-- Review Details --}}
            <table class="table table-bordered">
                <tr>
                    <th width="200">Media Type</th>
                    <td>
                        @if($review->review_media_type == 'music')
                            <span class="badge-media music">
                                <i class="bi bi-music-note-beamed"></i> Music
                            </span>
                        @else
                            <span class="badge-media video">
                                <i class="bi bi-camera-video"></i> Video
                            </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Media ID</th>
                    <td>#{{ $review->review_media_id }}</td>
                </tr>
                <tr>
                    <th>Rating</th>
                    <td>
                        <span class="badge-rating">
                            {{ $review->review_rating }} <i class="bi bi-star-fill"></i>
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Review Text</th>
                    <td>{{ $review->review_text }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $review->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $review->updated_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .review-user-card {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px 24px;
        background: linear-gradient(135deg, rgba(20, 184, 166, 0.08), rgba(14, 165, 233, 0.05));
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 16px;
        flex-wrap: wrap;
    }

    .review-user-avatar-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(20, 184, 166, 0.5);
        box-shadow: 0 10px 30px -10px rgba(20, 184, 166, 0.5);
        flex-shrink: 0;
    }

    .review-user-avatar-lg-letter {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #14B8A6, #0EA5E9);
        color: #08111A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 32px;
        font-family: 'Space Grotesk', sans-serif;
        border: 3px solid rgba(20, 184, 166, 0.5);
        box-shadow: 0 10px 30px -10px rgba(20, 184, 166, 0.5);
        flex-shrink: 0;
    }

    .review-user-details { line-height: 1.4; }

    .review-user-label {
        font-size: 11px;
        color: #94A3B8;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .review-user-name-lg {
        font-size: 22px;
        font-weight: 800;
        color: #E5E7EB;
        font-family: 'Space Grotesk', sans-serif;
        margin-bottom: 4px;
    }

    .review-user-email-lg {
        font-size: 13px;
        color: #94A3B8;
    }

    .badge-media {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .badge-media.music {
        background: rgba(20, 184, 166, 0.15);
        border: 1px solid rgba(20, 184, 166, 0.4);
        color: #67E8F9;
    }

    .badge-media.video {
        background: rgba(14, 165, 233, 0.15);
        border: 1px solid rgba(14, 165, 233, 0.4);
        color: #7DD3FC;
    }

    .badge-rating {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 10px;
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.4);
        color: #FCD34D;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 800;
    }
</style>
@endpush