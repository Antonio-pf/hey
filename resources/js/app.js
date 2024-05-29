import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('darkMode', () => ({
    dark: false,

    init() {
        this.dark = localStorage.getItem('dark') === 'true';
        this.updateDarkMode();
    },

    toggle() {
        this.dark = !this.dark;
        localStorage.setItem('dark', this.dark);
        this.updateDarkMode();
    },

    updateDarkMode() {
        if (this.dark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },
}));

Alpine.start();
