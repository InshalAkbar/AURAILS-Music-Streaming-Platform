<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AURAILS — Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #08111A;
            --bg-footer: #060D14;
            --card: #0F172A;
            --primary: #14B8A6;
            --primary-hover: #0D9488;
            --secondary: #0EA5E9;
            --accent: #67E8F9;
            --text: #E5E7EB;
            --gray: #94A3B8;
            --border: #1E293B;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ========== BACKGROUND SLIDER ========== */
        .bg-slider {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .bg-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            animation: slideShow 25s infinite;
            filter: brightness(0.45) saturate(1.1);
            transform: scale(1.1);
        }

        .bg-slide:nth-child(1) { animation-delay: 0s; }
        .bg-slide:nth-child(2) { animation-delay: 5s; }
        .bg-slide:nth-child(3) { animation-delay: 10s; }
        .bg-slide:nth-child(4) { animation-delay: 15s; }
        .bg-slide:nth-child(5) { animation-delay: 20s; }

        @keyframes slideShow {
            0%    { opacity: 0; transform: scale(1.1); }
            4%    { opacity: 1; }
            20%   { opacity: 1; transform: scale(1); }
            24%   { opacity: 0; }
            100%  { opacity: 0; transform: scale(1.1); }
        }

        .bg-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            background:
                radial-gradient(ellipse at 50% 50%, rgba(20, 184, 166, 0.08), transparent 60%),
                linear-gradient(135deg, rgba(8, 17, 26, 0.93) 0%, rgba(8, 17, 26, 0.88) 50%, rgba(6, 13, 20, 0.96) 100%);
            pointer-events: none;
        }

        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 1;
            background-image:
                linear-gradient(rgba(20, 184, 166, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(20, 184, 166, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
            pointer-events: none;
        }

        .admin-badge {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            background: rgba(20, 184, 166, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(20, 184, 166, 0.35);
            border-radius: 30px;
            color: var(--accent);
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .back-home {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 10;
            color: var(--gray);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .back-home:hover {
            color: var(--accent);
            border-color: rgba(20, 184, 166, 0.4);
            background: rgba(15, 23, 42, 0.85);
        }

        /* ========== LOGIN CARD ========== */
        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 420px;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(24px);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 38px 36px;
            box-shadow:
                0 30px 60px -20px rgba(0, 0, 0, 0.6),
                0 0 0 1px rgba(20, 184, 166, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), var(--accent), var(--primary), transparent);
            background-size: 200% 100%;
            animation: borderShift 3s linear infinite;
        }

        @keyframes borderShift {
            to { background-position: 200% 0; }
        }

        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 22px;
            letter-spacing: 3px;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .brand-wave {
            display: flex;
            align-items: center;
            gap: 3px;
            height: 20px;
        }

        .brand-wave span {
            width: 3px;
            background: var(--primary);
            border-radius: 3px;
            animation: brandWave 1.4s ease-in-out infinite;
        }

        .brand-wave span:nth-child(1) { height: 8px;  animation-delay: 0s; }
        .brand-wave span:nth-child(2) { height: 14px; animation-delay: 0.15s; }
        .brand-wave span:nth-child(3) { height: 20px; animation-delay: 0.3s; }
        .brand-wave span:nth-child(4) { height: 12px; animation-delay: 0.45s; }
        .brand-wave span:nth-child(5) { height: 16px; animation-delay: 0.6s; }

        @keyframes brandWave {
            0%, 100% { transform: scaleY(0.6); opacity: 0.7; }
            50%      { transform: scaleY(1.2); opacity: 1; }
        }

        .login-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 6px;
            text-align: center;
            letter-spacing: -0.02em;
        }

        .login-sub {
            color: var(--gray);
            font-size: 13px;
            text-align: center;
        }

        .alert {
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 12.5px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            animation: alertSlide 0.4s ease;
        }

        @keyframes alertSlide {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .alert i { margin-top: 2px; }

        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #FCA5A5;
        }

        .alert-success {
            background: rgba(20, 184, 166, 0.12);
            border: 1px solid rgba(20, 184, 166, 0.35);
            color: var(--accent);
        }

        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block;
            color: var(--text);
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 14px;
            transition: color 0.25s ease;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            background: rgba(8, 17, 26, 0.7);
            border: 1px solid var(--border);
            border-radius: 11px;
            color: var(--text);
            font-size: 14px;
            font-family: inherit;
            transition: all 0.25s ease;
        }

        .form-input::placeholder {
            color: rgba(148, 163, 184, 0.4);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(8, 17, 26, 0.95);
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.12);
        }

        .input-wrap:focus-within .input-icon {
            color: var(--primary);
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: var(--primary);
            color: var(--bg);
            border: none;
            border-radius: 11px;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            margin-top: 6px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 24px -8px rgba(20, 184, 166, 0.5);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--primary-hover);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px -8px rgba(20, 184, 166, 0.7);
        }

        .btn-login:hover::before { opacity: 1; }

        .btn-login > * { position: relative; z-index: 1; }

        .btn-login:active {
            transform: translateY(0);
        }

        .protected-note {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--gray);
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .protected-note i { color: var(--accent); }

        @media (max-width: 576px) {
            body { padding: 70px 16px 20px; }
            .login-card { padding: 28px 22px; border-radius: 16px; }
            .login-title { font-size: 22px; }
            .brand-logo { font-size: 20px; }
            .back-home { top: 16px; left: 16px; padding: 8px 12px; font-size: 12px; }
            .back-home span { display: none; }
            .admin-badge { top: 16px; right: 16px; font-size: 9px; padding: 6px 10px; }
        }
    </style>
</head>
<body>

    @php
        $bgImages = [
            'artists/atif-aslam.jpg',
            'artists/taylor-swift.jpg',
            'artists/billie-eilish.jpg',
            'artists/arijit-singh.jpg',
            'artists/ed-sheeran.jpg',
        ];
    @endphp

    <div class="bg-slider">
        @foreach($bgImages as $img)
            <div class="bg-slide" style="background-image: url('{{ asset('storage/' . $img) }}');"></div>
        @endforeach
    </div>
    <div class="bg-overlay"></div>
    <div class="bg-grid"></div>

    <a href="{{ route('home') }}" class="back-home">
        <i class="fa-solid fa-arrow-left"></i> <span>Back to Home</span>
    </a>

    <div class="admin-badge">
        <i class="fa-solid fa-shield-halved"></i> Admin Access
    </div>

    <div class="login-card">

        <div class="brand">
            <div class="brand-logo">
                <div class="brand-wave">
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
                <span>AURAILS</span>
            </div>
        </div>

        <h2 class="login-title">Admin Sign In</h2>
        <p class="login-sub">Restricted access — authorized personnel only</p>

        <div style="height: 22px;"></div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input
                        type="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        placeholder="admin@aurails.com"
                        required
                        autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="••••••••"
                        required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <span><i class="fa-solid fa-shield-halved me-1"></i> Login to Dashboard</span>
            </button>
        </form>

        <div class="protected-note">
            <i class="fa-solid fa-lock"></i>
            <span>Protected by Aurails Security</span>
        </div>
    </div>

</body>
</html>