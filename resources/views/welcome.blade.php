<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ART888</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #07060a;
            --deep: #0e0d12;
            --card: #14121a;
            --gold: #c9a84c;
            --gold-bright: #e8c85a;
            --gold-dim: #a08840;
            --cream: #f5e6c8;
            --smoke: #9e95a8;
            --wine: #5c1a2a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--black);
            color: var(--cream);
            font-family: 'Cormorant Garamond', serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
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

        .gold-line {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-dim), var(--gold), var(--gold-dim), transparent);
            opacity: 0.4;
        }

        nav {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px 48px;
        }

        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            letter-spacing: 0.35em;
            color: var(--gold);
            text-transform: uppercase;
            font-weight: 400;
        }

        .nav-brand span {
            font-weight: 900;
            font-size: 1.3rem;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-links a {
            color: var(--smoke);
            text-decoration: none;
            font-size: 0.95rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            transition: color 0.3s;
            font-weight: 500;
        }

        .nav-links a:hover { color: #fff; }

        .nav-links .btn-register {
            color: var(--black);
            background: linear-gradient(135deg, var(--gold), var(--gold-bright));
            padding: 10px 28px;
            letter-spacing: 0.15em;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .nav-links .btn-register:hover {
            background: linear-gradient(135deg, var(--gold-bright), var(--gold));
            box-shadow: 0 0 30px rgba(201, 168, 76, 0.25);
        }

        .hero {
            position: relative;
            z-index: 5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 80px 48px 40px;
            text-align: center;
        }

        .hero-overline {
            font-size: 0.8rem;
            letter-spacing: 0.5em;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 24px;
            font-weight: 500;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(4rem, 10vw, 9rem);
            font-weight: 900;
            line-height: 0.9;
            background: linear-gradient(180deg, var(--cream) 0%, var(--gold) 50%, var(--gold-dim) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }

        .hero h1 em {
            font-style: italic;
            font-weight: 400;
            display: block;
            font-size: 0.45em;
            letter-spacing: 0.15em;
            -webkit-text-fill-color: var(--gold-dim);
            margin-top: 8px;
        }

        .hero-tagline {
            font-size: 1.15rem;
            color: #b5adc0;
            max-width: 480px;
            line-height: 1.7;
            font-weight: 400;
            margin-bottom: 48px;
        }

        .credit-display {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.15);
            padding: 16px 40px;
            margin-bottom: 80px;
        }

        .credit-display .label {
            font-size: 0.75rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--smoke);
        }

        .credit-display .amount {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--gold);
        }

        .credit-display .currency {
            font-size: 0.85rem;
            color: var(--gold-dim);
            letter-spacing: 0.15em;
        }

        .games-section {
            position: relative;
            z-index: 5;
            padding: 0 48px 100px;
            display: flex;
            justify-content: center;
            gap: 2px;
        }

        .game-card {
            width: 420px;
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.08);
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: 0;
            transition: opacity 0.5s;
        }

        .game-card:hover::before { opacity: 0.6; }

        .game-card:hover {
            background: rgba(201, 168, 76, 0.03);
            border-color: rgba(201, 168, 76, 0.15);
            transform: translateY(-4px);
        }

        .game-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .dice-face {
            width: 64px;
            height: 64px;
            border: 2px solid var(--gold-dim);
            border-radius: 8px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            padding: 8px;
            transform: rotate(-12deg);
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .game-card:hover .dice-face { transform: rotate(0deg); }

        .dice-dot {
            width: 8px;
            height: 8px;
            background: var(--gold);
            border-radius: 50%;
            align-self: center;
            justify-self: center;
        }

        .dice-dot:nth-child(1) { grid-area: 1/1; }
        .dice-dot:nth-child(2) { grid-area: 1/3; }
        .dice-dot:nth-child(3) { grid-area: 2/2; }
        .dice-dot:nth-child(4) { grid-area: 3/1; }
        .dice-dot:nth-child(5) { grid-area: 3/3; }

        .coin-icon {
            width: 64px;
            height: 64px;
            border: 2px solid var(--gold-dim);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--gold);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .game-card:hover .coin-icon {
            transform: rotateY(180deg);
        }

        .game-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 12px;
            letter-spacing: 0.02em;
        }

        .game-card .game-subtitle {
            font-size: 0.8rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 20px;
        }

        .game-card p {
            color: #b5adc0;
            font-size: 1.05rem;
            line-height: 1.7;
            margin-bottom: 36px;
            font-weight: 400;
        }

        .game-options {
            display: flex;
            gap: 12px;
        }

        .game-option {
            flex: 1;
            padding: 14px;
            text-align: center;
            background: rgba(201, 168, 76, 0.05);
            border: 1px solid rgba(201, 168, 76, 0.12);
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.3s;
        }

        .game-option:hover {
            background: rgba(201, 168, 76, 0.12);
            border-color: var(--gold);
        }

        .play-btn {
            display: block;
            width: 100%;
            margin-top: 16px;
            padding: 16px;
            background: linear-gradient(135deg, var(--gold-dim), var(--gold));
            color: var(--black);
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .play-btn:hover {
            background: linear-gradient(135deg, var(--gold), var(--gold-bright));
            box-shadow: 0 4px 30px rgba(201, 168, 76, 0.2);
        }

        footer {
            position: relative;
            z-index: 5;
            text-align: center;
            padding: 40px 48px;
            border-top: 1px solid rgba(201, 168, 76, 0.06);
        }

        footer p {
            font-size: 0.8rem;
            color: var(--smoke);
            letter-spacing: 0.15em;
            opacity: 0.6;
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

        @media (max-width: 900px) {
            .games-section { flex-direction: column; align-items: center; gap: 16px; }
            .game-card { width: 100%; max-width: 420px; }
            nav { padding: 20px 24px; }
            .hero { padding: 60px 24px 40px; }
            .games-section { padding: 0 24px 60px; }
        }
    </style>
</head>
<body>
    <div class="floating-accent a1"></div>
    <div class="floating-accent a2"></div>

    <nav>
        <div class="nav-brand"><span>ART</span>888</div>
        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-register">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <div class="gold-line"></div>

    <section class="hero">
        <div class="hero-overline">Fortune Favours the Bold</div>
        <h1>ART888<em>The House of Chance</em></h1>
        <p class="hero-tagline">Two timeless games. One elegant stage. Begin with a thousand credits and let fortune guide your hand.</p>

        <div class="credit-display">
            <div>
                <div class="label">Starting Balance</div>
                <div style="display:flex;align-items:baseline;gap:10px;">
                    <div class="amount">1,000</div>
                    <div class="currency">CREDITS</div>
                </div>
            </div>
        </div>
    </section>

    <section class="games-section">
        <div class="game-card">
            <div class="game-icon">
                <div class="dice-face">
                    <div class="dice-dot"></div>
                    <div class="dice-dot"></div>
                    <div class="dice-dot"></div>
                    <div class="dice-dot"></div>
                    <div class="dice-dot"></div>
                </div>
            </div>
            <div class="game-subtitle">Game I</div>
            <h2>Guess the Dice</h2>
            <p>Two dice cast into fate. Will the sum fall below seven, land exactly on it, or dare you wager it climbs higher?</p>
            <div class="game-options">
                <div class="game-option">&lt; 7</div>
                <div class="game-option">7</div>
                <div class="game-option">&gt; 7</div>
            </div>
            <a href="{{ route('games.dice') }}" class="play-btn" style="text-align:center;text-decoration:none;">Enter the Table</a>
        </div>

        <div class="game-card">
            <div class="game-icon">
                <div class="coin-icon">A</div>
            </div>
            <div class="game-subtitle">Game II</div>
            <h2>Coin of Fate</h2>
            <p>A single coin, two faces, one truth. Call it in the air and claim your winnings&mdash;or watch them vanish.</p>
            <div class="game-options">
                <div class="game-option">Heads</div>
                <div class="game-option">Tails</div>
            </div>
            <a href="{{ route('games.coin') }}" class="play-btn" style="text-align:center;text-decoration:none;">Flip the Coin</a>
        </div>
    </section>

    <div class="gold-line"></div>

    <footer>
        <p>ART888 &mdash; All credits are fictional. Play responsibly.</p>
    </footer>
</body>
</html>
