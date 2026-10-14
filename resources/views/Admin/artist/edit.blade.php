@extends('Admin.master')

@section('title', 'Edit Artist')
@section('page-title', 'Edit Artist')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Artist: {{ $artist->artist_name }}</h5>
            <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.artists.update', $artist->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Artist Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Artist Name <span class="text-danger">*</span></label>
                        <input type="text" name="artist_name" class="form-control @error('artist_name') is-invalid @enderror" 
                               placeholder="e.g. Atif Aslam" value="{{ old('artist_name', $artist->artist_name) }}" required>
                        @error('artist_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Artist Image -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Artist Image URL</label>
                        <input type="url" name="artist_image" class="form-control @error('artist_image') is-invalid @enderror" 
                               placeholder="https://example.com/artist.jpg" value="{{ old('artist_image', $artist->artist_image) }}">
                        <small class="text-muted">Direct link for the profile picture (JPG/PNG).</small>
                        @if($artist->artist_image)
                            <div class="mt-2">
                                <img src="{{ $artist->artist_image }}" alt="Current Image" width="80" height="80" style="object-fit:cover; border-radius:8px;">
                                <span class="text-muted small">Current Image</span>
                            </div>
                        @endif
                        @error('artist_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Artist Bio -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Artist Biography</label>
                        <textarea name="artist_bio" class="form-control @error('artist_bio') is-invalid @enderror" 
                                  rows="4" placeholder="Write a short biography about the artist...">{{ old('artist_bio', $artist->artist_bio) }}</textarea>
                        @error('artist_bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Update Artist
                    </button>
                    <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection