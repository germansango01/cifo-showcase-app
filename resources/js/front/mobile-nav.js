/**
 * resources/js/front/mobile-nav.js
 * Hamburger toggle for mobile navigation drawer.
 */

const toggle = document.querySelector('.menu-toggle');
const nav    = document.getElementById('mobile-nav');
const close  = document.querySelector('.mobile-close-btn');

if (!toggle || !nav) return;

function openNav() {
    nav.classList.add('is-open');
    nav.setAttribute('aria-hidden', 'false');
    toggle.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
}

function closeNav() {
    nav.classList.remove('is-open');
    nav.setAttribute('aria-hidden', 'true');
    toggle.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
}

toggle.addEventListener('click', () => {
    nav.classList.contains('is-open') ? closeNav() : openNav();
});

close?.addEventListener('click', closeNav);

// Close on backdrop click
nav.addEventListener('click', (e) => {
    if (e.target === nav) closeNav();
});

// Close on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && nav.classList.contains('is-open')) closeNav();
});
