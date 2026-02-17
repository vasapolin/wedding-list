import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

Alpine.store('darkMode', {
    on: false,
    toggle() {
        this.on = !this.on;
        document.documentElement.classList.toggle('dark', this.on);
        localStorage.setItem('darkMode', this.on);
    },
    init() {
        this.on = localStorage.getItem('darkMode') === 'true';
        document.documentElement.classList.toggle('dark', this.on);
    }
});

window.Alpine = Alpine;
Alpine.start();
