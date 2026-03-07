<x-layouts::auth :title="__('Log in')">
    <h2 class="auth-title">Welcome Back</h2>
    <p class="auth-subtitle">Enter your credentials to return to the table</p>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input class="form-input" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="your@email.com">
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-input" id="password" name="password" type="password" required autocomplete="current-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
        </div>

        <div class="form-row">
            <label class="form-checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span>Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="form-link">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn-submit">Log In</button>
    </form>

    @if (Route::has('register'))
        <div class="auth-footer">
            <span>Don't have an account?</span>
            <a href="{{ route('register') }}">Register</a>
        </div>
    @endif
</x-layouts::auth>
