<nav class="navbar">

    <div class="navbar-brand">
        <a href="{{ route('home') }}">Task Manager</a>
    </div>

    <div class="navbar-toggle" id="navbar-toggle">
        <span id="bar1" class="bar"></span>
        <span id="bar2" class="bar"></span>
        <span id="bar3" class="bar"></span>
    </div>

    <div id="mobile-menu" class="mobile-menu-overlay">
        <div class="mobile-menu">
            <x-navbar.navlinks />
        </div>
    </div>
</nav>