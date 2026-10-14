@extends('Admin.master')

@section('title', 'Album Details')
@section('page-title', 'Album Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $album->album_name }}</h5>
            <div>
                <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($album->album_cover_image)
                        <img src="{{ asset('storage/' . $album->album_cover_image) }}" 
                             alt="{{ $album->album_name }}" class="img-fluid rounded" style="max-height: 300px;">
                    @else
                        <img src="https://via.placeholder.com/300" alt="No Image" class="img-fluid rounded">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Album Name</th>
                            <td>{{ $album->album_name }}</td>
                        </tr>
                        <tr>
                            <th>Artist</th>
                            <td>{{ $album->artist->artist_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Release Year</th>
                            <td>{{ $album->album_release_year }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $album->album_description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Cover Image</th>
                            <td>{{ $album->album_cover_image ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $album->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $album->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection