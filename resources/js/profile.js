const profileToggle = document.getElementById('profile-toggle');
const profileSidebar = document.getElementById('profile-sidebar');
const profileOverlay = document.getElementById('profile-overlay');
const profileClose = document.getElementById('profile-close');

function openProfileSidebar() {
    profileSidebar.classList.add('open');
    profileOverlay.classList.add('open');
    document.body.classList.add('profile-sidebar-open');
}

function closeProfileSidebar() {
    profileSidebar.classList.remove('open');
    profileOverlay.classList.remove('open');
    document.body.classList.remove('profile-sidebar-open');
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