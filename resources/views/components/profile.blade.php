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

    <div class="profile-update-success">
        <span id="profile-success-message" class="profile-success-message"></span>
    </div>

    <div id="profile-view" class="profile-sidebar-content">

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
            <x-button type="button" class="profile-action" id="edit-name-button">
                Edit Name
            </x-button>

            <x-button type="button" class="profile-action" id="change-password-button">
                Reset Password
            </x-button>
        </div>

    </div>

    <div id="name-view" class="profile-form-view profile-sidebar-content relative">
        <div class="profile-form-header">
            <button type="button" id="back-to-profile-from-name" class="profile-back-button">
                &larr;
            </button>

            <h3>Edit Name</h3>
        </div>

        <form
            id="update-name-form"
            method="POST"
            action="{{ route('profile.name.update') }}">
            @csrf
            @method('PUT')

            <div class="profile-form-group">
                <label for="name">Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ Auth::user()->name }}"
                    required>

                <span
                    id="name-error"
                    class="profile-field-error"></span>
            </div>

            <div
                id="name-success"
                class="profile-success"></div>

            <button
                type="submit"
                id="update-name-submit"
                class="profile-submit-button">
                Update Name
            </button>
        </form>
    </div>

    <div id="password-view" class="profile-form-view profile-sidebar-content relative">

        <div class="profile-form-header">
            <button
                type="button"
                id="back-to-profile"
                class="profile-back-button">
                &larr;
            </button>

            <h3>Change Password</h3>
        </div>
        <form
            id="change-password-form"
            method="POST"
            action="{{ route('profile.password.update') }}">
            @csrf
            <!-- @method('PUT') -->

            <div class="profile-form-group">
                <label for="current_password">
                    Current Password
                </label>

                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    required>

                <span
                    id="current-password-error"
                    class="profile-field-error"></span>
            </div>

            <div class="profile-form-group">
                <label for="password">
                    New Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required>

                <span
                    id="password-error"
                    class="profile-field-error"></span>
            </div>

            <div class="profile-form-group">
                <label for="password_confirmation">
                    Confirm New Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required>

                <span
                    id="password-confirmation-error"
                    class="profile-field-error"></span>
            </div>

            <button
                id="change-password-submit"
                type="submit"
                class="profile-submit-button">
                Change Password
            </button>
        </form>

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



    <form method="POST" action="{{ route('logout') }}" class="fixed bottom-0 right-0 p-4 border-t border-gray-200 w-full flex justify-end">
        @csrf

        <x-button class="button btn-danger" type="submit">
            Logout
        </x-button>
    </form>

</aside>