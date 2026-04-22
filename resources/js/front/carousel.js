/**
 * Carousel module for the CIFO Violeta modal.
 * Handles image sliding with prev/next, dots, keyboard and touch/swipe.
 */

const track = document.getElementById('carousel-track');
const dotsContainer = document.getElementById('carousel-dots');
const btnPrev = document.getElementById('carousel-prev');
const btnNext = document.getElementById('carousel-next');

let currentIndex = 0;
let total = 0;
let touchStartX = 0;

// ── Render ──────────────────────────────────────────

function renderSlides(images) {
    track.innerHTML = images
        .map(
            (src, i) => `
    <div class="carousel-slide" role="tabpanel" aria-label="Imagen ${i + 1} de ${images.length}">
      <img src="${src}" alt="Imagen del proyecto ${i + 1}" width="1200" height="800" loading="lazy">
    </div>`
        )
        .join('');
}

function renderDots(count) {
    dotsContainer.innerHTML = Array.from({ length: count })
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

// ── Navigation ──────────────────────────────────────

function goTo(index) {
    currentIndex = (index + total) % total;
    track.style.transform = `translateX(-${currentIndex * 100}%)`;

    dotsContainer.querySelectorAll('.carousel-dot').forEach((dot, i) => {
        dot.classList.toggle('is-active', i === currentIndex);
        dot.setAttribute('aria-selected', i === currentIndex ? 'true' : 'false');
    });
}

function prev() {
    goTo(currentIndex - 1);
}

function next() {
    goTo(currentIndex + 1);
}

// ── Event handlers ───────────────────────────────────

function onKeydown(e) {
    if (e.key === 'ArrowLeft') {
        e.preventDefault();
        prev();
    } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        next();
    }
}

function onTouchStart(e) {
    touchStartX = e.touches[0].clientX;
}

function onTouchEnd(e) {
    const delta = e.changedTouches[0].clientX - touchStartX;
    if (delta > 50) prev();
    else if (delta < -50) next();
}

// ── Public API ───────────────────────────────────────

export function initCarousel(images) {
    total = images.length;
    currentIndex = 0;

    renderSlides(images);
    renderDots(total);
    track.style.transform = 'translateX(0)';

    btnPrev.addEventListener('click', prev);
    btnNext.addEventListener('click', next);

    dotsContainer.addEventListener('click', (e) => {
        const dot = e.target.closest('.carousel-dot');
        if (dot) goTo(Number(dot.dataset.index));
    });

    document.addEventListener('keydown', onKeydown);
    track.addEventListener('touchstart', onTouchStart, { passive: true });
    track.addEventListener('touchend', onTouchEnd, { passive: true });
}

export function destroyCarousel() {
    btnPrev.removeEventListener('click', prev);
    btnNext.removeEventListener('click', next);
    document.removeEventListener('keydown', onKeydown);
    track.removeEventListener('touchstart', onTouchStart);
    track.removeEventListener('touchend', onTouchEnd);
    track.innerHTML = '';
    dotsContainer.innerHTML = '';
}
