<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dice — ART888</title>
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

        /* --- Dice Area --- */

        .dice-stage {
            display: flex;
            gap: 40px;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            min-height: 160px;
            perspective: 600px;
        }

        .die-wrapper {
            width: 120px;
            height: 120px;
            perspective: 400px;
        }

        .die {
            width: 120px;
            height: 120px;
            background: var(--card-light);
            border: 2px solid rgba(201, 168, 76, 0.2);
            border-radius: 16px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            padding: 18px;
            position: relative;
            transition: border-color 0.3s;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(201, 168, 76, 0.06);
        }

        .die.rolling {
            animation: diceShake 0.12s infinite alternate;
            border-color: var(--gold);
            box-shadow: 0 6px 30px rgba(201, 168, 76, 0.15), inset 0 1px 0 rgba(201, 168, 76, 0.06);
        }

        .die.landed {
            animation: diceLand 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            border-color: var(--gold);
        }

        @keyframes diceShake {
            0%   { transform: rotate(-4deg) scale(0.97) translateY(-2px); }
            100% { transform: rotate(4deg) scale(1.03) translateY(2px); }
        }

        @keyframes diceLand {
            0%   { transform: scale(1.12) rotate(3deg); }
            50%  { transform: scale(0.96) rotate(-1deg); }
            100% { transform: scale(1) rotate(0deg); }
        }

        .pip {
            width: 16px;
            height: 16px;
            background: var(--gold);
            border-radius: 50%;
            align-self: center;
            justify-self: center;
            opacity: 0;
            transform: scale(0);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 0 6px rgba(201, 168, 76, 0.3);
        }

        .pip.show {
            opacity: 1;
            transform: scale(1);
        }

        .pip:nth-child(1) { grid-area: 1/1; }
        .pip:nth-child(2) { grid-area: 1/3; }
        .pip:nth-child(3) { grid-area: 2/1; }
        .pip:nth-child(4) { grid-area: 2/2; }
        .pip:nth-child(5) { grid-area: 2/3; }
        .pip:nth-child(6) { grid-area: 3/1; }
        .pip:nth-child(7) { grid-area: 3/3; }

        .plus-sign {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--gold-dim);
            align-self: center;
        }

        /* --- Sum Display --- */

        .sum-display {
            text-align: center;
            margin-bottom: 48px;
            min-height: 64px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .sum-label {
            font-size: 0.7rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--smoke);
            margin-bottom: 4px;
        }

        .sum-value {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            color: var(--gold);
            line-height: 1;
            opacity: 0;
            transform: translateY(8px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .sum-value.visible {
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
            padding: 18px 16px;
            text-align: center;
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.08);
            color: var(--smoke);
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            position: relative;
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

        .choice-btn .choice-label {
            display: block;
            font-size: 0.6rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-top: 4px;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
            opacity: 0.6;
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

        .roll-btn {
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

        .roll-btn:hover {
            background: linear-gradient(135deg, var(--gold), var(--gold-bright));
            box-shadow: 0 4px 30px rgba(201, 168, 76, 0.2);
        }

        .roll-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* --- Result --- */

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

        .history-item .h-dice {
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
            .dice-stage { gap: 20px; }
            .die-wrapper { width: 90px; height: 90px; }
            .die { width: 90px; height: 90px; padding: 12px; border-radius: 12px; }
            .pip { width: 12px; height: 12px; }
            .game-header h1 { font-size: 2rem; }
            .choice-group { flex-direction: column; }
            .choice-btn:first-child { border-radius: 4px 4px 0 0; }
            .choice-btn:last-child { border-radius: 0 0 4px 4px; }
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
            <div class="game-overline">Game I</div>
            <h1>Guess the Dice</h1>
            <p>Two dice are cast. Predict whether their sum falls below, on, or above seven.</p>
        </div>

        <div class="dice-stage">
            <div class="die-wrapper">
                <div class="die" id="die1">
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                </div>
            </div>
            <div class="plus-sign">+</div>
            <div class="die-wrapper">
                <div class="die" id="die2">
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                    <div class="pip"></div>
                </div>
            </div>
        </div>

        <div class="sum-display">
            <div class="sum-label">Total</div>
            <div class="sum-value" id="sumValue">—</div>
        </div>

        <div class="bet-section">
            <div class="bet-label">Your Prediction</div>
            <div class="choice-group">
                <button class="choice-btn" data-choice="under" onclick="selectChoice(this)">
                    &lt; 7
                    <span class="choice-label">Under</span>
                </button>
                <button class="choice-btn" data-choice="exact" onclick="selectChoice(this)">
                    = 7
                    <span class="choice-label">Lucky Seven</span>
                </button>
                <button class="choice-btn" data-choice="over" onclick="selectChoice(this)">
                    &gt; 7
                    <span class="choice-label">Over</span>
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

            <button class="roll-btn" id="rollBtn" onclick="rollDice()" disabled>Roll the Dice</button>
        </div>

        <div class="result-banner" id="resultBanner">
            <div class="result-text" id="resultText"></div>
            <div class="result-detail" id="resultDetail"></div>
        </div>

        <div class="history-section" id="historySection" style="display:none;">
            <div class="history-title">Roll History</div>
            <div class="history-list" id="historyList"></div>
        </div>
    </div>

    <script>
        const pipMap = {
            1: [4],
            2: [2, 6],
            3: [2, 4, 6],
            4: [1, 2, 6, 7],
            5: [1, 2, 4, 6, 7],
            6: [1, 2, 3, 5, 6, 7],
        };

        let credits = 1000;
        let selectedChoice = null;
        let isRolling = false;

        function updateCredits() {
            document.getElementById('credits').textContent = credits.toLocaleString();
        }

        function selectChoice(btn) {
            document.querySelectorAll('.choice-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            selectedChoice = btn.dataset.choice;
            document.getElementById('rollBtn').disabled = false;
        }

        function setWager(val) {
            document.getElementById('wagerInput').value = val;
        }

        function showDie(dieEl, value) {
            const pips = dieEl.querySelectorAll('.pip');
            pips.forEach(p => p.classList.remove('show'));
            const activePips = pipMap[value];
            activePips.forEach((idx, i) => {
                setTimeout(() => {
                    pips[idx - 1].classList.add('show');
                }, i * 40);
            });
        }

        function clearDice() {
            document.querySelectorAll('.pip').forEach(p => p.classList.remove('show'));
        }

        function rollDice() {
            if (isRolling || !selectedChoice) return;

            const wager = parseInt(document.getElementById('wagerInput').value) || 50;
            if (wager < 1 || wager > credits) return;

            isRolling = true;
            const rollBtn = document.getElementById('rollBtn');
            rollBtn.disabled = true;

            const resultBanner = document.getElementById('resultBanner');
            resultBanner.classList.remove('visible', 'win', 'lose');

            const sumEl = document.getElementById('sumValue');
            sumEl.classList.remove('visible');

            const die1El = document.getElementById('die1');
            const die2El = document.getElementById('die2');

            clearDice();
            die1El.classList.add('rolling');
            die2El.classList.add('rolling');

            let flickerCount = 0;
            const flickerInterval = setInterval(() => {
                clearDice();
                showDie(die1El, Math.ceil(Math.random() * 6));
                showDie(die2El, Math.ceil(Math.random() * 6));
                flickerCount++;
                if (flickerCount > 12) {
                    clearInterval(flickerInterval);
                }
            }, 80);

            const finalVal1 = Math.ceil(Math.random() * 6);
            const finalVal2 = Math.ceil(Math.random() * 6);
            const total = finalVal1 + finalVal2;

            setTimeout(() => {
                clearDice();
                die1El.classList.remove('rolling');
                die2El.classList.remove('rolling');
                die1El.classList.add('landed');
                die2El.classList.add('landed');

                showDie(die1El, finalVal1);
                showDie(die2El, finalVal2);

                sumEl.textContent = total;
                setTimeout(() => sumEl.classList.add('visible'), 100);

                let outcome;
                if (total < 7) outcome = 'under';
                else if (total === 7) outcome = 'exact';
                else outcome = 'over';

                const won = outcome === selectedChoice;
                const multiplier = selectedChoice === 'exact' ? 5 : 2;
                const payout = won ? wager * multiplier : 0;

                if (won) {
                    credits += payout - wager;
                } else {
                    credits -= wager;
                }
                updateCredits();

                const resultText = document.getElementById('resultText');
                const resultDetail = document.getElementById('resultDetail');

                if (won) {
                    resultBanner.classList.add('win');
                    resultText.textContent = `You Win +${payout.toLocaleString()}`;
                    resultDetail.textContent = `Dice rolled ${finalVal1} + ${finalVal2} = ${total} — ${outcome === 'exact' ? 'Lucky Seven!' : outcome}`;
                } else {
                    resultBanner.classList.add('lose');
                    resultText.textContent = `You Lose -${wager.toLocaleString()}`;
                    resultDetail.textContent = `Dice rolled ${finalVal1} + ${finalVal2} = ${total} — ${outcome}`;
                }
                setTimeout(() => resultBanner.classList.add('visible'), 200);

                addHistory(finalVal1, finalVal2, total, selectedChoice, won, won ? payout : -wager);

                setTimeout(() => {
                    die1El.classList.remove('landed');
                    die2El.classList.remove('landed');
                    isRolling = false;
                    rollBtn.disabled = false;
                }, 500);

            }, 1200);
        }

        function addHistory(d1, d2, total, bet, won, amount) {
            const section = document.getElementById('historySection');
            const list = document.getElementById('historyList');
            section.style.display = 'block';

            const betLabels = { under: '< 7', exact: '= 7', over: '> 7' };
            const item = document.createElement('div');
            item.className = 'history-item';
            item.innerHTML = `
                <span class="h-dice">${d1} + ${d2} = ${total}</span>
                <span class="h-bet">Bet: ${betLabels[bet]}</span>
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
