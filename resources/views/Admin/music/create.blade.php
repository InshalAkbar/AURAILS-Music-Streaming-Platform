@extends('Admin.master')

@section('title', 'Add Music')
@section('page-title', 'Add New Music')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Music</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.music.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="music_title" class="form-control" value="{{ old('music_title') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Artist <span class="text-danger">*</span></label>
                        <select name="music_artist_id" class="form-control" required>
                            <option value="">Select Artist</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('music_artist_id') == $artist->id ? 'selected' : '' }}>{{ $artist->artist_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Album</label>
                        <select name="music_album_id" class="form-control">
                            <option value="">Select Album</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ old('music_album_id') == $album->id ? 'selected' : '' }}>{{ $album->album_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Genre</label>
                        <select name="music_genre_id" class="form-control">
                            <option value="">Select Genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('music_genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Language</label>
                        <select name="music_language_id" class="form-control">
                            <option value="">Select Language</option>
                            @foreach($languages as $language)
                                <option value="{{ $language->id }}" {{ old('music_language_id') == $language->id ? 'selected' : '' }}>{{ $language->language_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Year</label>
                        <input type="text" name="music_year" class="form-control" value="{{ old('music_year') }}" placeholder="2024">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="music_description" class="form-control" rows="3">{{ old('music_description') }}</textarea>
                    </div>

                    {{-- AUDIO UPLOAD --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Upload MP3 File (Max 20MB)</label>
                        <input type="file" name="music_audio_file" class="form-control" accept="audio/mpeg,audio/mp3,audio/wav,audio/ogg,audio/mp4">
                        <small class="text-muted">Optional — MP3/WAV/OGG/M4A supported</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">YouTube Video ID</label>
                        <input type="text" name="music_youtube_id" class="form-control" value="{{ old('music_youtube_id') }}" placeholder="e.g. dQw4w9WgXcQ">
                        <small class="text-muted">Alternative to MP3 upload</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cover Image Path</label>
                        <input type="text" name="music_image_path" class="form-control" value="{{ old('music_image_path') }}" placeholder="music/cover.jpg">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="music_is_new" class="form-control">
                            <option value="no" {{ old('music_is_new') == 'no' ? 'selected' : '' }}>Old</option>
                            <option value="yes" {{ old('music_is_new') == 'yes' ? 'selected' : '' }}>New</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                    <a href="{{ route('admin.music.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection