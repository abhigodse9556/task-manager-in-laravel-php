<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/css/login.css'])
</head>

<body>

    <div class="container main-container login-container">

        <h1 class="login-title">Create an Account</h1>

        <div class="login-form-container">

            <form method="POST" action="{{ route('register') }}" class="login-form">

                @csrf

                <div class="form-group">
                    <label for="name">Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}">
                </div>

                <br>

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
                    <label for="password_confirmation">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation">
                </div>

                <br>

                <x-button class="button btn-primary" type="submit">
                    Register
                </x-button>

            </form>

            <p class="login-register-link">
                Already have an account?
                <a class="button" href="{{ route('login') }}">Login</a>
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