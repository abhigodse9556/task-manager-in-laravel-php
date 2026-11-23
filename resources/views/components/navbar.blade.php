<nav class="navbar">

    <div class="navbar-brand">
        <a href="{{ route('home') }}">Task Manager</a>
    </div>

    <div class="navbar-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('tasks.index') }}">Tasks</a>
        @if (auth()->check())
        @auth
        <x-button
            type="button"
            id="profile-toggle"
            class="profile-toggle button btn-primary">
            {{ Auth::user()->name }}
        </x-button>
        @endauth
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-button type="submit">
                Logout
            </x-button>
        </form>
        @else
        <x-button class="button" onclick="window.location.href='/login'">Sign In</x-button>
        @endif
    </div>

</nav>