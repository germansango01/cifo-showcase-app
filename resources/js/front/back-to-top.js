/* ══════════════════════════════════════════════════════════
   BACK-TO-TOP.JS — CIFO Violeta Showcase
   Shows scroll-to-top button after 400px scroll
   ══════════════════════════════════════════════════════════ */

const btn = document.querySelector('.back-to-top');
if (btn) initBackToTop(btn);

function initBackToTop(btn) {
    const THRESHOLD = 400;
    const REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Remove HTML hidden attribute — CSS handles visibility via .is-visible
    btn.removeAttribute('hidden');

    window.addEventListener('scroll', () => {
        btn.classList.toggle('is-visible', window.scrollY > THRESHOLD);
    }, { passive: true });

    btn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: REDUCED_MOTION ? 'instant' : 'smooth',
        });
    });
}
