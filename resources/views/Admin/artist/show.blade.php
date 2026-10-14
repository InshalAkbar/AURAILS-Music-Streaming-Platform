@extends('Admin.master')

@section('title', 'Artist Details')
@section('page-title', 'Artist Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person me-2"></i>{{ $artist->artist_name }}</h5>
            <div>
                <a href="{{ route('admin.artists.edit', $artist->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($artist->artist_image)
                        <img src="{{ $artist->artist_image }}" alt="{{ $artist->artist_name }}" 
                             class="img-fluid rounded" style="max-height: 300px; object-fit:cover;">
                    @else
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="bi bi-person fs-1 text-white"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th style="width: 150px;">Artist Name</th>
                            <td>{{ $artist->artist_name }}</td>
                        </tr>
                        <tr>
                            <th>Biography</th>
                            <td>{{ $artist->artist_bio ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Image URL</th>
                            <td>{{ $artist->artist_image ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $artist->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $artist->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection