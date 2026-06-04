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

/* ============================================================
   Romantic ambient animations: scroll reveals, falling petals,
   sparkles and a gentle hero parallax. All of them respect
   prefers-reduced-motion and degrade gracefully without JS.
   ============================================================ */
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function setupReveals() {
    const elements = document.querySelectorAll('[data-reveal]');
    if (!elements.length) return;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        elements.forEach((el) => el.classList.add('revealed'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
    );

    elements.forEach((el) => observer.observe(el));
}

function random(min, max) {
    return Math.random() * (max - min) + min;
}

function spawnPetals() {
    if (prefersReducedMotion) return;

    document.querySelectorAll('[data-petals]').forEach((container) => {
        const count = parseInt(container.dataset.petals, 10) || 10;

        for (let i = 0; i < count; i++) {
            const petal = document.createElement('div');
            const size = random(8, 18);

            petal.className = 'petal';
            petal.style.left = `${random(0, 100)}%`;
            petal.style.width = `${size}px`;
            petal.style.height = `${size * random(0.75, 1)}px`;
            petal.style.setProperty('--petal-duration', `${random(14, 26)}s`);
            petal.style.setProperty('--petal-delay', `${random(-26, 0)}s`);
            petal.style.setProperty('--petal-drift', `${random(-6, 6)}rem`);
            petal.style.setProperty('--petal-spin', `${random(360, 720)}deg`);
            petal.style.setProperty('--petal-opacity', random(0.35, 0.75).toFixed(2));

            container.appendChild(petal);
        }
    });
}

function spawnSparkles() {
    if (prefersReducedMotion) return;

    document.querySelectorAll('[data-sparkles]').forEach((container) => {
        const count = parseInt(container.dataset.sparkles, 10) || 8;

        for (let i = 0; i < count; i++) {
            const sparkle = document.createElement('div');

            sparkle.className = 'sparkle';
            sparkle.style.left = `${random(2, 98)}%`;
            sparkle.style.top = `${random(5, 95)}%`;
            sparkle.style.setProperty('--sparkle-duration', `${random(3.5, 7)}s`);
            sparkle.style.setProperty('--sparkle-delay', `${random(0, 6)}s`);
            sparkle.style.setProperty('--sparkle-opacity', random(0.35, 0.7).toFixed(2));

            container.appendChild(sparkle);
        }
    });
}

function setupParallax() {
    const layers = document.querySelectorAll('[data-parallax]');
    if (!layers.length || prefersReducedMotion) return;

    let ticking = false;

    const update = () => {
        const y = window.scrollY;
        layers.forEach((layer) => {
            const speed = parseFloat(layer.dataset.parallax) || 0.18;
            layer.style.transform = `translate3d(0, ${y * speed}px, 0)`;
        });
        ticking = false;
    };

    window.addEventListener(
        'scroll',
        () => {
            if (!ticking) {
                requestAnimationFrame(update);
                ticking = true;
            }
        },
        { passive: true }
    );
}

setupReveals();
spawnPetals();
spawnSparkles();
setupParallax();
