@extends('Admin.master')

@section('title', 'Video Details')
@section('page-title', 'Video Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $video->video_title }}</h5>
            <div>
                <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($video->video_image_path)
                        <img src="{{ asset('storage/' . $video->video_image_path) }}"
                             alt="{{ $video->video_title }}" class="img-fluid rounded" style="max-height: 300px;">
                    @else
                        <img src="https://via.placeholder.com/300" alt="No Image" class="img-fluid rounded">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Title</th>
                            <td>{{ $video->video_title }}</td>
                        </tr>
                        <tr>
                            <th>Artist</th>
                            <td>{{ $video->artist->artist_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Album</th>
                            <td>{{ $video->album->album_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>{{ $video->genre->genre_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Language</th>
                            <td>{{ $video->language->language_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td>{{ $video->video_year ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Duration</th>
                            <td>{{ $video->video_duration ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $video->video_is_new == 'yes' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $video->video_is_new == 'yes' ? 'New Release' : 'Classic' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>File Path</th>
                            <td>{{ $video->video_file_path ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>YouTube Video ID</th>
                            <td>
                                @if($video->video_youtube_id)
                                    <code>{{ $video->video_youtube_id }}</code>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $video->video_description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $video->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $video->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection