/**
 * resources/js/front/stats-counter.js
 * Animates [data-count] elements when they enter the viewport.
 */

const DURATION = 2000; // ms

function animateCounter(el) {
    const target = parseInt(el.dataset.count, 10);
    const start  = performance.now();

    function step(now) {
        const elapsed  = now - start;
        const progress = Math.min(elapsed / DURATION, 1);
        // Ease out cubic
        const eased    = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.round(eased * target).toLocaleString('es');

        if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
}

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.5 }
);

document.querySelectorAll('[data-count]').forEach((el) => observer.observe(el));
