@extends('Admin.master')

@section('title', 'Edit Genre')
@section('page-title', 'Edit Genre')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit: {{ $genre->genre_name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Genre Name <span class="text-danger">*</span></label>
                    <input type="text" name="genre_name" class="form-control @error('genre_name') is-invalid @enderror" 
                           value="{{ old('genre_name', $genre->genre_name) }}" required>
                    @error('genre_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection