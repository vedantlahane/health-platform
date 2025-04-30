import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
function setThemeIcons() {
    const isDark = document.documentElement.classList.contains('dark');

    // Desktop
    document.getElementById('theme-toggle-dark-icon').classList.toggle('hidden', isDark);
    document.getElementById('theme-toggle-light-icon').classList.toggle('hidden', !isDark);

    // Mobile
    document.getElementById('theme-toggle-dark-icon-mobile').classList.toggle('hidden', isDark);
    document.getElementById('theme-toggle-light-icon-mobile').classList.toggle('hidden', !isDark);
}

// Set initial theme
if (
    localStorage.getItem('color-theme') === 'dark' ||
    (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}
setThemeIcons();

// Desktop toggle
document.getElementById('theme-toggle').addEventListener('click', function () {
    document.documentElement.classList.toggle('dark');
    if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('color-theme', 'dark');
    } else {
        localStorage.setItem('color-theme', 'light');
    }
    setThemeIcons();
});

// Mobile toggle
document.getElementById('theme-toggle-mobile').addEventListener('click', function () {
    document.documentElement.classList.toggle('dark');
    if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('color-theme', 'dark');
    } else {
        localStorage.setItem('color-theme', 'light');
    }
    setThemeIcons();
});