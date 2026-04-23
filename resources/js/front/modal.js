/**
 * Modal module — quick-view for project cards.
 * Opens a modal with full project info and image carousel.
 * Implements: focus trap, scroll lock, keyboard close, backdrop close.
 */

import { projectsData } from './data.js';
import { initCarousel, destroyCarousel } from './carousel.js';

const modal = document.getElementById('project-modal');
const backdrop = modal.querySelector('.modal-backdrop');
const closeBtn = document.getElementById('modal-close-btn');

const elBadges = document.getElementById('modal-badges');
const elTitle = document.getElementById('modal-title');
const elDescription = document.getElementById('modal-description');
const elMeta = document.getElementById('modal-meta');
const elTechnologies = document.getElementById('modal-technologies');
const elTags = document.getElementById('modal-tags');
const elDetailLink = document.getElementById('modal-detail-link');

let triggerElement = null;

// ── Populate ─────────────────────────────────────────

const BADGE_CYCLE_MAP = {
    DAW: 'daw',
    DAM: 'dam',
    ASIR: 'asir',
    SMX: 'smx',
};

function populateModal(project) {
    const cycleSlug = BADGE_CYCLE_MAP[project.courseCode] ?? 'daw';

    elBadges.innerHTML = `
    <span class="badge" data-cycle="${cycleSlug}">${project.courseCode}</span>
    <span class="badge" data-type="year">${project.year}</span>
  `;

    elTitle.textContent = project.title;
    elDescription.textContent = project.descriptionLong;

    elMeta.innerHTML = `
    <div class="modal-meta-item">
      <span class="modal-meta-label">Alumno/a</span>
      <span class="modal-meta-value">${project.student}</span>
    </div>
    <div class="modal-meta-item">
      <span class="modal-meta-label">Profesor/a</span>
      <span class="modal-meta-value">Prof. ${project.professor}</span>
    </div>
    <div class="modal-meta-item">
      <span class="modal-meta-label">Año</span>
      <span class="modal-meta-value">${project.year}</span>
    </div>
  `;

    elTechnologies.innerHTML = `
    <span class="modal-tech-label">Tecnologías</span>
    <div class="modal-tech-list">
      ${project.technologies.map((t) => `<span class="tech-chip">${t}</span>`).join('')}
    </div>
  `;

    elTags.innerHTML = `
    <div class="modal-tag-list">
      ${project.tags.map((tag) => `<span class="modal-tag">#${tag}</span>`).join('')}
    </div>
  `;

    elDetailLink.href = `project-detail.html?id=${project.id}`;
    elDetailLink.setAttribute('aria-label', `Ver proyecto completo: ${project.title}`);
}

// ── Open / Close ─────────────────────────────────────

function openModal(projectId) {
    const project = projectsData.find((p) => p.id === projectId);
    if (!project) return;

    populateModal(project);
    initCarousel(project.imagesGallery);

    modal.setAttribute('aria-hidden', 'false');
    modal.classList.add('is-open');
    document.body.style.overflow = 'hidden';

    // Move focus to close button
    requestAnimationFrame(() => closeBtn.focus());
}

function closeModal() {
    modal.setAttribute('aria-hidden', 'true');
    modal.classList.remove('is-open');
    document.body.style.overflow = '';

    destroyCarousel();

    // Restore focus to the element that opened the modal
    if (triggerElement) {
        triggerElement.focus();
        triggerElement = null;
    }
}

// ── Focus trap ───────────────────────────────────────

function getFocusableElements() {
    return Array.from(
        modal.querySelectorAll(
            'a[href], button:not([disabled]), input, textarea, select, [tabindex]:not([tabindex="-1"])'
        )
    ).filter((el) => !el.closest('.modal-backdrop'));
}

function trapFocus(e) {
    if (!modal.classList.contains('is-open')) return;

    const focusable = getFocusableElements();
    const first = focusable[0];
    const last = focusable[focusable.length - 1];

    if (e.key === 'Tab') {
        if (e.shiftKey) {
            if (document.activeElement === first) {
                e.preventDefault();
                last.focus();
            }
        } else {
            if (document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    }

    if (e.key === 'Escape') {
        closeModal();
    }
}

// ── Event listeners ──────────────────────────────────

document.querySelectorAll('[data-open-modal]').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        triggerElement = e.currentTarget;
        openModal(btn.dataset.openModal);
    });
});

backdrop.addEventListener('click', closeModal);
closeBtn.addEventListener('click', closeModal);
document.addEventListener('keydown', trapFocus);
