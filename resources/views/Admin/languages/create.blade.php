@extends('Admin.master')

@section('title', 'Add Language')
@section('page-title', 'Add New Language')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Language</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.languages.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Language Name <span class="text-danger">*</span></label>
                    <input type="text" name="language_name" class="form-control @error('language_name') is-invalid @enderror" 
                           value="{{ old('language_name') }}" required>
                    @error('language_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save
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