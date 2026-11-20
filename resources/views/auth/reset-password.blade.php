<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/css/auth.css'])
</head>

<body>

    <div class="container main-container auth-container">

        <h1 class="auth-title">Reset Password</h1>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="auth-form-container gap-4">
            <form method="POST" action="{{ route('password.update') }}" class="auth-form gap-4">
                @csrf

                <input
                    type="hidden"
                    name="token"
                    value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required>
                </div>

                <x-button class="button btn-primary" type="submit">
                    Reset Password
                </x-button>
            </form>
            <a class="underline hover:text-gray-900" href="{{ route('login') }}">
                Back to Login
            </a>
        </div>
    </div>

</body>

</html>