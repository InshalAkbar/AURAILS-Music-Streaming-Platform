@extends('Admin.master')

@section('title', 'Add Genre')
@section('page-title', 'Add New Genre')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Add New Genre</h5>
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

            <form action="{{ route('admin.genres.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Genre Name <span class="text-danger">*</span></label>
                    <input type="text" name="genre_name" class="form-control" placeholder="e.g. Pop, Rock, Classical" value="{{ old('genre_name') }}" required>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Save Genre
                    </button>
                    <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection