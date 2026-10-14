@extends('Admin.master')

@section('title', 'Genre Details')
@section('page-title', 'Genre Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $genre->genre_name }}</h5>
            <div>
                <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">ID</th>
                    <td>{{ $genre->id }}</td>
                </tr>
                <tr>
                    <th>Genre Name</th>
                    <td>{{ $genre->genre_name }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $genre->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $genre->updated_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection