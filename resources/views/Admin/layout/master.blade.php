<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurail Admin - @yield('title')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-black: #000000;
            --surface-dark: #0A0F1D;
            --card-bg: rgba(15, 23, 42, 0.6);
            --border-gold: rgba(245, 158, 11, 0.25);
            --border-blue: rgba(56, 189, 248, 0.15);
            --gold-primary: #F59E0B;
            --gold-light: #FCD34D;
        }

        body {
            background-color: var(--bg-black);
            color: #F8FAFC;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background-color: var(--surface-dark);
            border-right: 1px solid var(--border-gold);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-gold);
            text-align: center;
        }

        .nav-links {
            padding: 20px 15px;
            flex-grow: 1;
        }

        .nav-group-label {
            color: #64748B;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 15px;
            margin-bottom: 8px;
            padding-left: 10px;
        }

        .nav-link-admin {
            color: #94A3B8;
            padding: 12px 15px;
            border-radius: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .nav-link-admin:hover, .nav-link-admin.active {
            color: var(--gold-light);
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid var(--border-gold);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex-grow: 1;
            width: calc(100% - 260px);
        }

        .top-navbar {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-gold);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .text-gradient-gold {
            background: linear-gradient(135deg, #FCD34D, #F59E0B, #D97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        <style>
    :root {
        --bg-main: #0B0B10;        /* Deep Black */
        --bg-card: #15151D;        /* Dark Gray */
        --primary: #8B5CF6;        /* Electric Purple */
        --secondary: #22D3EE;      /* Cyan */
        --text-main: #F8FAFC;      /* White */
        --text-muted: #94A3B8;     /* Slate Gray */
        --sidebar-bg: #101017;     /* Darker Sidebar */
    }

    body {
        background-color: var(--bg-main) !important;
        color: var(--text-main) !important;
    }

    /* Sidebar Links */
    .sidebar, aside, nav.sidebar {
        background-color: var(--sidebar-bg) !important;
        border-right: 1px solid rgba(139, 92, 246, 0.15) !important;
    }

    .sidebar .nav-link, .sidebar a {
        color: var(--text-muted) !important;
    }

    .sidebar .nav-link:hover, .sidebar .nav-link.active, .sidebar a:hover {
        color: var(--secondary) !important;
        background-color: rgba(139, 92, 246, 0.15) !important;
        border-left: 4px solid var(--primary) !important;
    }

    /* Buttons */
    .btn-primary, .btn-warning, .btn-gold, button[type="submit"], .btn-add {
        background: linear-gradient(135deg, var(--primary), #7C3AED) !important;
        border: none !important;
        color: #fff !important;
        box-shadow: 0 4px 14px rgba(139, 92, 246, 0.3) !important;
    }

    /* Cards & Tables */
    .card, .table-responsive, .content-box {
        background-color: var(--bg-card) !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        color: var(--text-main) !important;
    }

    .table th {
        background-color: rgba(139, 92, 246, 0.12) !important;
        color: var(--secondary) !important;
    }

    .table td {
        color: var(--text-main) !important;
    }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold m-0 text-gradient-gold">AURAIL PANEL</h4>
        </div>
        
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="nav-group-label">Music Management</div>
            <a href="{{ route('admin.artist.index') }}" class="nav-link-admin {{ request()->routeIs('admin.artist.*') ? 'active' : '' }}">
                <i class="bi bi-mic"></i> Artists
            </a>
            <a href="#" class="nav-link-admin"><i class="bi bi-journal-album"></i> Albums</a>
            <a href="#" class="nav-link-admin"><i class="bi bi-tags"></i> Genres</a>
            <a href="#" class="nav-link-admin"><i class="bi bi-translate"></i> Languages</a>
            <a href="#" class="nav-link-admin"><i class="bi bi-music-note-beamed"></i> Music Track</a>
            <a href="#" class="nav-link-admin"><i class="bi bi-camera-video"></i> Videos</a>
            
            <div class="nav-group-label">Community</div>
            <a href="#" class="nav-link-admin"><i class="bi bi-star"></i> Reviews</a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5 class="mb-0 fw-bold text-gradient-gold">Admin Dashboard</h5>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/') }}" target="_blank" class="text-secondary text-decoration-none small">
                    <i class="bi bi-globe me-1"></i> Visit Website
                </a>
                
                <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning btn-sm rounded-pill px-3">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
                
                <div class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                    {{ Auth::user()->user_name ?? 'Admin' }}
                </div>
            </div>
        </div>

        <!-- Page Dynamic Content -->
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>