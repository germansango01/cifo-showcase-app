/* ══════════════════════════════════════════════════════════
   SCROLL-ANIMATIONS.JS — CIFO Violeta Showcase
   IntersectionObserver-based scroll reveal animations.
   Respects prefers-reduced-motion.
   ══════════════════════════════════════════════════════════ */

const REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Observe a list of elements and add `is-visible` when they enter the viewport.
 * @param {NodeList|Element[]} elements
 * @param {IntersectionObserverInit} [options]
 */
function observeElements(elements, options = {}) {
    if (!elements.length) return;

    if (REDUCED_MOTION) {
        elements.forEach(el => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -48px 0px',
        ...options,
    });

    elements.forEach(el => observer.observe(el));
}

/**
 * Initialize smooth scroll behavior for anchor links.
 * Falls back to instant scroll when reduced motion is preferred.
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (!target) return;
            e.preventDefault();
            target.scrollIntoView({ behavior: REDUCED_MOTION ? 'auto' : 'smooth' });
            if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
            target.focus({ preventScroll: true });
        });
    });
}

/**
 * Animate a single counter element from 0 to its data-count value.
 * @param {HTMLElement} el
 */
function animateCounter(el) {
    const target = parseInt(el.dataset.count, 10);
    if (isNaN(target)) return;

    const duration = 1800;
    const start = performance.now();

    function step(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
        el.textContent = Math.round(eased * target).toLocaleString('es');
        if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
}

/**
 * Initialize stats counter animation for .stats-strip.
 * Triggered once when the strip enters the viewport.
 */
export function initStatsCounter() {
    const strip = document.querySelector('.stats-strip');
    if (!strip) return;

    const counters = strip.querySelectorAll('.stat-number[data-count]');
    if (!counters.length) return;

    if (REDUCED_MOTION) {
        counters.forEach(el => {
            el.textContent = parseInt(el.dataset.count, 10).toLocaleString('es');
        });
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            counters.forEach(animateCounter);
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.3 });

    observer.observe(strip);
}

/**
 * Initialize all scroll animations on the page.
 * Called from main.js on DOMContentLoaded.
 */
export function initScrollAnimations() {
    // Generic .reveal elements (hero content, section headers, about cards, etc.)
    observeElements(document.querySelectorAll('.reveal'));

    // Project cards in the stagger grid — lower threshold, trigger earlier
    observeElements(
        document.querySelectorAll('.grid-item'),
        { threshold: 0.08, rootMargin: '0px 0px -32px 0px' }
    );

    initSmoothScroll();
}
