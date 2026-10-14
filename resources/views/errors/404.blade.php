<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page Not Found | AURAILS</title>
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
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 20px;
        }

        /* ========== BACKGROUND ========== */
        .bg-glow {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at 30% 30%, rgba(20, 184, 166, 0.12), transparent 55%),
                radial-gradient(ellipse at 70% 70%, rgba(103, 232, 249, 0.08), transparent 55%);
            animation: glowShift 18s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes glowShift {
            0%   { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.08) translate(-2%, 2%); }
        }

        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(20, 184, 166, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(20, 184, 166, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, black 40%, transparent 85%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 40%, transparent 85%);
            pointer-events: none;
            z-index: 0;
        }

        /* ========== CONTENT ========== */
        .error-wrap {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 620px;
        }

        .error-code {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 180px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.05em;
            background: linear-gradient(135deg, var(--primary), var(--accent), var(--secondary));
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientMove 5s ease infinite;
            margin-bottom: 12px;
            text-shadow: 0 0 80px rgba(20, 184, 166, 0.3);
        }

        @keyframes gradientMove {
            0%, 100% { background-position: 0% 50%; }
            50%      { background-position: 100% 50%; }
        }

        .error-icon {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 30px;
            align-items: flex-end;
            height: 40px;
        }

        .error-icon span {
            width: 5px;
            background: linear-gradient(to top, var(--primary), var(--accent));
            border-radius: 5px;
            animation: soundWave 1.4s ease-in-out infinite;
            box-shadow: 0 0 12px rgba(103, 232, 249, 0.5);
        }

        .error-icon span:nth-child(1) { height: 15px; animation-delay: 0s; }
        .error-icon span:nth-child(2) { height: 28px; animation-delay: 0.1s; }
        .error-icon span:nth-child(3) { height: 40px; animation-delay: 0.2s; }
        .error-icon span:nth-child(4) { height: 22px; animation-delay: 0.3s; }
        .error-icon span:nth-child(5) { height: 35px; animation-delay: 0.4s; }
        .error-icon span:nth-child(6) { height: 18px; animation-delay: 0.5s; }
        .error-icon span:nth-child(7) { height: 30px; animation-delay: 0.6s; }

        @keyframes soundWave {
            0%, 100% { transform: scaleY(0.5); opacity: 0.6; }
            50%      { transform: scaleY(1.1); opacity: 1; }
        }

        .error-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 36px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 14px;
            letter-spacing: -0.02em;
        }

        .error-desc {
            color: var(--gray);
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 460px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-actions {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary-glow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 26px;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: var(--bg);
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14.5px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none;
            box-shadow: 0 8px 24px -8px rgba(20, 184, 166, 0.5);
            position: relative;
            overflow: hidden;
        }

        .btn-primary-glow::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-primary-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px -8px rgba(20, 184, 166, 0.8);
        }

        .btn-primary-glow:hover::before { opacity: 1; }
        .btn-primary-glow > * { position: relative; z-index: 1; }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 24px;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 12px;
            font-weight: 600;
            font-size: 14.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-ghost:hover {
            background: rgba(20, 184, 166, 0.1);
            border-color: var(--primary);
            color: var(--accent);
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 576px) {
            .error-code { font-size: 110px; }
            .error-title { font-size: 26px; }
            .error-desc { font-size: 14px; }
            .btn-primary-glow, .btn-ghost { padding: 11px 20px; font-size: 13.5px; }
        }
    </style>
</head>
<body>

    <div class="bg-glow"></div>
    <div class="bg-grid"></div>

    <div class="error-wrap">

        <div class="error-code">404</div>

        <div class="error-icon">
            <span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>

        <h1 class="error-title">This Track Doesn't Exist</h1>

        <p class="error-desc">
            The page you're looking for seems to have been remixed, deleted, or never existed.
            Let's get you back to the music.
        </p>

        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn-primary-glow">
                <span><i class="fa-solid fa-house me-1"></i> Back to Home</span>
            </a>
            <a href="{{ url('/music') }}" class="btn-ghost">
                <i class="fa-solid fa-music"></i> Browse Music
            </a>
        </div>
    </div>

</body>
</html>