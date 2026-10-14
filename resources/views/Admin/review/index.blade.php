@extends('Admin.master')

@section('title', 'Reviews List')
@section('page-title', 'Manage Reviews')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-star me-2"></i>All Reviews
            </h5>
            <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add New Review
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th style="width: 250px;">User</th>
                            <th>Media Type</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th style="width: 180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $item)
                            <tr>
                                <td class="text-secondary">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="review-user-cell">
                                        @if($item->user && $item->user->user_image && file_exists(storage_path('app/public/' . $item->user->user_image)))
                                            <img src="{{ asset('storage/' . $item->user->user_image) }}"
                                                 alt="{{ $item->user->user_name }}"
                                                 class="review-user-avatar">
                                        @else
                                            <div class="review-user-avatar-letter">
                                                {{ strtoupper(substr($item->user->user_name ?? 'U', 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="review-user-info">
                                            <div class="review-user-name">{{ $item->user->user_name ?? 'Unknown' }}</div>
                                            <div class="review-user-email">{{ $item->user->user_email ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($item->review_media_type == 'music')
                                        <span class="badge-media music">
                                            <i class="bi bi-music-note-beamed"></i> Music
                                        </span>
                                    @else
                                        <span class="badge-media video">
                                            <i class="bi bi-camera-video"></i> Video
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge-rating">
                                        {{ $item->review_rating }} <i class="bi bi-star-fill"></i>
                                    </span>
                                </td>
                                <td>
                                    <div class="review-text-cell">{{ Str::limit($item->review_text, 60) }}</div>
                                    <div class="review-date">{{ $item->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.reviews.show', $item->id) }}" class="btn btn-info btn-sm" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.reviews.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.reviews.destroy', $item->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this review?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-5">
                                    <i class="bi bi-star fs-1 d-block mb-2"></i>
                                    No reviews found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .review-user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .review-user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(20, 184, 166, 0.4);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
        flex-shrink: 0;
    }

    .review-user-avatar-letter {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #14B8A6, #0EA5E9);
        color: #08111A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 17px;
        font-family: 'Space Grotesk', sans-serif;
        border: 2px solid rgba(20, 184, 166, 0.4);
        flex-shrink: 0;
    }

    .review-user-info {
        min-width: 0;
    }

    .review-user-name {
        font-weight: 700;
        color: #E5E7EB;
        font-size: 14px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .review-user-email {
        font-size: 12px;
        color: #94A3B8;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
        font-size: 12px;
        font-weight: 800;
    }

    .review-text-cell {
        color: #E5E7EB;
        font-size: 13.5px;
        margin-bottom: 3px;
    }

    .review-date {
        color: #64748B;
        font-size: 11.5px;
        font-weight: 600;
    }
</style>
@endpush