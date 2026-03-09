<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings — ART888</title>
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

        .page-container {
            position: relative;
            z-index: 10;
            max-width: 640px;
            margin: 0 auto;
            padding: 20px 48px 80px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            margin-bottom: 8px;
            animation: reveal 0.6s ease-out;
        }

        .page-subtitle {
            color: var(--smoke);
            font-size: 1.05rem;
            margin-bottom: 48px;
            animation: reveal 0.6s ease-out 0.1s both;
        }

        @keyframes reveal {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .settings-section {
            background: var(--card);
            border: 1px solid rgba(201, 168, 76, 0.1);
            border-radius: 4px;
            padding: 40px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            animation: reveal 0.6s ease-out 0.2s both;
        }

        .settings-section + .settings-section {
            animation-delay: 0.3s;
        }

        .settings-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 168, 76, 0.15), transparent);
        }

        .section-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .section-desc {
            color: var(--smoke);
            font-size: 0.9rem;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group:last-of-type {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--smoke);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(201, 168, 76, 0.12);
            border-radius: 4px;
            padding: 14px 18px;
            color: var(--cream);
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05rem;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus {
            border-color: var(--gold-dim);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.08);
        }

        .form-input::placeholder {
            color: rgba(158, 149, 168, 0.4);
        }

        .form-error {
            color: var(--red);
            font-size: 0.8rem;
            margin-top: 6px;
            font-weight: 500;
        }

        .form-actions {
            margin-top: 28px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-save {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dim) 100%);
            color: var(--black);
            border: none;
            padding: 13px 36px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-save:hover {
            background: linear-gradient(135deg, var(--gold-bright) 0%, var(--gold) 100%);
            box-shadow: 0 4px 20px rgba(201, 168, 76, 0.2);
            transform: translateY(-1px);
        }

        .btn-save:active {
            transform: translateY(0);
        }

        .success-msg {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--green);
            font-size: 0.8rem;
            font-weight: 500;
            animation: fadeSlide 0.4s ease-out;
        }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .success-msg svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .divider {
            height: 1px;
            background: rgba(201, 168, 76, 0.06);
            margin: 28px 0;
        }

        .logout-section {
            animation: reveal 0.6s ease-out 0.4s both;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: none;
            border: 1px solid rgba(201, 64, 64, 0.25);
            color: var(--red);
            padding: 12px 28px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            background: rgba(201, 64, 64, 0.08);
            border-color: rgba(201, 64, 64, 0.45);
        }

        .btn-logout svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.5;
        }

        @media (max-width: 700px) {
            nav { padding: 20px 20px; }
            .page-container { padding: 16px 20px 60px; }
            .settings-section { padding: 28px 22px; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('user.profile') }}" class="back-link">
            <div class="back-arrow"><svg viewBox="0 0 24 24"><path d="M19 12H5M5 12l6-6M5 12l6 6"/></svg></div>
            <span class="back-label">Profile</span>
        </a>
        <div class="nav-brand"><span>ART</span>888</div>
    </nav>

    <div class="page-container">
        <h1 class="page-title">Settings</h1>
        <p class="page-subtitle">Manage your account details</p>

        {{-- Profile Section --}}
        <div class="settings-section">
            <h2 class="section-heading">Profile</h2>
            <p class="section-desc">Update your name and email address.</p>

            <form method="POST" action="{{ route('settings.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-input" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Save Changes</button>
                    @if(session('profile_success'))
                        <span class="success-msg">
                            <svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                            {{ session('profile_success') }}
                        </span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Password Section --}}
        <div class="settings-section">
            <h2 class="section-heading">Password</h2>
            <p class="section-desc">Use a strong, unique password to protect your account.</p>

            <form method="POST" action="{{ route('settings.password.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="current_password">Current Password</label>
                    <input class="form-input" type="password" id="current_password" name="current_password" required placeholder="Enter current password">
                    @error('current_password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <input class="form-input" type="password" id="password" name="password" required placeholder="Enter new password">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm New Password</label>
                    <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm new password">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Update Password</button>
                    @if(session('password_success'))
                        <span class="success-msg">
                            <svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                            {{ session('password_success') }}
                        </span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Logout --}}
        <div class="logout-section">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </div>
</body>
</html>
