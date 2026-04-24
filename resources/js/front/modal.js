/**
 * resources/js/front/modal.js
 * Project quick-view modal — reads project data from the card's data-project attribute.
 */

import { initCarousel, destroyCarousel } from './carousel.js';

const modal = document.getElementById('project-modal');
if (!modal) throw new Error(); // guard: module only runs on pages with the modal

const backdrop  = modal.querySelector('.modal-backdrop');
const closeBtn  = document.getElementById('modal-close-btn');
const elBadges  = document.getElementById('modal-badges');
const elTitle   = document.getElementById('modal-title');
const elDesc    = document.getElementById('modal-description');
const elMeta    = document.getElementById('modal-meta');
const elTech    = document.getElementById('modal-technologies');
const elTags    = document.getElementById('modal-tags');
const elLink    = document.getElementById('modal-detail-link');

let triggerEl = null;

// ── Populate ─────────────────────────────────────────

function populateModal(project) {
    const cycleSlug = (project.cycle ?? '').toLowerCase();

    elBadges.innerHTML = `
        <span class="badge" data-cycle="${cycleSlug}">${project.cycleName || project.cycle || ''}</span>
        <span class="badge" data-type="year">${project.year || ''}</span>`;

    elTitle.textContent = project.title ?? '';
    elDesc.textContent  = project.description ?? '';

    elMeta.innerHTML = `
        <div class="modal-meta-item">
            <span class="modal-meta-label">Alumno/a</span>
            <span class="modal-meta-value">${(project.students ?? []).join(', ') || '—'}</span>
        </div>
        <div class="modal-meta-item">
            <span class="modal-meta-label">Ciclo</span>
            <span class="modal-meta-value">${project.cycleName || project.cycle || '—'}</span>
        </div>
        <div class="modal-meta-item">
            <span class="modal-meta-label">Año</span>
            <span class="modal-meta-value">${project.year || '—'}</span>
        </div>`;

    elTech.innerHTML = '';

    elTags.innerHTML = (project.tags ?? []).length
        ? `<div class="modal-tag-list">${project.tags.map((t) => `<span class="modal-tag">#${t}</span>`).join('')}</div>`
        : '';

    elLink.href = project.detailUrl ?? '#';
    elLink.setAttribute('aria-label', `Ver proyecto completo: ${project.title}`);
}

// ── Open / Close ─────────────────────────────────────

function openModal(projectId) {
    const btn     = document.querySelector(`[data-open-modal="${projectId}"]`);
    const article = btn?.closest('[data-project]');
    if (!article) return;

    const project = JSON.parse(article.dataset.project);
    populateModal(project);

    const images = project.thumbnail ? [project.thumbnail] : [];
    initCarousel(images);

    modal.setAttribute('aria-hidden', 'false');
    modal.classList.add('is-open');
    document.body.style.overflow = 'hidden';

    requestAnimationFrame(() => closeBtn.focus());
}

function closeModal() {
    modal.setAttribute('aria-hidden', 'true');
    modal.classList.remove('is-open');
    document.body.style.overflow = '';

    destroyCarousel();

    if (triggerEl) {
        triggerEl.focus();
        triggerEl = null;
    }
}

// ── Focus trap ───────────────────────────────────────

function getFocusable() {
    return Array.from(
        modal.querySelectorAll(
            'a[href], button:not([disabled]), input, textarea, select, [tabindex]:not([tabindex="-1"])'
        )
    ).filter((el) => !el.closest('.modal-backdrop'));
}

function trapFocus(e) {
    if (!modal.classList.contains('is-open')) return;

    const focusable = getFocusable();
    const first = focusable[0];
    const last  = focusable[focusable.length - 1];

    if (e.key === 'Tab') {
        if (e.shiftKey && document.activeElement === first) {
            e.preventDefault();
            last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault();
            first.focus();
        }
    }

    if (e.key === 'Escape') closeModal();
}

// ── Event listeners ──────────────────────────────────

document.querySelectorAll('[data-open-modal]').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        triggerEl = e.currentTarget;
        openModal(btn.dataset.openModal);
    });
});

backdrop.addEventListener('click', closeModal);
closeBtn.addEventListener('click', closeModal);
document.addEventListener('keydown', trapFocus);
