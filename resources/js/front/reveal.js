/**
 * resources/js/front/reveal.js
 * Scroll-triggered reveal using IntersectionObserver.
 * Adds .is-visible to elements with .reveal or .stagger > children.
 */

const REVEAL_SELECTOR  = '.reveal';
const STAGGER_SELECTOR = '.stagger > *';

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    },
    { rootMargin: '0px 0px -60px 0px', threshold: 0.1 }
);

document.querySelectorAll(REVEAL_SELECTOR).forEach((el) => observer.observe(el));

// Staggered children — add index-based delay via CSS variable
document.querySelectorAll(STAGGER_SELECTOR).forEach((el, i) => {
    el.style.setProperty('--stagger-index', i);
    observer.observe(el);
});
