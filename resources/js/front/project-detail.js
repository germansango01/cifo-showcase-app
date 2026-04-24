/**
 * resources/js/front/project-detail.js
 * Initializes the gallery carousel on the project detail page.
 * All page content is server-rendered by Blade — this module only handles JS behaviour.
 */

const carousel = document.getElementById('detail-carousel');
if (!carousel) return; // not on the detail page

const raw = carousel.dataset.images;
if (!raw) return;

let images;
try {
    images = JSON.parse(raw);
} catch {
    return;
}

if (!images.length) return;

// ── Self-contained carousel for the detail page ───────────────

const track     = carousel.querySelector('.carousel-track');
const dots      = carousel.querySelector('.carousel-dots');
const btnPrev   = carousel.querySelector('[data-direction="prev"]');
const btnNext   = carousel.querySelector('[data-direction="next"]');

let current = 0;
const total = images.length;

function renderSlides() {
    track.innerHTML = images
        .map(
            (img, i) => `
            <div class="carousel-slide" role="tabpanel" aria-label="Imagen ${i + 1} de ${total}">
                <img src="${img.src}" alt="${img.alt || `Imagen ${i + 1}`}" width="1200" height="800" loading="lazy">
            </div>`
        )
        .join('');
}

function renderDots() {
    dots.innerHTML = Array.from({ length: total })
        .map(
            (_, i) => `
            <button class="carousel-dot${i === 0 ? ' is-active' : ''}"
                role="tab"
                aria-label="Ir a imagen ${i + 1}"
                aria-selected="${i === 0}"
                data-index="${i}"></button>`
        )
        .join('');
}

function goTo(index) {
    current = (index + total) % total;
    track.style.transform = `translateX(-${current * 100}%)`;

    dots.querySelectorAll('.carousel-dot').forEach((dot, i) => {
        dot.classList.toggle('is-active', i === current);
        dot.setAttribute('aria-selected', String(i === current));
    });
}

renderSlides();
renderDots();
track.style.transform = 'translateX(0)';

btnPrev?.addEventListener('click', () => goTo(current - 1));
btnNext?.addEventListener('click', () => goTo(current + 1));

dots.addEventListener('click', (e) => {
    const dot = e.target.closest('.carousel-dot');
    if (dot) goTo(Number(dot.dataset.index));
});

// Keyboard navigation scoped to this carousel
carousel.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') { e.preventDefault(); goTo(current - 1); }
    if (e.key === 'ArrowRight') { e.preventDefault(); goTo(current + 1); }
});

// Touch/swipe
let touchStartX = 0;
carousel.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
carousel.addEventListener('touchend', (e) => {
    const delta = e.changedTouches[0].clientX - touchStartX;
    if (delta > 50) goTo(current - 1);
    else if (delta < -50) goTo(current + 1);
}, { passive: true });
