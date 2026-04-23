/**
 * resources/js/front/header.js
 * Adds .scrolled class to site-header on scroll for sticky styling.
 */

const header = document.querySelector('.site-header');
if (!header) return;

const SCROLL_THRESHOLD = 60;

function onScroll() {
    header.classList.toggle('scrolled', window.scrollY > SCROLL_THRESHOLD);
}

window.addEventListener('scroll', onScroll, { passive: true });
onScroll();
