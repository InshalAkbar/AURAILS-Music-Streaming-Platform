@extends('Admin.master')

@section('title', 'Music Details')
@section('page-title', 'Music Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $music->music_title }}</h5>
            <div>
                <a href="{{ route('admin.music.edit', $music->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.music.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($music->music_image_path)
                        <img src="{{ asset('storage/' . $music->music_image_path) }}"
                             alt="{{ $music->music_title }}" class="img-fluid rounded" style="max-height: 300px;">
                    @else
                        <img src="https://via.placeholder.com/300" alt="No Image" class="img-fluid rounded">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Title</th>
                            <td>{{ $music->music_title }}</td>
                        </tr>
                        <tr>
                            <th>Artist</th>
                            <td>{{ $music->artist->artist_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Album</th>
                            <td>{{ $music->album->album_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>{{ $music->genre->genre_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Language</th>
                            <td>{{ $music->language->language_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td>{{ $music->music_year ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $music->music_is_new == 'yes' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $music->music_is_new == 'yes' ? 'New Release' : 'Classic' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>File Path</th>
                            <td>{{ $music->music_file_path ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>YouTube Video ID</th>
                            <td>
                                @if($music->music_youtube_id)
                                    <code>{{ $music->music_youtube_id }}</code>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $music->music_description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $music->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $music->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection