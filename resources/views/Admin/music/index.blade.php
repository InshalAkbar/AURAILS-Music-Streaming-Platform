@extends('Admin.master')

@section('title', 'Music List')
@section('page-title', 'Manage Music')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Music Tracks</h5>
            <a href="{{ route('admin.music.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Music
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>Album</th>
                            <th>Genre</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($music as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->music_image_path)
                                    <img src="{{ asset('storage/' . $item->music_image_path) }}" 
                                         alt="{{ $item->music_title }}" width="50" height="50" style="object-fit:cover; border-radius:5px;">
                                @else
                                    <img src="https://via.placeholder.com/50" alt="No Image" width="50" height="50" style="border-radius:5px;">
                                @endif
                            </td>
                            <td>{{ $item->music_title }}</td>
                            <td>{{ $item->artist->artist_name ?? 'N/A' }}</td>
                            <td>{{ $item->album->album_name ?? 'N/A' }}</td>
                            <td>{{ $item->genre->genre_name ?? 'N/A' }}</td>
                            <td>{{ $item->music_year ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $item->music_is_new == 'yes' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $item->music_is_new == 'yes' ? 'New' : 'Old' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.music.show', $item->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.music.edit', $item->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.music.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-music fa-3x text-muted mb-3 d-block"></i>
                                No music tracks found.
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