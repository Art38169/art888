<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ filled($title ?? null) ? $title.' - ART888' : 'ART888' }}</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
        <style>
            :root {
                --black: #07060a;
                --card: #14121a;
                --card-hover: #1a1820;
                --gold: #c9a84c;
                --gold-bright: #e8c85a;
                --gold-dim: #8b7332;
                --cream: #f5e6c8;
                --smoke: #6b6575;
                --wine: #5c1a2a;
                --error: #e54545;
            }

            * { margin: 0; padding: 0; box-sizing: border-box; }

            body {
                background: var(--black);
                color: var(--cream);
                font-family: 'Cormorant Garamond', serif;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow-x: hidden;
            }

            body::before {
                content: '';
                position: fixed;
                inset: 0;
                background: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
                pointer-events: none;
                z-index: 100;
            }

            body::after {
                content: '';
                position: fixed;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(ellipse at 30% 20%, rgba(201, 168, 76, 0.04) 0%, transparent 50%),
                            radial-gradient(ellipse at 70% 80%, rgba(92, 26, 42, 0.06) 0%, transparent 50%);
                pointer-events: none;
                z-index: 0;
            }

            .back-link {
                position: fixed;
                top: 28px;
                left: 32px;
                display: flex;
                align-items: center;
                gap: 12px;
                text-decoration: none;
                color: var(--smoke);
                transition: color 0.3s;
                z-index: 50;
            }

            .back-link:hover { color: var(--gold); }

            .back-link .back-arrow {
                width: 32px;
                height: 32px;
                border: 1px solid rgba(201, 168, 76, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s;
            }

            .back-link:hover .back-arrow {
                border-color: var(--gold);
                background: rgba(201, 168, 76, 0.06);
            }

            .back-arrow svg {
                width: 14px;
                height: 14px;
                stroke: currentColor;
                fill: none;
                stroke-width: 1.5;
                stroke-linecap: round;
                stroke-linejoin: round;
                transition: transform 0.3s;
            }

            .back-link:hover .back-arrow svg {
                transform: translateX(-2px);
            }

            .back-label {
                font-size: 0.7rem;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                font-weight: 500;
            }

            .auth-container {
                position: relative;
                z-index: 10;
                width: 100%;
                max-width: 420px;
                padding: 24px;
            }

            .auth-brand {
                text-align: center;
                margin-bottom: 48px;
            }

            .auth-brand a {
                text-decoration: none;
                font-family: 'Playfair Display', serif;
                font-size: 1.3rem;
                letter-spacing: 0.35em;
                color: var(--gold);
                text-transform: uppercase;
                font-weight: 400;
            }

            .auth-brand a span {
                font-weight: 900;
                font-size: 1.5rem;
            }

            .auth-card {
                background: #1c1924;
                border: 1px solid rgba(201, 168, 76, 0.18);
                padding: 48px 40px;
                position: relative;
                box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
            }

            .auth-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, var(--gold), transparent);
                opacity: 0.3;
            }

            .auth-title {
                font-family: 'Playfair Display', serif;
                font-size: 1.6rem;
                font-weight: 700;
                color: var(--cream);
                margin-bottom: 6px;
                text-align: center;
            }

            .auth-subtitle {
                font-size: 0.95rem;
                color: var(--smoke);
                text-align: center;
                margin-bottom: 32px;
                font-weight: 300;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                font-size: 0.8rem;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: var(--gold-dim);
                margin-bottom: 8px;
                font-weight: 500;
            }

            .form-input {
                width: 100%;
                padding: 14px 16px;
                background: rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(201, 168, 76, 0.18);
                color: var(--cream);
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.05rem;
                transition: all 0.3s;
                outline: none;
            }

            .form-input::placeholder {
                color: var(--smoke);
                opacity: 0.5;
            }

            .form-input:focus {
                border-color: var(--gold);
                background: rgba(201, 168, 76, 0.03);
                box-shadow: 0 0 0 1px rgba(201, 168, 76, 0.15);
            }

            .form-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
            }

            .form-checkbox {
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
            }

            .form-checkbox input[type="checkbox"] {
                appearance: none;
                width: 16px;
                height: 16px;
                border: 1px solid rgba(201, 168, 76, 0.25);
                background: transparent;
                cursor: pointer;
                position: relative;
                flex-shrink: 0;
            }

            .form-checkbox input[type="checkbox"]:checked {
                background: var(--gold);
                border-color: var(--gold);
            }

            .form-checkbox input[type="checkbox"]:checked::after {
                content: '✓';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: var(--black);
                font-size: 11px;
                font-weight: bold;
            }

            .form-checkbox span {
                font-size: 0.9rem;
                color: var(--smoke);
            }

            .form-link {
                color: var(--gold-dim);
                text-decoration: none;
                font-size: 0.85rem;
                transition: color 0.3s;
                font-weight: 500;
            }

            .form-link:hover {
                color: var(--gold);
            }

            .btn-submit {
                display: block;
                width: 100%;
                padding: 16px;
                background: linear-gradient(135deg, var(--gold-dim), var(--gold));
                color: var(--black);
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.9rem;
                font-weight: 600;
                letter-spacing: 0.25em;
                text-transform: uppercase;
                border: none;
                cursor: pointer;
                transition: all 0.3s;
            }

            .btn-submit:hover {
                background: linear-gradient(135deg, var(--gold), var(--gold-bright));
                box-shadow: 0 4px 30px rgba(201, 168, 76, 0.2);
            }

            .auth-footer {
                text-align: center;
                margin-top: 24px;
                font-size: 0.9rem;
                color: var(--smoke);
            }

            .auth-footer a {
                color: var(--gold);
                text-decoration: none;
                font-weight: 500;
                transition: color 0.3s;
            }

            .auth-footer a:hover {
                color: var(--gold-bright);
            }

            .auth-status {
                text-align: center;
                padding: 12px 16px;
                margin-bottom: 20px;
                font-size: 0.9rem;
                background: rgba(201, 168, 76, 0.06);
                border: 1px solid rgba(201, 168, 76, 0.12);
                color: var(--gold);
            }

            .auth-errors {
                margin-bottom: 20px;
                padding: 12px 16px;
                background: rgba(229, 69, 69, 0.06);
                border: 1px solid rgba(229, 69, 69, 0.15);
            }

            .auth-errors p {
                color: var(--error);
                font-size: 0.85rem;
                line-height: 1.6;
            }

            .floating-accent {
                position: fixed;
                width: 300px;
                height: 300px;
                border-radius: 50%;
                filter: blur(120px);
                pointer-events: none;
                z-index: 1;
                animation: drift 20s ease-in-out infinite;
            }

            .floating-accent.a1 {
                background: rgba(201, 168, 76, 0.06);
                top: 10%;
                right: 10%;
            }

            .floating-accent.a2 {
                background: rgba(92, 26, 42, 0.08);
                bottom: 20%;
                left: 5%;
                animation-delay: -10s;
            }

            @keyframes drift {
                0%, 100% { transform: translate(0, 0); }
                33% { transform: translate(30px, -20px); }
                66% { transform: translate(-20px, 30px); }
            }
        </style>
    </head>
    <body>
        <div class="floating-accent a1"></div>
        <div class="floating-accent a2"></div>

        <a href="{{ route('home') }}" class="back-link">
            <div class="back-arrow"><svg viewBox="0 0 24 24"><path d="M19 12H5M5 12l6-6M5 12l6 6"/></svg></div>
            <span class="back-label">Lobby</span>
        </a>

        <div class="auth-container">
            <div class="auth-brand">
                <a href="{{ route('home') }}"><span>ART</span>888</a>
            </div>
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
