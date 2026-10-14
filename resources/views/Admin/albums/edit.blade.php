@extends('Admin.master')

@section('title', 'Edit Album')
@section('page-title', 'Edit Album')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit: {{ $album->album_name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.albums.update', $album->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Album Name <span class="text-danger">*</span></label>
                        <input type="text" name="album_name" class="form-control @error('album_name') is-invalid @enderror" 
                               value="{{ old('album_name', $album->album_name) }}" required>
                        @error('album_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Artist <span class="text-danger">*</span></label>
                        <select name="album_artist_id" class="form-control @error('album_artist_id') is-invalid @enderror" required>
                            <option value="">Select Artist</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('album_artist_id', $album->album_artist_id) == $artist->id ? 'selected' : '' }}>
                                    {{ $artist->artist_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('album_artist_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Release Year <span class="text-danger">*</span></label>
                        <input type="text" name="album_release_year" class="form-control @error('album_release_year') is-invalid @enderror" 
                               value="{{ old('album_release_year', $album->album_release_year) }}" placeholder="2024" required>
                        @error('album_release_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cover Image Path</label>
                        <input type="text" name="album_cover_image" class="form-control @error('album_cover_image') is-invalid @enderror" 
                               value="{{ old('album_cover_image', $album->album_cover_image) }}" placeholder="images/album.jpg">
                        @error('album_cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="album_description" class="form-control @error('album_description') is-invalid @enderror" 
                                  rows="3">{{ old('album_description', $album->album_description) }}</textarea>
                        @error('album_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection