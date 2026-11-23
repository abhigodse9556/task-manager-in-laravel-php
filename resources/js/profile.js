const profileToggle = document.getElementById('profile-toggle');
const profileSidebar = document.getElementById('profile-sidebar');
const profileOverlay = document.getElementById('profile-overlay');
const profileClose = document.getElementById('profile-close');
const profileView = document.getElementById('profile-view');
const passwordView = document.getElementById('password-view');
const changePasswordButton = document.getElementById('change-password-button');
const backToProfileButton = document.getElementById('back-to-profile');

function openProfileSidebar() {
    profileSidebar.classList.add('open');
    profileOverlay.classList.add('open');
    document.body.classList.add('profile-sidebar-open');
}

function closeProfileSidebar() {
    backToProfileView();
    profileSidebar.classList.remove('open');
    profileOverlay.classList.remove('open');
    document.body.classList.remove('profile-sidebar-open');
}

function openPasswordView() {
    profileView.style.display = 'none';
    passwordView.classList.add('active');
}

function backToProfileView() {
    passwordView.classList.remove('active');
    profileView.style.display = 'block';
}

if (profileToggle) {
    profileToggle.addEventListener('click', openProfileSidebar);
}

if (profileClose) {
    profileClose.addEventListener('click', closeProfileSidebar);
}

if (profileOverlay) {
    profileOverlay.addEventListener('click', closeProfileSidebar);
}

if (changePasswordButton) {
    changePasswordButton.addEventListener('click', () => {
        openPasswordView();
    });
}

if (backToProfileButton) {
    backToProfileButton.addEventListener('click', () => {
        backToProfileView();
    });
}

const changePasswordForm = document.getElementById('change-password-form');
const passwordSuccess = document.getElementById('profile-success-message');

const currentPasswordError = document.getElementById('current-password-error');
const passwordError = document.getElementById('password-error');
const passwordConfirmationError = document.getElementById('password-confirmation-error');

if (changePasswordForm) {
    changePasswordForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        clearPasswordErrors();

        const submitButton = document.getElementById('change-password-submit');

        submitButton.disabled = true;
        submitButton.textContent = 'Changing...';

        try {
            const response = await fetch(changePasswordForm.action, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).getAttribute('content'),
                },
                body: new FormData(changePasswordForm),
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422) {
                    showPasswordErrors(data.errors);
                } else {
                    showPasswordErrors({
                        current_password: ['Unable to change password. Please try again.']
                    });
                }

                return;
            }

            passwordSuccess.textContent = data.message;
            passwordSuccess.classList.add('show');

            changePasswordForm.reset();
            backToProfileView();

            setTimeout(() => {
                passwordSuccess.textContent = '';
                passwordSuccess.classList.remove('show');
            }, 5000);

        } catch (error) {
            showPasswordErrors({
                current_password: [
                    'Something went wrong. Please try again.'
                ]
            });
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = 'Change Password';
        }
    });
}

function clearPasswordErrors() {
    if (currentPasswordError) {
        currentPasswordError.textContent = '';
    }

    if (passwordError) {
        passwordError.textContent = '';
    }

    if (passwordConfirmationError) {
        passwordConfirmationError.textContent = '';
    }

    if (passwordSuccess) {
        passwordSuccess.textContent = '';
        passwordSuccess.classList.remove('show');
    }
}

function showPasswordErrors(errors) {
    if (errors.current_password && currentPasswordError) {
        currentPasswordError.textContent = errors.current_password[0];
    }

    if (errors.password && passwordError) {
        passwordError.textContent = errors.password[0];
    }

    if (errors.password_confirmation && passwordConfirmationError) {
        passwordConfirmationError.textContent =
            errors.password_confirmation[0];
    }
}

const nameView = document.getElementById('name-view');
const editNameButton = document.getElementById('edit-name-button');
const backToProfileFromName = document.getElementById('back-to-profile-from-name');

const updateNameForm = document.getElementById('update-name-form');
const nameError = document.getElementById('name-error');
const nameSuccess = document.getElementById('profile-success-message');

function openNameView() {
    profileView.style.display = 'none';
    passwordView.classList.remove('active');
    nameView.classList.add('active');
}

function backToProfileFromNameView() {
    nameView.classList.remove('active');
    profileView.style.display = 'block';
}

if (editNameButton) {
    editNameButton.addEventListener('click', () => {
        openNameView();
    });
}

if (backToProfileFromName) {
    backToProfileFromName.addEventListener('click', () => {
        backToProfileFromNameView();
    });
}

if (updateNameForm) {
    updateNameForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        clearNameMessages();

        const submitButton = document.getElementById('update-name-submit');

        submitButton.disabled = true;
        submitButton.textContent = 'Updating...';

        try {
            const response = await fetch(updateNameForm.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).getAttribute('content'),
                },
                body: new FormData(updateNameForm),
            });

            const data = await response.json();

            if (response.ok && data.success) {
                nameSuccess.textContent = data.message;
                nameSuccess.classList.add('show');

                // Update the name displayed in the profile view
                const profileName = document.querySelector('.profile-user h3');

                if (profileName) {
                    profileName.textContent = data.name;
                }

                // Update navbar username if it exists
                const profileToggle = document.getElementById('profile-toggle');

                if (profileToggle) {
                    profileToggle.textContent = data.name;
                }

                backToProfileFromNameView();

                setTimeout(() => {
                    nameSuccess.textContent = '';
                    nameSuccess.classList.remove('show');
                }, 5000);

                return;
            }

            if (response.status === 422) {
                showNameErrors(data.errors || {});
                return;
            }

            showNameErrors({
                name: [
                    data.message || 'Unable to update name. Please try again.'
                ]
            });

        } catch (error) {
            console.error('Name update error:', error);

            showNameErrors({
                name: [
                    'Something went wrong. Please try again.'
                ]
            });
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = 'Update Name';
        }
    });
}

function clearNameMessages() {
    if (nameError) {
        nameError.textContent = '';
    }

    if (nameSuccess) {
        nameSuccess.textContent = '';
        nameSuccess.classList.remove('show');
    }
}

function showNameErrors(errors) {
    if (errors.name && nameError) {
        nameError.textContent = errors.name[0];
    }
}