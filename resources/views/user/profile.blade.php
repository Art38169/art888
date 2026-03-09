<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }} — ART888</title>
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
            --gold-dim: #a08840;
            --cream: #f5e6c8;
            --smoke: #9e95a8;
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

        .back-link {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: var(--smoke);
            transition: color 0.3s;
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
            flex-shrink: 0;
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

        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-brand span { color: var(--gold); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .nav-right a {
            text-decoration: none;
            color: var(--smoke);
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .nav-right a:hover { color: var(--cream); }

        .page-container {
            position: relative;
            z-index: 10;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 48px 80px;
        }

        /* --- Identity Card --- */
        .identity-card {
            display: flex;
            align-items: center;
            gap: 40px;
            padding: 48px;
            background: linear-gradient(135deg, var(--card) 0%, rgba(20, 18, 26, 0.7) 100%);
            border: 1px solid rgba(201, 168, 76, 0.12);
            border-radius: 4px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            animation: cardReveal 0.7s ease-out;
        }

        @keyframes cardReveal {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .identity-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-dim), transparent);
        }

        .avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            border: 2px solid var(--gold-dim);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gold);
            background: rgba(201, 168, 76, 0.06);
            flex-shrink: 0;
            letter-spacing: 0.05em;
        }

        .identity-info {
            flex: 1;
        }

        .identity-name {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--cream);
            letter-spacing: 0.04em;
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .identity-email {
            color: var(--smoke);
            font-size: 1.05rem;
            font-weight: 400;
            letter-spacing: 0.02em;
            margin-bottom: 4px;
        }

        .identity-joined {
            color: var(--gold-dim);
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .identity-balance {
            text-align: right;
            flex-shrink: 0;
        }

        .balance-label {
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--smoke);
            margin-bottom: 6px;
            font-weight: 500;
        }

        .balance-amount {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
        }

        .balance-currency {
            font-size: 0.7rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-top: 4px;
            font-weight: 500;
        }

        /* --- Stats Row --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 48px;
            animation: cardReveal 0.7s ease-out 0.15s both;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.08);
            border-radius: 4px;
            padding: 24px 20px;
            text-align: center;
            transition: border-color 0.3s;
        }

        .stat-card:hover {
            border-color: rgba(201, 168, 76, 0.2);
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--cream);
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 0.65rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--smoke);
            font-weight: 500;
        }

        /* --- Transactions Table --- */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 20px;
            animation: cardReveal 0.7s ease-out 0.3s both;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 0.06em;
        }

        .section-subtitle {
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--smoke);
        }

        .txn-table-wrap {
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.08);
            border-radius: 4px;
            overflow: hidden;
            animation: cardReveal 0.7s ease-out 0.35s both;
        }

        .txn-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .txn-table thead th {
            font-size: 0.6rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--smoke);
            font-weight: 500;
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(201, 168, 76, 0.08);
            background: rgba(0, 0, 0, 0.2);
        }

        .txn-table thead th:last-child,
        .txn-table tbody td:last-child {
            text-align: right;
        }

        .txn-table tbody tr {
            transition: background 0.2s;
        }

        .txn-table tbody tr:hover {
            background: rgba(201, 168, 76, 0.03);
        }

        .txn-table tbody td {
            padding: 14px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            vertical-align: middle;
        }

        .txn-table tbody tr:last-child td {
            border-bottom: none;
        }

        .txn-type {
            display: inline-block;
            font-size: 0.6rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 3px;
        }

        .txn-type.wager {
            background: rgba(201, 64, 64, 0.12);
            color: var(--red);
        }

        .txn-type.payout {
            background: rgba(74, 158, 110, 0.12);
            color: var(--green);
        }

        .txn-game {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .txn-game-icon {
            width: 22px;
            height: 22px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            flex-shrink: 0;
            background: rgba(201, 168, 76, 0.08);
            color: var(--gold-dim);
        }

        .txn-game-label {
            color: var(--smoke);
            font-size: 0.85rem;
        }

        .txn-amount {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1rem;
        }

        .txn-amount.negative { color: var(--red); }
        .txn-amount.positive { color: var(--green); }

        .txn-balance {
            color: var(--smoke);
            font-size: 0.85rem;
        }

        .txn-time {
            color: var(--smoke);
            font-size: 0.8rem;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--smoke);
            font-size: 1.1rem;
            font-style: italic;
        }

        /* --- Pagination --- */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 24px 20px;
            border-top: 1px solid rgba(201, 168, 76, 0.06);
        }

        .pagination-wrap a,
        .pagination-wrap span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            font-size: 0.8rem;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
        }

        .pagination-wrap a {
            color: var(--smoke);
            border: 1px solid rgba(201, 168, 76, 0.1);
        }

        .pagination-wrap a:hover {
            color: var(--gold);
            border-color: var(--gold-dim);
            background: rgba(201, 168, 76, 0.05);
        }

        .pagination-wrap span.current {
            color: var(--black);
            background: var(--gold);
            border: 1px solid var(--gold);
        }

        .pagination-wrap span.disabled {
            color: rgba(158, 149, 168, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .settings-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--smoke);
            text-decoration: none;
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: color 0.3s;
            font-weight: 500;
        }

        .settings-link:hover { color: var(--gold); }

        .settings-link svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.5;
        }

        @media (max-width: 700px) {
            nav { padding: 20px 20px; }
            .page-container { padding: 16px 20px 60px; }
            .identity-card {
                flex-direction: column;
                text-align: center;
                gap: 24px;
                padding: 32px 24px;
            }
            .identity-balance { text-align: center; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .txn-table { font-size: 0.85rem; }
            .txn-table thead th,
            .txn-table tbody td { padding: 10px 12px; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" class="back-link">
            <div class="back-arrow"><svg viewBox="0 0 24 24"><path d="M19 12H5M5 12l6-6M5 12l6 6"/></svg></div>
            <span class="back-label">Lobby</span>
        </a>
        <div class="nav-brand"><span>ART</span>888</div>
        <div class="nav-right">
            <a href="{{ route('profile.edit') }}" class="settings-link">
                <svg viewBox="0 0 24 24"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                Settings
            </a>
        </div>
    </nav>

    <div class="page-container">

        <div class="identity-card">
            <div class="avatar">{{ $user->initials() }}</div>
            <div class="identity-info">
                <div class="identity-name">{{ $user->name }}</div>
                <div class="identity-email">{{ $user->email }}</div>
                <div class="identity-joined">Member since {{ $user->created_at->format('M Y') }}</div>
            </div>
            <div class="identity-balance">
                <div class="balance-label">Balance</div>
                <div class="balance-amount">{{ number_format($user->credits) }}</div>
                <div class="balance-currency">Credits</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">{{ $stats['dice_played'] + $stats['coin_played'] }}</div>
                <div class="stat-label">Games Played</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['dice_won'] + $stats['coin_won'] }}</div>
                <div class="stat-label">Games Won</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_wagered']) }}</div>
                <div class="stat-label">Total Wagered</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($stats['total_won']) }}</div>
                <div class="stat-label">Total Won</div>
            </div>
        </div>

        <div class="section-header">
            <div class="section-title">Transaction History</div>
            <div class="section-subtitle">{{ $transactions->total() }} Records</div>
        </div>

        <div class="txn-table-wrap">
            @if($transactions->isEmpty())
                <div class="empty-state">No transactions yet. Go play a game.</div>
            @else
                <table class="txn-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Game</th>
                            <th>Time</th>
                            <th>Balance</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $txn)
                            <tr>
                                <td>
                                    <span class="txn-type {{ $txn->type }}">{{ $txn->type }}</span>
                                </td>
                                <td>
                                    <div class="txn-game">
                                        <div class="txn-game-icon">
                                            @if($txn->game_type === \App\Models\DiceGame::class)
                                                &#9858;
                                            @else
                                                &#9679;
                                            @endif
                                        </div>
                                        <span class="txn-game-label">
                                            {{ $txn->game_type === \App\Models\DiceGame::class ? 'Dice' : 'Coin' }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="txn-time">{{ $txn->created_at->diffForHumans() }}</span>
                                </td>
                                <td>
                                    <span class="txn-balance">{{ number_format($txn->balance_after) }}</span>
                                </td>
                                <td>
                                    <span class="txn-amount {{ $txn->amount < 0 ? 'negative' : 'positive' }}">
                                        {{ $txn->amount < 0 ? '' : '+' }}{{ number_format($txn->amount) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($transactions->hasPages())
                    <div class="pagination-wrap">
                        @if($transactions->onFirstPage())
                            <span class="disabled">&laquo;</span>
                        @else
                            <a href="{{ $transactions->previousPageUrl() }}">&laquo;</a>
                        @endif

                        @foreach($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                            @if($page == $transactions->currentPage())
                                <span class="current">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($transactions->hasMorePages())
                            <a href="{{ $transactions->nextPageUrl() }}">&raquo;</a>
                        @else
                            <span class="disabled">&raquo;</span>
                        @endif
                    </div>
                @endif
            @endif
        </div>

    </div>
</body>
</html>
