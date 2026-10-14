@extends('Admin.master')

@section('title', 'Albums List')
@section('page-title', 'Manage Albums')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Albums</h5>
            <a href="{{ route('admin.albums.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Album
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
                            <th>Cover</th>
                            <th>Album Name</th>
                            <th>Artist</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($albums as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->album_cover_image)
                                    <img src="{{ asset('storage/' . $item->album_cover_image) }}" width="50" height="50" style="object-fit:cover; border-radius:5px;">
                                @else
                                    <img src="https://via.placeholder.com/50" width="50" height="50" style="border-radius:5px;">
                                @endif
                            </td>
                            <td>{{ $item->album_name }}</td>
                            <td>{{ $item->artist->artist_name ?? 'N/A' }}</td>
                            <td>{{ $item->album_release_year }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.albums.show', $item->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.albums.edit', $item->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.albums.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                            <td colspan="6" class="text-center py-4">No albums found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection