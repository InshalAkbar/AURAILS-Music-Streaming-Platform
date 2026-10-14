@extends('Admin.master')

@section('title', 'Edit Music')
@section('page-title', 'Edit Music Track')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit: {{ $music->music_title }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.music.update', $music->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="music_title" class="form-control @error('music_title') is-invalid @enderror"
                               value="{{ old('music_title', $music->music_title) }}" required>
                        @error('music_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Artist <span class="text-danger">*</span></label>
                        <select name="music_artist_id" class="form-control @error('music_artist_id') is-invalid @enderror" required>
                            <option value="">Select Artist</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('music_artist_id', $music->music_artist_id) == $artist->id ? 'selected' : '' }}>
                                    {{ $artist->artist_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('music_artist_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Album</label>
                        <select name="music_album_id" class="form-control @error('music_album_id') is-invalid @enderror">
                            <option value="">Select Album</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ old('music_album_id', $music->music_album_id) == $album->id ? 'selected' : '' }}>
                                    {{ $album->album_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('music_album_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Genre</label>
                        <select name="music_genre_id" class="form-control @error('music_genre_id') is-invalid @enderror">
                            <option value="">Select Genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('music_genre_id', $music->music_genre_id) == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->genre_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('music_genre_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Language</label>
                        <select name="music_language_id" class="form-control @error('music_language_id') is-invalid @enderror">
                            <option value="">Select Language</option>
                            @foreach($languages as $language)
                                <option value="{{ $language->id }}" {{ old('music_language_id', $music->music_language_id) == $language->id ? 'selected' : '' }}>
                                    {{ $language->language_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('music_language_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Year</label>
                        <input type="text" name="music_year" class="form-control @error('music_year') is-invalid @enderror"
                               value="{{ old('music_year', $music->music_year) }}" placeholder="2024">
                        @error('music_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="music_description" class="form-control @error('music_description') is-invalid @enderror"
                                  rows="3">{{ old('music_description', $music->music_description) }}</textarea>
                        @error('music_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">File Path</label>
                        <input type="text" name="music_file_path" class="form-control @error('music_file_path') is-invalid @enderror"
                               value="{{ old('music_file_path', $music->music_file_path) }}" placeholder="music/song.mp3">
                        @error('music_file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">YouTube Video ID</label>
                        <input type="text" name="music_youtube_id" class="form-control @error('music_youtube_id') is-invalid @enderror"
                               value="{{ old('music_youtube_id', $music->music_youtube_id) }}" placeholder="e.g. dQw4w9WgXcQ">
                        <small class="text-muted">YouTube URL se video ID copy karo (watch?v= ke baad wali)</small>
                        @error('music_youtube_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image Path</label>
                        <input type="text" name="music_image_path" class="form-control @error('music_image_path') is-invalid @enderror"
                               value="{{ old('music_image_path', $music->music_image_path) }}" placeholder="music/cover.jpg">
                        @error('music_image_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="music_is_new" class="form-control @error('music_is_new') is-invalid @enderror">
                            <option value="no" {{ old('music_is_new', $music->music_is_new) == 'no' ? 'selected' : '' }}>Old</option>
                            <option value="yes" {{ old('music_is_new', $music->music_is_new) == 'yes' ? 'selected' : '' }}>New</option>
                        </select>
                        @error('music_is_new')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.music.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection