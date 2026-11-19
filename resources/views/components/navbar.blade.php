<nav class="navbar">

    <div class="navbar-brand">
        <a href="{{ route('home') }}">Task Manager</a>
    </div>

    <div class="navbar-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('tasks.index') }}">Tasks</a>
        @if (isset($user))
        <x-button>{{ $user['name']}}</x-button>
        @else
        <x-button class="button">Sign In</x-button>
        @endif
    </div>

</nav>