@extends('Admin.master')

@section('title', 'Users List')
@section('page-title', 'Manage Users')

@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-people me-2"></i>Users List
            </h5>
            <span class="badge bg-primary">{{ $users->count() }} total users</span>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th style="width: 80px;">Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th style="width: 180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-secondary">{{ $loop->iteration }}</td>
                                <td>
                                    @if($user->user_image && file_exists(storage_path('app/public/' . $user->user_image)))
                                        <img src="{{ asset('storage/' . $user->user_image) }}"
                                             class="admin-user-avatar"
                                             alt="{{ $user->user_name }}">
                                    @else
                                        <div class="admin-user-avatar-letter">
                                            {{ strtoupper(substr($user->user_name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-white">{{ $user->user_name }}</div>
                                </td>
                                <td>{{ $user->user_email }}</td>
                                <td>{{ $user->user_phone ?? 'N/A' }}</td>
                                <td>
                                    @if($user->user_role === 'admin')
                                        <span class="badge-role admin">
                                            <i class="bi bi-shield-fill"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge-role user">
                                            <i class="bi bi-person-fill"></i> User
                                        </span>
                                    @endif
                                </td>
                                <td class="text-secondary small">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-secondary py-5">
                                    <i class="bi bi-people fs-1 d-block mb-2"></i>
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .admin-user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(20, 184, 166, 0.4);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
    }

    .admin-user-avatar-letter {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #14B8A6, #0EA5E9);
        color: #08111A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
        font-family: 'Space Grotesk', sans-serif;
        border: 2px solid rgba(20, 184, 166, 0.4);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
    }

    .badge-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .badge-role.admin {
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.4);
        color: #FCD34D;
    }

    .badge-role.user {
        background: rgba(20, 184, 166, 0.12);
        border: 1px solid rgba(20, 184, 166, 0.3);
        color: #67E8F9;
    }
</style>
@endpush