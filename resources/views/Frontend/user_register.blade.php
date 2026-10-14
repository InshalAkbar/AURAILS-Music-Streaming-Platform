<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AURAILS — Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #08111A;
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
            min-height: 100%;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 20px 40px;
            overflow-x: hidden;
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

        /* ========== REGISTER CARD ========== */
        .register-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 460px;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(24px);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 36px 36px 30px;
            box-shadow:
                0 30px 60px -20px rgba(0, 0, 0, 0.6),
                0 0 0 1px rgba(20, 184, 166, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);
            overflow: hidden;
        }

        .register-card::before {
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
            margin-bottom: 20px;
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
            margin-bottom: 10px;
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

        .register-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 6px;
            text-align: center;
            letter-spacing: -0.02em;
        }

        .register-sub {
            color: var(--gray);
            font-size: 13px;
            text-align: center;
        }

        .alert {
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 12.5px;
            margin-bottom: 16px;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-group { margin-bottom: 14px; }

        .form-label {
            display: block;
            color: var(--text);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 13px;
            transition: color 0.25s ease;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px 11px 40px;
            background: rgba(8, 17, 26, 0.7);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-size: 13.5px;
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

        .btn-register {
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
            margin-top: 8px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 24px -8px rgba(20, 184, 166, 0.5);
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--primary-hover);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px -8px rgba(20, 184, 166, 0.7);
        }

        .btn-register:hover::before { opacity: 1; }

        .btn-register > * { position: relative; z-index: 1; }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 18px 0;
            color: var(--gray);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .login-link {
            text-align: center;
            color: var(--gray);
            font-size: 13px;
        }

        .login-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.25s ease;
        }

        .login-link a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            body { padding: 70px 14px 30px; }
            .register-card { padding: 26px 22px; border-radius: 16px; }
            .register-title { font-size: 21px; }
            .brand-logo { font-size: 19px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
            .back-home { top: 14px; left: 14px; padding: 8px 12px; font-size: 12px; }
            .back-home span { display: none; }
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

    <div class="register-card">

        <div class="brand">
            <div class="brand-logo">
                <div class="brand-wave">
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
                <span>AURAILS</span>
            </div>
        </div>

        <h2 class="register-title">Create your account</h2>
        <p class="register-sub">Join Aurails — start streaming today</p>

        <div style="height: 18px;"></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('user.register.post') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user input-icon"></i>
                    <input
                        type="text"
                        name="name"
                        class="form-input"
                        placeholder="John Doe"
                        value="{{ old('name') }}"
                        required
                        autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input
                        type="email"
                        name="email"
                        class="form-input"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input
                            type="text"
                            name="phone"
                            class="form-input"
                            placeholder="Optional"
                            value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-location-dot input-icon"></i>
                        <input
                            type="text"
                            name="address"
                            class="form-input"
                            placeholder="Optional"
                            value="{{ old('address') }}">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input
                            type="password"
                            name="password"
                            class="form-input"
                            placeholder="Min. 6 characters"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-input"
                            placeholder="Repeat password"
                            required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <span><i class="fa-solid fa-user-plus me-1"></i> Create Account</span>
            </button>
        </form>

        <div class="divider">Or</div>

        <div class="login-link">
            Already have an account? <a href="{{ route('user.login') }}">Sign in</a>
        </div>
    </div>

</body>
</html>