@extends('Admin.master')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Site Settings</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <h6 class="text-uppercase text-secondary mb-3" style="font-size: 12px; letter-spacing: 1px;">Site Logo</h6>

            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <div class="logo-preview">
                        @if($logo && file_exists(storage_path('app/public/' . $logo)))
                            <img src="{{ asset('storage/' . $logo) }}" alt="Current Logo">
                        @else
                            <div class="logo-placeholder">
                                <i class="bi bi-image"></i>
                                <span>No logo</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-9">
                    <form action="{{ route('admin.settings.logo.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Upload New Logo (PNG, JPG, SVG — Max 2MB)</label>
                            <input type="file" name="logo" class="form-control" accept="image/*" required>
                            @error('logo')
                                <div class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Recommended: Transparent PNG, height ~34px
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i> Upload Logo
                        </button>
                    </form>

                    @if($logo)
                        <form action="{{ route('admin.settings.logo.remove') }}" method="POST" class="mt-2"
                              onsubmit="return confirm('Remove logo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Remove Logo
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .logo-preview {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 120px;
        background: rgba(15, 23, 42, 0.6);
        border: 2px dashed rgba(20, 184, 166, 0.3);
        border-radius: 14px;
        padding: 20px;
    }

    .logo-preview img {
        max-width: 100%;
        max-height: 80px;
        object-fit: contain;
    }

    .logo-placeholder {
        text-align: center;
        color: #94A3B8;
    }

    .logo-placeholder i {
        font-size: 32px;
        display: block;
        margin-bottom: 8px;
        color: rgba(20, 184, 166, 0.4);
    }

    .logo-placeholder span {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>
@endpush