@extends('Admin.master')

@section('title', 'Add Review')
@section('page-title', 'Add New Review')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Review</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reviews.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">User <span class="text-danger">*</span></label>
                        <select name="review_user_id" class="form-control @error('review_user_id') is-invalid @enderror" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('review_user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->user_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('review_user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Media Type <span class="text-danger">*</span></label>
                        <select name="review_media_type" class="form-control @error('review_media_type') is-invalid @enderror" required>
                            <option value="">Select Type</option>
                            <option value="music" {{ old('review_media_type') == 'music' ? 'selected' : '' }}>Music</option>
                            <option value="video" {{ old('review_media_type') == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                        @error('review_media_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Media ID <span class="text-danger">*</span></label>
                        <input type="number" name="review_media_id" class="form-control @error('review_media_id') is-invalid @enderror" 
                               value="{{ old('review_media_id') }}" required>
                        @error('review_media_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating <span class="text-danger">*</span></label>
                        <select name="review_rating" class="form-control @error('review_rating') is-invalid @enderror" required>
                            <option value="">Select Rating</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('review_rating') == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        @error('review_rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Review Text <span class="text-danger">*</span></label>
                        <textarea name="review_text" class="form-control @error('review_text') is-invalid @enderror" 
                                  rows="4" required>{{ old('review_text') }}</textarea>
                        @error('review_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection