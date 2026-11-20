<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/css/login.css'])
</head>

<body>
    <div class="container main-container login-container">
        <h1 class="login-title">Login</h1>

        <div class="login-form-container">

            <form method="POST" action="{{ route('login') }}" class="login-form">

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

                <x-button class="button btn-primary" type="submit">
                    Login
                </x-button>

            </form>

            <p class="login-register-link">
                Don't have an account?
                <a class="button" href="{{ route('register') }}">Register</a>
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