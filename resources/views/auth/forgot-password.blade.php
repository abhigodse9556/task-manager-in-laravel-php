<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/css/auth.css'])
</head>

<body>

    <div class="container main-container auth-container">

        <h1 class="auth-title">Forgot Password</h1>

        @if (session('status'))
        <div class="text-green-600 text-center mb-4 font-bold">
            {{ session('status') }}
        </div>
        @endif

        <div class="auth-form-container gap-4">

            <form method="POST" action="{{ route('password.email') }}" class="auth-form gap-4">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required>
                </div>

                <x-button class="button btn-primary" type="submit">
                    Send Password Reset Link
                </x-button>
            </form>

            <a class="underline hover:text-gray-900" href="{{ route('login') }}">
                Back to Login
            </a>

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