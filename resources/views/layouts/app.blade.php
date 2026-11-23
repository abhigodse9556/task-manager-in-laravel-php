<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Task Manager' }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @yield('page-css')

    <style>
    </style>
</head>

<body>

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