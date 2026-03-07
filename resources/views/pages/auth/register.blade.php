<x-layouts::auth :title="__('Register')">
    <h2 class="auth-title">Join the Table</h2>
    <p class="auth-subtitle">Create your account and receive 1,000 credits</p>

    @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input class="form-input" id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Your name">
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input class="form-input" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" placeholder="your@email.com">
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-input" id="password" name="password" type="password" required autocomplete="new-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <input class="form-input" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
        </div>

        <button type="submit" class="btn-submit" style="margin-top: 8px;">Create Account</button>
    </form>

    <div class="auth-footer">
        <span>Already have an account?</span>
        <a href="{{ route('login') }}">Log in</a>
    </div>
</x-layouts::auth>
