<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/css/auth.css'])
</head>

<body>
    <div class="container main-container auth-container">
        <h1 class="auth-title">Login</h1>

        <div class="auth-form-container">

            <form method="POST" action="{{ route('login') }}" class="auth-form">

                @csrf

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}">
                </div>

                <br>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password">
                </div>

                <br>

                <div class="form-group">
                    <x-button class="button btn-primary" type="submit">
                        Login
                    </x-button>
                    <a class="text-red-400 hover:text-red-200 underline" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                </div>

            </form>

            <p class="auth-register-link">
                Don't have an account?
                <a class="underline hover:text-gray-400" href="{{ route('register') }}">Register</a>
            </p>

            @if ($errors->any())
            <div class="error-messages-container">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="error-messages">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
    </div>

</body>

</html>