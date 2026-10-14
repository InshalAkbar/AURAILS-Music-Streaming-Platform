@extends('Admin.master')

@section('title', 'Add Video')
@section('page-title', 'Add New Video')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Video</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.videos.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="video_title" class="form-control @error('video_title') is-invalid @enderror"
                               value="{{ old('video_title') }}" required>
                        @error('video_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Artist <span class="text-danger">*</span></label>
                        <select name="video_artist_id" class="form-control @error('video_artist_id') is-invalid @enderror" required>
                            <option value="">Select Artist</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('video_artist_id') == $artist->id ? 'selected' : '' }}>
                                    {{ $artist->artist_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('video_artist_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Album</label>
                        <select name="video_album_id" class="form-control @error('video_album_id') is-invalid @enderror">
                            <option value="">Select Album</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ old('video_album_id') == $album->id ? 'selected' : '' }}>
                                    {{ $album->album_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('video_album_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Genre</label>
                        <select name="video_genre_id" class="form-control @error('video_genre_id') is-invalid @enderror">
                            <option value="">Select Genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('video_genre_id') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->genre_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('video_genre_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Language</label>
                        <select name="video_language_id" class="form-control @error('video_language_id') is-invalid @enderror">
                            <option value="">Select Language</option>
                            @foreach($languages as $language)
                                <option value="{{ $language->id }}" {{ old('video_language_id') == $language->id ? 'selected' : '' }}>
                                    {{ $language->language_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('video_language_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Year</label>
                        <input type="text" name="video_year" class="form-control @error('video_year') is-invalid @enderror"
                               value="{{ old('video_year') }}" placeholder="2024">
                        @error('video_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" name="video_duration" class="form-control @error('video_duration') is-invalid @enderror"
                               value="{{ old('video_duration') }}" placeholder="3:45">
                        @error('video_duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="video_description" class="form-control @error('video_description') is-invalid @enderror"
                                  rows="3">{{ old('video_description') }}</textarea>
                        @error('video_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">File Path</label>
                        <input type="text" name="video_file_path" class="form-control @error('video_file_path') is-invalid @enderror"
                               value="{{ old('video_file_path') }}" placeholder="videos/video.mp4">
                        @error('video_file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">YouTube Video ID</label>
                        <input type="text" name="video_youtube_id" class="form-control @error('video_youtube_id') is-invalid @enderror"
                               value="{{ old('video_youtube_id') }}" placeholder="e.g. dQw4w9WgXcQ">
                        <small class="text-muted">YouTube URL se video ID copy karo (watch?v= ke baad wali)</small>
                        @error('video_youtube_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Thumbnail Path</label>
                        <input type="text" name="video_image_path" class="form-control @error('video_image_path') is-invalid @enderror"
                               value="{{ old('video_image_path') }}" placeholder="videos/thumbnail.jpg">
                        @error('video_image_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="video_is_new" class="form-control @error('video_is_new') is-invalid @enderror">
                            <option value="no" {{ old('video_is_new') == 'no' ? 'selected' : '' }}>Old</option>
                            <option value="yes" {{ old('video_is_new') == 'yes' ? 'selected' : '' }}>New</option>
                        </select>
                        @error('video_is_new')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection