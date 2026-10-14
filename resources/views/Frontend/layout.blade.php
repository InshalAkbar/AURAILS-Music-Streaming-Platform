<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AURAILS — @yield('title', 'Feel Every Frequency')</title>
    <meta name="description" content="@yield('meta-description', 'AURAILS — Stream music, discover artists, explore albums and videos.')">
    <meta name="theme-color" content="#08111A">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">

    <script>
        (function() {
            const theme = localStorage.getItem('aurails-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <style>
        :root {
            --bg: #08111A;
            --bg-deep: #060D14;
            --card: #0F172A;
            --card-hover: #162033;
            --card-border: #1E293B;
            --primary: #14B8A6;
            --primary-hover: #0D9488;
            --secondary: #0EA5E9;
            --accent: #67E8F9;
            --text: #E5E7EB;
            --gray: #94A3B8;
            --glow-teal: 0 0 30px rgba(20, 184, 166, 0.4);
        }

        [data-theme="light"] {
            --bg: #F1F5F9;
            --bg-deep: #E2E8F0;
            --card: #FFFFFF;
            --card-hover: #F8FAFC;
            --card-border: #CBD5E1;
            --text: #0F172A;
            --gray: #475569;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-font-smoothing: antialiased; list-style: none; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding-bottom: 110px;
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
        }

        h1, h2, h3, h4, h5 { font-family: 'Space Grotesk', sans-serif; letter-spacing: -0.02em; }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--bg-deep); }
        ::-webkit-scrollbar-thumb { background: var(--card-border); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        a { text-decoration: none; color: inherit; }
        ul, ol { margin: 0; padding: 0; list-style: none; }

        .bg-layer { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
        .bg-glow {
            background:
                radial-gradient(circle at 15% 20%, rgba(20, 184, 166, 0.12), transparent 45%),
                radial-gradient(circle at 85% 60%, rgba(14, 165, 233, 0.08), transparent 45%),
                radial-gradient(circle at 50% 100%, rgba(103, 232, 249, 0.06), transparent 50%);
            animation: glowShift 18s ease-in-out infinite alternate;
        }
        @keyframes glowShift {
            0%   { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.05) translate(-2%, -2%); }
        }
        .bg-grid {
            background-image:
                linear-gradient(rgba(20, 184, 166, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(20, 184, 166, 0.035) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, black 40%, transparent 85%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 40%, transparent 85%);
        }

        /* ============ NAVBAR ============ */
        .navbar-custom {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(8, 17, 26, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-height: 66px;
            overflow: visible;
        }

        [data-theme="light"] .navbar-custom { background: rgba(255, 255, 255, 0.92); }

        /* LEFT */
        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-shrink: 0;
            min-width: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 20px;
            letter-spacing: 2.5px;
            color: var(--accent);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .brand:hover { color: var(--primary); }
        .brand-logo-img { height: 32px; width: auto; object-fit: contain; display: block; }

        .brand-wave { display: flex; align-items: center; gap: 3px; height: 20px; }
        .brand-wave span {
            width: 3px; background: var(--primary); border-radius: 3px;
            animation: brandWave 1.4s ease-in-out infinite;
        }
        .brand-wave span:nth-child(1) { height: 8px;  animation-delay: 0s; }
        .brand-wave span:nth-child(2) { height: 14px; animation-delay: 0.15s; }
        .brand-wave span:nth-child(3) { height: 20px; animation-delay: 0.3s; }
        .brand-wave span:nth-child(4) { height: 11px; animation-delay: 0.45s; }
        .brand-wave span:nth-child(5) { height: 16px; animation-delay: 0.6s; }
        @keyframes brandWave {
            0%, 100% { transform: scaleY(0.6); opacity: 0.7; }
            50%      { transform: scaleY(1.2); opacity: 1; }
        }

        .nav-menu { display: flex; gap: 2px; align-items: center; }
        .nav-item {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 12px; color: var(--gray);
            font-weight: 600; font-size: 13px;
            border-radius: 10px; transition: all 0.25s ease;
            white-space: nowrap;
        }
        .nav-item i { font-size: 12px; }
        .nav-item:hover { color: var(--accent); background: rgba(20, 184, 166, 0.08); }
        .nav-item.active {
            color: var(--primary); background: rgba(20, 184, 166, 0.12);
            box-shadow: inset 0 0 0 1px rgba(20, 184, 166, 0.3);
        }
        .nav-item.active i { color: var(--primary); }

        /* RIGHT */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            min-width: 0;
        }

        /* SEARCH */
        .search-wrap {
            position: relative;
            width: 220px;
            flex-shrink: 1;
            min-width: 0;
            transition: width 0.3s ease;
        }
        .search-input {
            width: 100%;
            padding: 9px 34px 9px 36px;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid var(--card-border);
            border-radius: 11px;
            color: var(--text);
            font-size: 13px;
            font-family: inherit;
            transition: all 0.25s ease;
        }
        [data-theme="light"] .search-input { background: #FFFFFF; }
        .search-input::placeholder { color: rgba(148, 163, 184, 0.5); }
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.12);
        }
        .search-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--gray); font-size: 12px;
            pointer-events: none;
        }
        .search-clear {
            position: absolute; right: 8px; top: 50%;
            transform: translateY(-50%);
            color: var(--gray); font-size: 11px;
            cursor: pointer; background: none; border: none; padding: 4px;
        }

        /* THEME TOGGLE */
        .theme-toggle {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: rgba(20, 184, 166, 0.08);
            border: 1px solid var(--card-border);
            color: var(--text);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.3s ease;
            font-size: 14px; flex-shrink: 0;
        }
        .theme-toggle:hover {
            background: rgba(20, 184, 166, 0.15);
            border-color: var(--primary);
            color: var(--accent);
            transform: rotate(15deg);
        }

        /* BUTTONS */
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 14px; background: transparent;
            border: 1px solid var(--card-border);
            color: var(--text); border-radius: 10px;
            font-weight: 600; font-size: 13px; cursor: pointer;
            transition: all 0.25s ease; white-space: nowrap;
            flex-shrink: 0;
        }
        .btn-ghost:hover {
            background: rgba(20, 184, 166, 0.1);
            border-color: var(--primary); color: var(--accent);
        }

        .btn-primary-glow {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: var(--bg); border: none; border-radius: 10px;
            font-weight: 700; font-size: 13px; cursor: pointer;
            transition: all 0.3s ease; white-space: nowrap;
            flex-shrink: 0;
        }
        .btn-primary-glow:hover { box-shadow: var(--glow-teal); transform: translateY(-2px); }

        /* USER CHIP */
        .user-chip {
            display: flex; align-items: center; gap: 8px;
            padding: 4px 12px 4px 4px;
            background: rgba(20, 184, 166, 0.08);
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 30px;
            font-size: 13px; font-weight: 600;
            color: var(--text); white-space: nowrap;
            transition: all 0.25s ease;
            flex-shrink: 1;
            min-width: 0;
            max-width: 160px;
        }
        .user-chip:hover { background: rgba(20, 184, 166, 0.15); }
        .user-chip span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            min-width: 0;
        }

        .user-avatar {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--bg); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 12px;
            overflow: hidden; flex-shrink: 0;
        }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        /* LOGOUT */
        .logout-form { display: inline; margin: 0; flex-shrink: 0; }
        .logout-btn-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #FCA5A5;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 14px;
            padding: 0;
        }
        .logout-btn-icon:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #FFFFFF;
            border-color: #EF4444;
        }

        /* BURGER */
        .burger {
            display: none;
            background: transparent;
            border: 1px solid var(--card-border);
            color: var(--text);
            width: 38px; height: 38px;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
        }
        .burger:hover {
            background: rgba(20, 184, 166, 0.08);
            border-color: var(--primary);
        }

        /* PAGE WRAPPER */
        .page-wrapper {
            position: relative; z-index: 1;
            max-width: 1280px; margin: 0 auto; padding: 32px 24px;
        }

        /* BOTTOM PLAYER */
        .player {
            position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000;
            background: rgba(6, 13, 20, 0.95);
            backdrop-filter: blur(24px);
            border-top: 1px solid var(--card-border);
            padding: 10px 24px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 20px;
        }
        [data-theme="light"] .player { background: rgba(255, 255, 255, 0.96); }

        .player-track { display: flex; align-items: center; gap: 12px; width: 240px; flex-shrink: 0; }
        .player-art {
            width: 46px; height: 46px; border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex; align-items: center; justify-content: center;
            color: var(--bg); font-size: 18px;
            border: 1px solid var(--card-border);
            flex-shrink: 0;
        }
        .player-meta { line-height: 1.3; min-width: 0; }
        .player-title {
            font-size: 13px; font-weight: 700; color: var(--text);
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .player-artist {
            font-size: 11.5px; color: var(--gray);
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .player-center {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; gap: 6px; max-width: 560px; min-width: 0;
        }
        .player-controls { display: flex; align-items: center; gap: 16px; }
        .player-controls button {
            background: transparent; border: none;
            color: var(--gray); font-size: 15px; cursor: pointer;
            transition: all 0.25s ease; padding: 6px;
        }
        .player-controls button:hover { color: var(--primary); }
        .player-play {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: var(--bg);
            display: flex; align-items: center; justify-content: center;
            box-shadow: var(--glow-teal);
        }
        .player-progress {
            display: flex; align-items: center; gap: 8px;
            width: 100%; font-size: 11px; color: var(--gray); font-weight: 600;
        }
        .player-bar {
            flex: 1; height: 4px; background: rgba(148, 163, 184, 0.15);
            border-radius: 4px; overflow: hidden;
        }
        .player-bar-fill {
            width: 38%; height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 4px;
        }
        .player-right { display: flex; align-items: center; gap: 14px; color: var(--gray); flex-shrink: 0; }
        .player-right i { cursor: pointer; transition: color 0.25s ease; font-size: 14px; }
        .player-right i:hover { color: var(--primary); }
        .player-right .liked { color: var(--primary); }
        .player-wave { display: flex; align-items: flex-end; gap: 2px; height: 16px; }
        .player-wave span {
            width: 2px; background: var(--accent); border-radius: 2px;
            animation: playerWave 0.9s ease-in-out infinite;
        }
        .player-wave span:nth-child(1) { height: 40%; animation-delay: 0s; }
        .player-wave span:nth-child(2) { height: 80%; animation-delay: 0.1s; }
        .player-wave span:nth-child(3) { height: 60%; animation-delay: 0.2s; }
        .player-wave span:nth-child(4) { height: 90%; animation-delay: 0.3s; }
        .player-wave span:nth-child(5) { height: 50%; animation-delay: 0.4s; }
        @keyframes playerWave {
            0%, 100% { transform: scaleY(0.5); opacity: 0.7; }
            50%      { transform: scaleY(1); opacity: 1; }
        }

        /* MOBILE MENU OVERLAY */
        .mobile-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 95; opacity: 0;
            transition: opacity 0.3s ease;
        }
        .mobile-overlay.active { display: block; opacity: 1; }

        /* ============ RESPONSIVE BREAKPOINTS ============ */

        /* 1200px - Slight compact */
        @media (max-width: 1200px) {
            .navbar-custom { padding: 12px 20px; gap: 12px; }
            .nav-item { padding: 7px 10px; font-size: 12.5px; }
            .search-wrap { width: 180px; }
        }

        /* 991px - Hide nav menu, show burger */
        @media (max-width: 991px) {
            .navbar-custom { padding: 10px 16px; gap: 10px; }
            .nav-left { gap: 12px; }
            .nav-menu {
                display: none;
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: rgba(8, 17, 26, 0.98);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid var(--card-border);
                padding: 12px 20px;
                flex-direction: column;
                gap: 4px;
                animation: fadeSlide 0.3s ease;
                z-index: 99;
            }
            [data-theme="light"] .nav-menu { background: rgba(255, 255, 255, 0.98); }
            .nav-menu.show { display: flex; }
            .nav-menu .nav-item {
                width: 100%; padding: 12px 16px; justify-content: flex-start;
                font-size: 14px;
            }
            .burger { display: flex; }
            .search-wrap { width: 160px; }
            .theme-toggle { display: none; }
            .user-chip { max-width: 130px; }
            .page-wrapper { padding: 24px 16px; }
        }

        /* 768px - Compact right side */
        @media (max-width: 768px) {
            .navbar-custom { padding: 10px 14px; gap: 8px; min-height: 60px; }
            .nav-left { gap: 10px; }
            .brand { font-size: 17px; letter-spacing: 2px; gap: 8px; }
            .brand-logo-img { height: 28px; }
            .brand-wave span:nth-child(4),
            .brand-wave span:nth-child(5) { display: none; }
            .search-wrap { width: 130px; }
            .search-input { padding: 8px 30px 8px 32px; font-size: 12.5px; }
            .user-chip span { display: none; }
            .user-chip { padding: 3px; max-width: none; }
            .user-avatar { width: 30px; height: 30px; font-size: 12px; }
            .btn-ghost { padding: 8px 12px; font-size: 12.5px; }
            .btn-primary-glow { padding: 8px 14px; font-size: 12.5px; }
            .logout-btn-icon, .burger, .theme-toggle { width: 36px; height: 36px; font-size: 13px; }
            .page-wrapper { padding: 20px 14px; }
            .player { padding: 10px 14px; gap: 12px; }
            .player-track { width: auto; min-width: 0; }
            .player-track .player-meta { display: none; }
            .player-right .player-wave { display: none; }
        }

        /* 576px - Hide brand text, super compact */
        @media (max-width: 576px) {
            .navbar-custom { padding: 8px 12px; gap: 6px; min-height: 56px; }
            .brand span { display: none; }
            .brand { gap: 0; }
            .brand-logo-img { height: 26px; }
            .search-wrap { width: 110px; }
            .search-input { padding: 7px 26px 7px 28px; font-size: 12px; border-radius: 10px; }
            .search-icon { left: 10px; font-size: 11px; }
            .search-clear { right: 6px; }
            .nav-right { gap: 6px; }
            .user-avatar { width: 28px; height: 28px; font-size: 11.5px; }
            .logout-btn-icon, .burger { width: 34px; height: 34px; font-size: 12px; }
            .btn-ghost, .btn-primary-glow { padding: 7px 10px; font-size: 12px; }
            .btn-primary-glow span i { margin-right: 4px; }
            .player { padding: 8px 12px; gap: 10px; }
            .player-art { width: 40px; height: 40px; font-size: 16px; }
            .player-center { gap: 4px; }
            .player-controls { gap: 10px; }
            .player-controls button { font-size: 13px; padding: 4px; }
            .player-play { width: 34px; height: 34px; }
            .player-right { gap: 10px; }
            .player-right i { font-size: 13px; }
            .player-progress { font-size: 10px; gap: 6px; }
        }

        /* 400px - Ultra compact */
        @media (max-width: 400px) {
            .search-wrap { width: 90px; }
            .search-input { padding: 7px 22px 7px 26px; }
            .brand-logo-img { height: 24px; }
            .logout-btn-icon, .burger { width: 32px; height: 32px; font-size: 11px; }
            .user-avatar { width: 26px; height: 26px; font-size: 11px; }
        }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="bg-layer bg-glow"></div>
    <div class="bg-layer bg-grid"></div>

    <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

    <nav class="navbar-custom">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="brand">
                @php $siteLogo = \App\Models\Setting::get('site_logo'); @endphp
                @if($siteLogo && file_exists(storage_path('app/public/' . $siteLogo)))
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="AURAILS" class="brand-logo-img">
                @else
                    <div class="brand-wave">
                        <span></span><span></span><span></span><span></span><span></span>
                    </div>
                    <span>AURAILS</span>
                @endif
            </a>

            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="{{ route('frontend.music') }}" class="nav-item {{ request()->routeIs('frontend.music*') ? 'active' : '' }}"><i class="fa-solid fa-music"></i> Music</a></li>
                <li><a href="{{ route('frontend.artists') }}" class="nav-item {{ request()->routeIs('frontend.artists*') ? 'active' : '' }}"><i class="fa-solid fa-microphone"></i> Artists</a></li>
                <li><a href="{{ route('frontend.albums') }}" class="nav-item {{ request()->routeIs('frontend.albums*') ? 'active' : '' }}"><i class="fa-solid fa-compact-disc"></i> Albums</a></li>
                <li><a href="{{ route('frontend.videos') }}" class="nav-item {{ request()->routeIs('frontend.videos*') ? 'active' : '' }}"><i class="fa-solid fa-play"></i> Videos</a></li>
                @auth
                <li><a href="{{ route('frontend.favorites') }}" class="nav-item {{ request()->routeIs('frontend.favorites*') ? 'active' : '' }}"><i class="fa-solid fa-heart"></i> Favorites</a></li>
                @endauth
            </ul>
        </div>

        <div class="nav-right">
            <form action="{{ route('frontend.search') }}" method="GET" class="search-wrap" id="searchForm">
                <input type="text" name="q" class="search-input" placeholder="Search..." value="{{ request('q') }}" autocomplete="off">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                @if(request('q'))
                    <button type="button" class="search-clear" onclick="document.getElementById('searchForm').querySelector('input').value=''; this.style.display='none';">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                @endif
            </form>

            <button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
                <i class="fa-solid fa-moon" id="themeIcon"></i>
            </button>

            @auth
                <a href="{{ route('user.profile') }}" class="user-chip" title="{{ auth()->user()->user_name ?? 'User' }}">
                    <div class="user-avatar">
                        @if(auth()->user()->user_image && file_exists(storage_path('app/public/' . auth()->user()->user_image)))
                            <img src="{{ asset('storage/' . auth()->user()->user_image) }}" alt="">
                        @else
                            {{ strtoupper(substr(auth()->user()->user_name ?? 'U', 0, 1)) }}
                        @endif
                    </div>
                    <span>{{ auth()->user()->user_name ?? 'User' }}</span>
                </a>
                <form action="{{ route('user.logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn-icon" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('user.login') }}" class="btn-ghost">
                    <i class="fa-solid fa-right-to-bracket"></i> <span class="d-none d-md-inline">Login</span>
                </a>
                <a href="{{ route('user.register') }}" class="btn-primary-glow">
                    <i class="fa-solid fa-user-plus"></i> <span class="d-none d-md-inline">Register</span>
                </a>
            @endauth

            <button class="burger" onclick="toggleMobileMenu()">
                <i class="fa-solid fa-bars" id="burgerIcon"></i>
            </button>
        </div>
    </nav>

    <main class="page-wrapper">
        @if(session('success'))
            <div class="alert" style="background: rgba(20,184,166,0.12); border:1px solid rgba(20,184,166,0.35); color:#67E8F9; border-radius:12px; padding:14px 20px; margin-bottom:20px; font-weight:600;">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert" style="background: rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.35); color:#FCA5A5; border-radius:12px; padding:14px 20px; margin-bottom:20px; font-weight:600;">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <div class="player">
        <div class="player-track">
            <div class="player-art"><i class="fa-solid fa-music"></i></div>
            <div class="player-meta">
                <div class="player-title">Midnight Frequencies</div>
                <div class="player-artist">Neon Collective</div>
            </div>
        </div>
        <div class="player-center">
            <div class="player-controls">
                <button><i class="fa-solid fa-shuffle"></i></button>
                <button><i class="fa-solid fa-backward-step"></i></button>
                <button class="player-play"><i class="fa-solid fa-play"></i></button>
                <button><i class="fa-solid fa-forward-step"></i></button>
                <button><i class="fa-solid fa-repeat"></i></button>
            </div>
            <div class="player-progress">
                <span>1:24</span>
                <div class="player-bar"><div class="player-bar-fill"></div></div>
                <span>3:45</span>
            </div>
        </div>
        <div class="player-right">
            <div class="player-wave"><span></span><span></span><span></span><span></span><span></span></div>
            <i class="fa-solid fa-heart liked"></i>
            <i class="fa-solid fa-volume-high"></i>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fallback = 'https://via.placeholder.com/400x400/0F172A/14B8A6?text=%E2%99%AA';
            document.querySelectorAll('img').forEach(img => {
                if (img.classList.contains('brand-logo-img')) return;
                img.addEventListener('error', function () {
                    if (!this.dataset.fb) {
                        this.dataset.fb = 'true';
                        this.src = fallback;
                    }
                });
            });
            updateThemeIcon();
        });

        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme') || 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('aurails-theme', next);
            updateThemeIcon();
        }

        function updateThemeIcon() {
            const theme = document.documentElement.getAttribute('data-theme') || 'dark';
            const icon = document.getElementById('themeIcon');
            if (icon) icon.className = theme === 'dark' ? 'fa-solid fa-moon' : 'fa-solid fa-sun';
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('navMenu');
            const overlay = document.getElementById('mobileOverlay');
            const icon = document.getElementById('burgerIcon');
            menu.classList.toggle('show');
            overlay.classList.toggle('active');
            if (menu.classList.contains('show')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
                document.body.style.overflow = 'hidden';
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
                document.body.style.overflow = '';
            }
        }

        function closeMobileMenu() {
            const menu = document.getElementById('navMenu');
            const overlay = document.getElementById('mobileOverlay');
            const icon = document.getElementById('burgerIcon');
            menu.classList.remove('show');
            overlay.classList.remove('active');
            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');
            document.body.style.overflow = '';
        }

        function showToast(message, type = 'success') {
            const wrap = document.createElement('div');
            wrap.style.cssText = 'position:fixed;bottom:110px;right:20px;z-index:9999;max-width:calc(100vw - 40px);';
            const toast = document.createElement('div');
            toast.style.cssText = `
                display:flex;align-items:center;gap:10px;padding:12px 18px;
                border-radius:12px;font-weight:600;font-size:13.5px;
                box-shadow:0 12px 30px rgba(0,0,0,0.4);
                background:${type === 'success' ? 'linear-gradient(135deg,#14B8A6,#0D9488)' : 'linear-gradient(135deg,#EF4444,#DC2626)'};
                color:${type === 'success' ? '#08111A' : 'white'};
            `;
            toast.innerHTML = `<i class="fa-solid ${type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'}"></i> ${message}`;
            wrap.appendChild(toast);
            document.body.appendChild(wrap);
            setTimeout(() => {
                toast.style.transition = 'all 0.4s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(120%)';
                setTimeout(() => wrap.remove(), 400);
            }, 3200);
        }

        function shareOn(platform, url, title) {
            let shareUrl = '';
            switch(platform) {
                case 'facebook': shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url); break;
                case 'twitter': shareUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title); break;
                case 'whatsapp': shareUrl = 'https://wa.me/?text=' + encodeURIComponent(title + ' ' + url); break;
                case 'telegram': shareUrl = 'https://t.me/share/url?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title); break;
                case 'linkedin': shareUrl = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(url); break;
            }
            if (shareUrl) window.open(shareUrl, '_blank', 'width=600,height=500');
        }

        function copyLink(url) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => showToast('Link copied!'));
            } else {
                const input = document.createElement('input');
                input.value = url;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                input.remove();
                showToast('Link copied!');
            }
        }
    </script>

    @stack('scripts')
</body>
</html>