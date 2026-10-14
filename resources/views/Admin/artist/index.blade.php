@extends('Admin.master')

@section('title', 'Artists List')
@section('page-title', 'Artists List')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-people me-2"></i>Artists List</h5>
            <a href="{{ route('admin.artists.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add New Artist
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
                            <th style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th>Bio</th>
                            <th style="width: 180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artists as $artist)
                            <tr>
                                <td class="text-secondary">{{ $loop->iteration }}</td>
                                <td>
                                    @if($artist->artist_image)
                                        @php
                                            $imgPath = storage_path('app/public/' . $artist->artist_image);
                                        @endphp
                                        @if(file_exists($imgPath))
                                            <img src="{{ asset('storage/' . $artist->artist_image) }}"
                                                 alt="{{ $artist->artist_name }}"
                                                 class="admin-artist-avatar">
                                        @else
                                            <div class="admin-artist-avatar-letter">
                                                {{ strtoupper(substr($artist->artist_name ?? 'A', 0, 1)) }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="admin-artist-avatar-letter">
                                            {{ strtoupper(substr($artist->artist_name ?? 'A', 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold text-white">{{ $artist->artist_name }}</td>
                                <td>{{ Str::limit($artist->artist_bio, 50) ?? 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.artists.show', $artist->id) }}" class="btn btn-info btn-sm" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.artists.edit', $artist->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.artists.destroy', $artist->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this artist?')">
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
                                <td colspan="5" class="text-center text-secondary py-4">
                                    <i class="bi bi-people fs-1 d-block mb-2"></i>
                                    No artists found. Click "Add New Artist" to create one.
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
    .admin-artist-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(20, 184, 166, 0.4);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
    }

    .admin-artist-avatar-letter {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #14B8A6, #0EA5E9);
        color: #08111A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
        font-family: 'Space Grotesk', sans-serif;
        border: 2px solid rgba(20, 184, 166, 0.4);
    }
</style>
@endpush