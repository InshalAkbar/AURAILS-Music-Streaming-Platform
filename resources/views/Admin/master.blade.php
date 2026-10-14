<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AURAILS Admin - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #08111A;
            --bg-sidebar: #060D14;
            --card: #0F172A;
            --card-hover: #162033;
            --card-border: #1E293B;
            --primary: #14B8A6;
            --primary-hover: #0D9488;
            --secondary: #0EA5E9;
            --accent: #67E8F9;
            --text: #E5E7EB;
            --gray: #94A3B8;
            --gold: #F59E0B;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--bg) !important;
            color: var(--text) !important;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--card-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 22px 20px;
            border-bottom: 1px solid var(--card-border);
            text-align: center;
        }

        .brand-title {
            color: var(--accent);
            font-weight: 800;
            letter-spacing: 1.5px;
            font-size: 18px;
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
        }

        .brand-title i { color: var(--primary); }

        .nav-links { padding: 20px 14px; flex-grow: 1; }

        .nav-group-label {
            color: #475569;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin: 18px 0 8px;
            padding-left: 10px;
            font-weight: 700;
        }

        .nav-link-admin {
            color: var(--gray);
            padding: 11px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 3px;
            transition: all 0.2s ease;
        }

        .nav-link-admin i { font-size: 16px; }

        .nav-link-admin:hover {
            color: var(--accent);
            background: rgba(20, 184, 166, 0.08);
        }

        .nav-link-admin.active {
            color: var(--bg);
            background: var(--primary);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex-grow: 1;
            width: calc(100% - 260px);
        }

        .top-navbar {
            background: rgba(8, 17, 26, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--card-border);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .page-title {
            color: var(--accent);
            font-weight: 700;
            margin: 0;
            font-size: 18px;
        }

        /* Cards */
        .card {
            background-color: var(--card) !important;
            border: 1px solid var(--card-border) !important;
            color: var(--text) !important;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border-bottom: 1px solid var(--card-border) !important;
            color: var(--text) !important;
            padding: 16px 20px;
            border-radius: 14px 14px 0 0 !important;
        }

        .card-body { padding: 20px; }

        /* Tables */
        .table { color: var(--text) !important; margin-bottom: 0; }

        .table th {
            background-color: rgba(20, 184, 166, 0.08) !important;
            color: var(--accent) !important;
            border-color: var(--card-border) !important;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            color: var(--text) !important;
            border-color: var(--card-border) !important;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover td {
            background-color: rgba(20, 184, 166, 0.04) !important;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary) !important;
            border: none !important;
            color: var(--bg) !important;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.25);
        }

        .btn-primary:hover {
            background: var(--primary-hover) !important;
            color: var(--bg) !important;
        }

        .btn-warning {
            background: #F59E0B !important;
            border: none !important;
            color: #08111A !important;
            font-weight: 600;
        }

        .btn-info {
            background: var(--secondary) !important;
            border: none !important;
            color: #08111A !important;
            font-weight: 600;
        }

        .btn-danger {
            background: #EF4444 !important;
            border: none !important;
            font-weight: 600;
        }

        .btn-secondary {
            background: #334155 !important;
            border: none !important;
            color: var(--text) !important;
        }

        .btn-success {
            background: #10B981 !important;
            border: none !important;
            color: white !important;
            font-weight: 600;
        }

        /* Forms */
        .form-control, .form-select {
            background-color: rgba(15, 23, 42, 0.7) !important;
            border: 1px solid var(--card-border) !important;
            color: var(--text) !important;
            padding: 10px 14px;
            border-radius: 10px;
        }

        .form-control:focus, .form-select:focus {
            background-color: rgba(15, 23, 42, 0.9) !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(20, 184, 166, 0.2) !important;
            color: var(--text) !important;
        }

        .form-control::placeholder { color: #64748B; }

        .form-label {
            color: var(--text);
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 6px;
        }

        /* Alerts */
        .alert-success {
            background-color: rgba(20, 184, 166, 0.12) !important;
            border: 1px solid rgba(20, 184, 166, 0.35) !important;
            color: var(--accent) !important;
            border-radius: 10px;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.12) !important;
            border: 1px solid rgba(239, 68, 68, 0.35) !important;
            color: #FCA5A5 !important;
            border-radius: 10px;
        }

        /* Badges */
        .badge.bg-warning { background: #F59E0B !important; color: #08111A; }
        .badge.bg-success { background: var(--primary) !important; color: #08111A; }
        .badge.bg-primary { background: var(--primary) !important; color: #08111A; }
        .badge.bg-secondary { background: #334155 !important; }

        /* Logout Button */
        .btn-logout {
            background: transparent;
            border: 1px solid var(--card-border);
            color: var(--text);
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-logout:hover {
            background: var(--primary);
            color: var(--bg);
            border-color: var(--primary);
        }

        .btn-logout-form {
            display: inline;
            margin: 0;
        }

        /* User Avatar in Navbar */
        .top-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            border: 2px solid rgba(20, 184, 166, 0.4);
            overflow: hidden;
        }

        .top-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Dashboard KPI Cards Fix */
        .row.g-4 { --bs-gutter-x: 1.5rem; --bs-gutter-y: 1.5rem; }

        /* Scrollable sidebar */
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb {
            background: var(--card-border);
            border-radius: 3px;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4 class="brand-title">
                <i class="bi bi-wave-square"></i> AURAILS PANEL
            </h4>
        </div>

        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="nav-group-label">Music Management</div>

            <a href="{{ route('admin.artists.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.artists.*') ? 'active' : '' }}">
                <i class="bi bi-mic"></i> Artists
            </a>

            <a href="{{ route('admin.albums.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.albums.*') ? 'active' : '' }}">
                <i class="bi bi-journal-album"></i> Albums
            </a>

            <a href="{{ route('admin.genres.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.genres.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Genres
            </a>

            <a href="{{ route('admin.languages.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.languages.*') ? 'active' : '' }}">
                <i class="bi bi-translate"></i> Languages
            </a>

            <a href="{{ route('admin.music.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.music.*') ? 'active' : '' }}">
                <i class="bi bi-music-note-beamed"></i> Music Track
            </a>

            <a href="{{ route('admin.videos.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                <i class="bi bi-camera-video"></i> Videos
            </a>

            <div class="nav-group-label">Community</div>

            <a href="{{ route('admin.reviews.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <i class="bi bi-star"></i> Reviews
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>

                        <div class="nav-group-label">System</div>

            <a href="{{ route('admin.settings.index') }}"
               class="nav-link-admin {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Settings
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="top-navbar">
            <h5 class="page-title">@yield('page-title', 'Admin Panel')</h5>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="text-decoration-none" style="color: var(--gray); font-size: 13px;">
                    <i class="bi bi-globe me-1"></i> Visit Website
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" class="btn-logout-form">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>

                <div class="top-avatar">
                    @if(Auth::user()->user_image && file_exists(storage_path('app/public/' . Auth::user()->user_image)))
                        <img src="{{ asset('storage/' . Auth::user()->user_image) }}" alt="{{ Auth::user()->user_name }}">
                    @else
                        {{ strtoupper(substr(Auth::user()->user_name ?? 'A', 0, 1)) }}
                    @endif
                </div>
            </div>
        </div>

        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('main')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>