@extends('Admin.master')

@section('title', 'Language Details')
@section('page-title', 'Language Details')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $language->language_name }}</h5>
            <div>
                <a href="{{ route('admin.languages.edit', $language->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.languages.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">ID</th>
                    <td>{{ $language->id }}</td>
                </tr>
                <tr>
                    <th>Language Name</th>
                    <td>{{ $language->language_name }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $language->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $language->updated_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection