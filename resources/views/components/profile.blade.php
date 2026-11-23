<div id="profile-overlay" class="profile-overlay"></div>

<aside id="profile-sidebar" class="profile-sidebar">

    <div class="profile-sidebar-header">
        <h2>Profile</h2>

        <x-button
            type="button"
            id="profile-close"
            class="profile-close"
            aria-label="Close profile">
            &times;
        </x-button>
    </div>

    <div class="profile-sidebar-content">

        <div class="profile-user">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div>
                <h3>{{ Auth::user()->name }}</h3>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="profile-section">
            <x-button type="button" class="profile-action">
                Edit Name
            </x-button>

            <x-button type="button" class="profile-action">
                Reset Password
            </x-button>
        </div>

    </div>


    <form method="POST" action="{{ route('logout') }}" class="pl-4">
        @csrf

        <x-button class="button btn-danger" type="submit">
            Logout
        </x-button>
    </form>

</aside>