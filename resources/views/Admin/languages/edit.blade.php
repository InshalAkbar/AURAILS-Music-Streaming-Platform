@extends('Admin.master')

@section('title', 'Edit Language')
@section('page-title', 'Edit Language')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit: {{ $language->language_name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.languages.update', $language->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Language Name <span class="text-danger">*</span></label>
                    <input type="text" name="language_name" class="form-control @error('language_name') is-invalid @enderror" 
                           value="{{ old('language_name', $language->language_name) }}" required>
                    @error('language_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.languages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection