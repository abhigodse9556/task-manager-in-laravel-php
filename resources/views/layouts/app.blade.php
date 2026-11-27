<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Task Manager' }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @yield('page-css')

    <style>
    </style>
</head>

<body data-authenticated="{{ auth()->check() ? 'true' : 'false' }}">

    <!-- <nav>
        <div>Task Manager</div>
        <x-button class="button">Sign In</x-button>
    </nav> -->

    <x-navbar />

    <main class="container main-container">
        @yield('content')
    </main>

    <x-footer />

    @auth
    <x-profile />
    @endauth

</body>

</html>