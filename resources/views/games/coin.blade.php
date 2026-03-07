<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coin — ART888</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #07060a;
            --card: #14121a;
            --card-light: #1c1924;
            --gold: #c9a84c;
            --gold-bright: #e8c85a;
            --gold-dim: #8b7332;
            --cream: #f5e6c8;
            --smoke: #6b6575;
            --wine: #5c1a2a;
            --green: #4a9e6e;
            --red: #c94040;
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
            text-decoration: none;
        }

        .nav-brand span { font-weight: 900; font-size: 1.3rem; }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .credit-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card-light);
            border: 1px solid rgba(201, 168, 76, 0.15);
            padding: 8px 20px;
        }

        .credit-chip .credit-label {
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--smoke);
        }

        .credit-chip .credit-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--gold);
        }

        .nav-link {
            color: var(--smoke);
            text-decoration: none;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover { color: var(--cream); }

        .gold-line {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-dim), var(--gold), var(--gold-dim), transparent);
            opacity: 0.4;
        }

        .game-container {
            position: relative;
            z-index: 5;
            max-width: 700px;
            margin: 0 auto;
            padding: 60px 32px 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .game-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .game-overline {
            font-size: 0.75rem;
            letter-spacing: 0.5em;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 12px;
        }

        .game-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--cream);
            margin-bottom: 8px;
        }

        .game-header p {
            color: var(--smoke);
            font-size: 1.05rem;
            font-weight: 300;
        }

        /* --- Coin --- */

        .coin-stage {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            min-height: 200px;
            perspective: 800px;
        }

        .coin-wrapper {
            width: 160px;
            height: 160px;
            position: relative;
            transform-style: preserve-3d;
        }

        .coin {
            width: 160px;
            height: 160px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.1s;
        }

        .coin.flipping {
            animation: coinFlip 1.6s cubic-bezier(0.3, 0, 0.2, 1);
        }

        .coin.show-heads {
            transform: rotateY(0deg);
        }

        .coin.show-tails {
            transform: rotateY(180deg);
        }

        @keyframes coinFlip {
            0%   { transform: rotateY(0deg)    translateY(0); }
            15%  { transform: rotateY(540deg)  translateY(-80px); }
            30%  { transform: rotateY(1080deg) translateY(-120px); }
            50%  { transform: rotateY(1620deg) translateY(-90px); }
            70%  { transform: rotateY(2160deg) translateY(-30px); }
            85%  { transform: rotateY(2520deg) translateY(5px); }
            92%  { transform: rotateY(2700deg) translateY(-3px); }
            100% { transform: rotateY(2880deg) translateY(0); }
        }

        @keyframes coinFlipToTails {
            0%   { transform: rotateY(0deg)    translateY(0); }
            15%  { transform: rotateY(540deg)  translateY(-80px); }
            30%  { transform: rotateY(1080deg) translateY(-120px); }
            50%  { transform: rotateY(1620deg) translateY(-90px); }
            70%  { transform: rotateY(2160deg) translateY(-30px); }
            85%  { transform: rotateY(2520deg) translateY(5px); }
            92%  { transform: rotateY(2700deg) translateY(-3px); }
            100% { transform: rotateY(2880deg) translateY(0); }
        }

        .coin-face {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            backface-visibility: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .coin-heads {
            background:
                radial-gradient(circle at 35% 35%, rgba(232, 200, 90, 0.4), transparent 60%),
                linear-gradient(145deg, var(--gold-bright) 0%, var(--gold) 40%, var(--gold-dim) 100%);
            border: 3px solid var(--gold-bright);
            box-shadow:
                0 0 30px rgba(201, 168, 76, 0.2),
                inset 0 -4px 8px rgba(0, 0, 0, 0.2),
                inset 0 2px 4px rgba(232, 200, 90, 0.3);
        }

        .coin-tails {
            background:
                radial-gradient(circle at 35% 35%, rgba(232, 200, 90, 0.3), transparent 60%),
                linear-gradient(145deg, var(--gold) 0%, var(--gold-dim) 40%, #6b5420 100%);
            border: 3px solid var(--gold);
            transform: rotateY(180deg);
            box-shadow:
                0 0 30px rgba(201, 168, 76, 0.15),
                inset 0 -4px 8px rgba(0, 0, 0, 0.25),
                inset 0 2px 4px rgba(201, 168, 76, 0.2);
        }

        .coin-letter {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1;
        }

        .coin-heads .coin-letter { color: var(--black); }
        .coin-tails .coin-letter { color: #2a1f10; }

        .coin-word {
            font-size: 0.65rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .coin-heads .coin-word { color: rgba(7, 6, 10, 0.5); }
        .coin-tails .coin-word { color: rgba(42, 31, 16, 0.5); }

        .coin-rim {
            position: absolute;
            inset: 6px;
            border-radius: 50%;
            border: 1px solid rgba(0, 0, 0, 0.1);
            pointer-events: none;
        }

        .coin-inner-ring {
            position: absolute;
            inset: 14px;
            border-radius: 50%;
            border: 1px dashed rgba(0, 0, 0, 0.08);
            pointer-events: none;
        }

        /* --- Result label --- */

        .flip-result-label {
            text-align: center;
            margin-bottom: 48px;
            min-height: 40px;
        }

        .flip-result-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold);
            opacity: 0;
            transform: translateY(6px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .flip-result-text.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- Bet Controls --- */

        .bet-section {
            width: 100%;
            max-width: 480px;
            margin-bottom: 32px;
        }

        .bet-label {
            font-size: 0.75rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold-dim);
            text-align: center;
            margin-bottom: 16px;
        }

        .choice-group {
            display: flex;
            gap: 2px;
            margin-bottom: 24px;
        }

        .choice-btn {
            flex: 1;
            padding: 24px 16px;
            text-align: center;
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.08);
            color: var(--smoke);
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s;
        }

        .choice-btn:first-child { border-radius: 4px 0 0 4px; }
        .choice-btn:last-child { border-radius: 0 4px 4px 0; }

        .choice-btn:hover {
            background: rgba(201, 168, 76, 0.06);
            border-color: rgba(201, 168, 76, 0.2);
            color: var(--cream);
        }

        .choice-btn.selected {
            background: rgba(201, 168, 76, 0.1);
            border-color: var(--gold);
            color: var(--gold);
            box-shadow: 0 0 20px rgba(201, 168, 76, 0.08);
        }

        .choice-btn .choice-sub {
            display: block;
            font-size: 0.6rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-top: 6px;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
            opacity: 0.5;
        }

        .wager-row {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            margin-bottom: 28px;
        }

        .wager-label {
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--smoke);
        }

        .wager-input {
            width: 120px;
            padding: 10px 14px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(201, 168, 76, 0.18);
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            text-align: center;
            outline: none;
            transition: all 0.3s;
        }

        .wager-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 1px rgba(201, 168, 76, 0.15);
        }

        .wager-preset {
            padding: 8px 14px;
            background: transparent;
            border: 1px solid rgba(201, 168, 76, 0.12);
            color: var(--gold-dim);
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .wager-preset:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .flip-btn {
            display: block;
            width: 100%;
            max-width: 480px;
            padding: 20px;
            background: linear-gradient(135deg, var(--gold-dim), var(--gold));
            color: var(--black);
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .flip-btn:hover {
            background: linear-gradient(135deg, var(--gold), var(--gold-bright));
            box-shadow: 0 4px 30px rgba(201, 168, 76, 0.2);
        }

        .flip-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* --- Result Banner --- */

        .result-banner {
            width: 100%;
            max-width: 480px;
            text-align: center;
            padding: 20px;
            margin-top: 24px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }

        .result-banner.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .result-banner.win {
            background: rgba(74, 158, 110, 0.08);
            border: 1px solid rgba(74, 158, 110, 0.2);
        }

        .result-banner.lose {
            background: rgba(201, 64, 64, 0.08);
            border: 1px solid rgba(201, 64, 64, 0.2);
        }

        .result-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .result-banner.win .result-text { color: var(--green); }
        .result-banner.lose .result-text { color: var(--red); }

        .result-detail {
            font-size: 0.9rem;
            color: var(--smoke);
            margin-top: 4px;
            font-weight: 300;
        }

        /* --- History --- */

        .history-section {
            width: 100%;
            max-width: 480px;
            margin-top: 48px;
        }

        .history-title {
            font-size: 0.7rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 16px;
            text-align: center;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.04);
            font-size: 0.85rem;
            animation: slideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .history-item .h-outcome {
            color: var(--cream);
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        .history-item .h-bet { color: var(--smoke); }
        .history-item .h-result { font-weight: 600; }
        .history-item .h-result.win { color: var(--green); }
        .history-item .h-result.lose { color: var(--red); }

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

        @media (max-width: 600px) {
            nav { padding: 20px 16px; }
            .game-container { padding: 40px 16px 60px; }
            .coin-wrapper, .coin { width: 120px; height: 120px; }
            .coin-letter { font-size: 2.5rem; }
            .game-header h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <div class="floating-accent a1"></div>
    <div class="floating-accent a2"></div>

    <nav>
        <a href="{{ route('home') }}" class="nav-brand"><span>ART</span>888</a>
        <div class="nav-right">
            <div class="credit-chip">
                <div>
                    <div class="credit-label">Credits</div>
                    <div class="credit-val" id="credits">1,000</div>
                </div>
            </div>
            <a href="{{ route('home') }}" class="nav-link">Lobby</a>
        </div>
    </nav>

    <div class="gold-line"></div>

    <div class="game-container">
        <div class="game-header">
            <div class="game-overline">Game II</div>
            <h1>Coin of Fate</h1>
            <p>A single coin, two faces. Call it in the air and claim your fortune.</p>
        </div>

        <div class="coin-stage">
            <div class="coin-wrapper">
                <div class="coin show-heads" id="coin">
                    <div class="coin-face coin-heads">
                        <div class="coin-rim"></div>
                        <div class="coin-inner-ring"></div>
                        <div class="coin-letter">H</div>
                        <div class="coin-word">Heads</div>
                    </div>
                    <div class="coin-face coin-tails">
                        <div class="coin-rim"></div>
                        <div class="coin-inner-ring"></div>
                        <div class="coin-letter">T</div>
                        <div class="coin-word">Tails</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flip-result-label">
            <div class="flip-result-text" id="flipResultText">—</div>
        </div>

        <div class="bet-section">
            <div class="bet-label">Call It</div>
            <div class="choice-group">
                <button class="choice-btn" data-choice="heads" onclick="selectChoice(this)">
                    H
                    <span class="choice-sub">Heads</span>
                </button>
                <button class="choice-btn" data-choice="tails" onclick="selectChoice(this)">
                    T
                    <span class="choice-sub">Tails</span>
                </button>
            </div>

            <div class="wager-row">
                <span class="wager-label">Wager</span>
                <button class="wager-preset" onclick="setWager(10)">10</button>
                <button class="wager-preset" onclick="setWager(50)">50</button>
                <input type="number" class="wager-input" id="wagerInput" value="50" min="1" max="1000">
                <button class="wager-preset" onclick="setWager(100)">100</button>
                <button class="wager-preset" onclick="setWager(500)">500</button>
            </div>

            <button class="flip-btn" id="flipBtn" onclick="flipCoin()" disabled>Flip the Coin</button>
        </div>

        <div class="result-banner" id="resultBanner">
            <div class="result-text" id="resultText"></div>
            <div class="result-detail" id="resultDetail"></div>
        </div>

        <div class="history-section" id="historySection" style="display:none;">
            <div class="history-title">Flip History</div>
            <div class="history-list" id="historyList"></div>
        </div>
    </div>

    <script>
        let credits = 1000;
        let selectedChoice = null;
        let isFlipping = false;

        function updateCredits() {
            document.getElementById('credits').textContent = credits.toLocaleString();
        }

        function selectChoice(btn) {
            document.querySelectorAll('.choice-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            selectedChoice = btn.dataset.choice;
            document.getElementById('flipBtn').disabled = false;
        }

        function setWager(val) {
            document.getElementById('wagerInput').value = val;
        }

        function flipCoin() {
            if (isFlipping || !selectedChoice) return;

            const wager = parseInt(document.getElementById('wagerInput').value) || 50;
            if (wager < 1 || wager > credits) return;

            isFlipping = true;
            const flipBtn = document.getElementById('flipBtn');
            flipBtn.disabled = true;

            const resultBanner = document.getElementById('resultBanner');
            resultBanner.classList.remove('visible', 'win', 'lose');

            const flipLabel = document.getElementById('flipResultText');
            flipLabel.classList.remove('visible');

            const coinEl = document.getElementById('coin');
            const outcome = Math.random() < 0.5 ? 'heads' : 'tails';

            coinEl.classList.remove('show-heads', 'show-tails', 'flipping');
            coinEl.style.transform = 'rotateY(0deg)';

            void coinEl.offsetWidth;

            const totalRotation = 2880 + (outcome === 'tails' ? 180 : 0);
            coinEl.style.setProperty('--final-rotation', totalRotation + 'deg');

            coinEl.style.animation = 'none';
            void coinEl.offsetWidth;

            coinEl.style.transition = 'none';
            coinEl.style.transform = 'rotateY(0deg) translateY(0)';

            void coinEl.offsetWidth;

            coinEl.style.transition = 'transform 1.8s cubic-bezier(0.2, 0, 0.1, 1)';
            coinEl.style.transform = `rotateY(${totalRotation}deg) translateY(0)`;

            let bouncePhase = 0;
            const startTime = performance.now();

            function animateBounce(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / 1800, 1);

                let yOffset = 0;
                if (progress < 0.35) {
                    yOffset = -130 * Math.sin(progress / 0.35 * Math.PI);
                } else if (progress < 0.65) {
                    const subP = (progress - 0.35) / 0.3;
                    yOffset = -40 * Math.sin(subP * Math.PI);
                } else if (progress < 0.85) {
                    const subP = (progress - 0.65) / 0.2;
                    yOffset = -12 * Math.sin(subP * Math.PI);
                }

                const currentRotation = totalRotation * progress;
                coinEl.style.transition = 'none';
                coinEl.style.transform = `rotateY(${currentRotation}deg) translateY(${yOffset}px)`;

                if (progress < 1) {
                    requestAnimationFrame(animateBounce);
                } else {
                    coinEl.style.transform = `rotateY(${totalRotation}deg) translateY(0)`;
                    onFlipComplete(outcome, wager);
                }
            }

            requestAnimationFrame(animateBounce);
        }

        function onFlipComplete(outcome, wager) {
            const flipLabel = document.getElementById('flipResultText');
            flipLabel.textContent = outcome === 'heads' ? 'Heads' : 'Tails';
            setTimeout(() => flipLabel.classList.add('visible'), 100);

            const won = outcome === selectedChoice;
            const payout = wager * 2;

            if (won) {
                credits += payout - wager;
            } else {
                credits -= wager;
            }
            updateCredits();

            const resultBanner = document.getElementById('resultBanner');
            const resultText = document.getElementById('resultText');
            const resultDetail = document.getElementById('resultDetail');

            if (won) {
                resultBanner.classList.add('win');
                resultText.textContent = `You Win +${payout.toLocaleString()}`;
                resultDetail.textContent = `Coin landed ${outcome} — you called it`;
            } else {
                resultBanner.classList.add('lose');
                resultText.textContent = `You Lose -${wager.toLocaleString()}`;
                resultDetail.textContent = `Coin landed ${outcome} — you called ${selectedChoice}`;
            }
            setTimeout(() => resultBanner.classList.add('visible'), 250);

            addHistory(outcome, selectedChoice, won, won ? payout : -wager);

            setTimeout(() => {
                isFlipping = false;
                document.getElementById('flipBtn').disabled = false;
            }, 400);
        }

        function addHistory(outcome, bet, won, amount) {
            const section = document.getElementById('historySection');
            const list = document.getElementById('historyList');
            section.style.display = 'block';

            const item = document.createElement('div');
            item.className = 'history-item';
            item.innerHTML = `
                <span class="h-outcome">${outcome.charAt(0).toUpperCase() + outcome.slice(1)}</span>
                <span class="h-bet">Called: ${bet.charAt(0).toUpperCase() + bet.slice(1)}</span>
                <span class="h-result ${won ? 'win' : 'lose'}">${won ? '+' : ''}${amount.toLocaleString()}</span>
            `;
            list.insertBefore(item, list.firstChild);

            if (list.children.length > 10) {
                list.removeChild(list.lastChild);
            }
        }
    </script>
</body>
</html>
