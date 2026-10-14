@extends('Admin.master')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-person-circle me-2"></i>{{ $user->user_name }}
            </h5>
            <div>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="user-show-avatar-wrap">
                        @if($user->user_image && file_exists(storage_path('app/public/' . $user->user_image)))
                            <img src="{{ asset('storage/' . $user->user_image) }}"
                                 alt="{{ $user->user_name }}"
                                 class="user-show-avatar">
                        @else
                            <div class="user-show-avatar-letter">
                                {{ strtoupper(substr($user->user_name ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                        <div class="user-show-ring"></div>
                    </div>

                    <div class="mt-4">
                        @if($user->user_role === 'admin')
                            <span class="badge-role admin">
                                <i class="bi bi-shield-fill"></i> Administrator
                            </span>
                        @else
                            <span class="badge-role user">
                                <i class="bi bi-person-fill"></i> User
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Full Name</th>
                            <td>{{ $user->user_name }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $user->user_email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $user->user_phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $user->user_address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ ucfirst($user->user_role) }}</td>
                        </tr>
                        <tr>
                            <th>Favorites Count</th>
                            <td>{{ $user->favorites->count() }} albums</td>
                        </tr>
                        <tr>
                            <th>Reviews Count</th>
                            <td>{{ $user->reviews->count() }} reviews</td>
                        </tr>
                        <tr>
                            <th>Joined At</th>
                            <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $user->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($user->favorites->count() > 0)
            <div class="mt-4">
                <h5 class="mb-3"><i class="bi bi-heart-fill me-2" style="color: #EF4444;"></i>Recent Favorite Albums</h5>
                <div class="row g-3">
                    @foreach($user->favorites->take(4) as $fav)
                        @if($fav->album)
                            <div class="col-md-3">
                                <div class="mini-album-card">
                                    <div class="mini-album-img">
                                        @if($fav->album->album_cover_image)
                                            <img src="{{ asset('storage/' . $fav->album->album_cover_image) }}" alt="{{ $fav->album->album_name }}">
                                        @else
                                            <img src="https://via.placeholder.com/200x200/0F172A/14B8A6?text=%F0%9F%92%BF" alt="{{ $fav->album->album_name }}">
                                        @endif
                                    </div>
                                    <div class="mini-album-title">{{ $fav->album->album_name }}</div>
                                    <div class="mini-album-sub">{{ $fav->album->artist->artist_name ?? 'Unknown' }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .user-show-avatar-wrap {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }

    .user-show-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(20, 184, 166, 0.4);
        box-shadow: 0 20px 50px -15px rgba(20, 184, 166, 0.5);
        position: relative;
        z-index: 2;
    }

    .user-show-avatar-letter {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #14B8A6, #0EA5E9);
        color: #08111A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 80px;
        font-family: 'Space Grotesk', sans-serif;
        border: 3px solid rgba(20, 184, 166, 0.4);
        box-shadow: 0 20px 50px -15px rgba(20, 184, 166, 0.5);
        position: relative;
        z-index: 2;
    }

    .user-show-ring {
        position: absolute;
        inset: -10px;
        border-radius: 50%;
        border: 2px dashed rgba(103, 232, 249, 0.4);
        animation: spinRing 20s linear infinite;
    }

    @keyframes spinRing {
        to { transform: rotate(360deg); }
    }

    .badge-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .badge-role.admin {
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.4);
        color: #FCD34D;
    }

    .badge-role.user {
        background: rgba(20, 184, 166, 0.12);
        border: 1px solid rgba(20, 184, 166, 0.3);
        color: #67E8F9;
    }

    .mini-album-card {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid #1E293B;
        border-radius: 12px;
        padding: 10px;
    }

    .mini-album-img {
        aspect-ratio: 1 / 1;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .mini-album-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mini-album-title {
        font-size: 13px;
        font-weight: 700;
        color: #E5E7EB;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .mini-album-sub {
        font-size: 11.5px;
        color: #94A3B8;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush