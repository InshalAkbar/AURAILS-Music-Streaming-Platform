@extends('Admin.master')

@section('title', 'Videos List')
@section('page-title', 'Manage Videos')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Videos</h5>
            <a href="{{ route('admin.videos.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Video
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
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>Album</th>
                            <th>Year</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($videos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->video_image_path)
                                    <img src="{{ asset('storage/' . $item->video_image_path) }}" width="50" height="50" style="object-fit:cover; border-radius:5px;">
                                @else
                                    <img src="https://via.placeholder.com/50" width="50" height="50" style="border-radius:5px;">
                                @endif
                            </td>
                            <td>{{ $item->video_title }}</td>
                            <td>{{ $item->artist->artist_name ?? 'N/A' }}</td>
                            <td>{{ $item->album->album_name ?? 'N/A' }}</td>
                            <td>{{ $item->video_year }}</td>
                            <td>{{ $item->video_duration }}</td>
                            <td>
                                <span class="badge {{ $item->video_is_new == 'yes' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $item->video_is_new == 'yes' ? 'New' : 'Old' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.videos.show', $item->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.videos.edit', $item->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.videos.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="9" class="text-center py-4">No videos found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection